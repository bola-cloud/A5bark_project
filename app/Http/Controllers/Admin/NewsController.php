<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\News;
use App\Http\Traits\ResponseTemplate;
use Illuminate\Support\Facades\Storage;
use LaravelLocalization;

class NewsController extends Controller
{
    use ResponseTemplate;

    private $targetModel;

    public function __construct() {
        $this->targetModel = new News;
    }

    public function index(Request $request) {
        $lang = LaravelLocalization::getCurrentLocale();
        $permissions = auth()->user()->category == 'admin' 
            ? 'admin' 
            : $this->getPermissions(['news_add', 'news_edit', 'news_delete', 'news_show']);

        if ($request->ajax()) {
            $model = $this->targetModel->query()
                ->with('newsCategory')
                ->adminFilter();

            $datatableModel = Datatables::of($model)
                ->addColumn('news_category_name', function ($row) {
                    return $row->newsCategory ? $row->newsCategory->ar_name . ' / ' . $row->newsCategory->en_name : '';
                })
                ->addColumn('activation', function ($row_object) use ($permissions) {
                    return view('admin.news.incs._active', compact('row_object', 'permissions'));
                })
                ->addColumn('actions', function ($row_object) use ($permissions) {
                    return view('admin.news.incs._actions', compact('row_object', 'permissions'));
                })
                ->rawColumns(['activation', 'actions']);

            return $datatableModel->make(true);
        }

        return view('admin.news.index', compact('lang','permissions'));
    }
    
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'ar_head' => 'required|max:255',
            'ar_title' => 'required|max:255',
            'ar_content' => 'required',
            'en_head' => 'required|max:255',
            'en_title' => 'required|max:255',
            'en_content' => 'required',
            'news_category_id' => 'nullable|exists:news_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'ar_head.required' => __('news.ar_head_required'),
            'ar_title.required' => __('news.ar_title_required'),
            'ar_content.required' => __('news.ar_content_required'),
            'en_head.required' => __('news.en_head_required'),
            'en_title.required' => __('news.en_title_required'),
            'en_content.required' => __('news.en_content_required'),
        ]);
    
        if ($validator->fails()) {
            return $this->responseTemplate(null, false, $validator->errors());
        }
    
        try {
            DB::beginTransaction();
            $data = $request->only($this->targetModel->getFillable());
            
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('news_images', 'media');
            }
    
            $news = $this->targetModel->create($data);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollback();
            return $this->responseTemplate(null, false, [__('news.object_error')]);
        }
    
        return $this->responseTemplate($news, true, __('news.object_created'));
    }
    
    

    public function show($id) {
        $news = $this->targetModel->with(['newsCategory'])->find($id);

        if (!isset($news)) {
            return $this->responseTemplate(null, false, __('news.object_not_found'));
        }
        if ($news->image) {
            $news->image = asset('media/' . $news->image);
        }

        return $this->responseTemplate($news, true, null);
    }

    public function update(Request $request, $id) {
        $news = $this->targetModel->find($id);

        if (!isset($news)) {
            return $this->responseTemplate(null, false, __('news.object_not_found'));
        }

        return isset($request->activate_object)
            ? $this->activateNews($news)
            : $this->updateNews($request, $news);
    }

    public function destroy($id) {
        $news = $this->targetModel->find($id);

        if (!isset($news)) {
            return $this->responseTemplate(null, false, __('news.object_not_found'));
        }

        $news->delete();

        return $this->responseTemplate($news, true, __('news.object_deleted'));
    }

    private function updateNews(Request $request, News $news) {
        $validator = Validator::make($request->all(), [
            'ar_head' => 'required|max:255',
            'ar_title' => 'required|max:255',
            'ar_content' => 'required',
            'en_head' => 'required|max:255',
            'en_title' => 'required|max:255',
            'en_content' => 'required',
            'news_category_id' => 'nullable|exists:news_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'ar_head.required' => __('news.ar_head_required'),
            'ar_title.required' => __('news.ar_title_required'),
            'ar_content.required' => __('news.ar_content_required'),
            'en_head.required' => __('news.en_head_required'),
            'en_title.required' => __('news.en_title_required'),
            'en_content.required' => __('news.en_content_required'),
        ]);
    
        if ($validator->fails()) {
            return $this->responseTemplate(null, false, $validator->errors());
        }
    
        try {
            DB::beginTransaction();

            $data = $request->only($this->targetModel->getFillable());

            if ($request->hasFile('image')) {
                if ($news->image) {
                    Storage::disk('media')->delete($news->image);
                }
                $data['image'] = $request->file('image')->store('news_images', 'media');
            } else {
                unset($data['image']);
            }

            $news->update($data);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->responseTemplate(null, false, [__('news.object_error')]);
        }
    
        return $this->responseTemplate($news, true, __('news.object_updated'));
    }

    private function activateNews(News $news) {
        $news->is_active = !$news->is_active;
        $news->save();

        return $this->responseTemplate($news, true, __('news.object_updated'));
    }
}
