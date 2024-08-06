<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Podcast;
use App\Http\Traits\ResponseTemplate;
use Illuminate\Support\Facades\Storage;
use LaravelLocalization;

class PodcastController extends Controller
{
    use ResponseTemplate;

    private $targetModel;

    public function __construct() {
        $this->targetModel = new Podcast; 
    }

    public function index(Request $request) {
        $lang = LaravelLocalization::getCurrentLocale();
        $permissions = auth()->user()->category == 'admin' 
            ? 'admin' 
            : $this->getPermissions(['news_add', 'news_edit', 'news_delete', 'news_show']);

        if ($request->ajax()) {
            $model = $this->targetModel->query()
                ->adminFilter();

            $datatableModel = Datatables::of($model)
                ->addColumn('activation', function ($row_object) use ($permissions) {
                    return view('admin.podcast.incs._active', compact('row_object', 'permissions'));
                })
                ->addColumn('actions', function ($row_object) use ($permissions) {
                    return view('admin.podcast.incs._actions', compact('row_object', 'permissions'));
                })
                ->rawColumns(['activation', 'actions']);

            return $datatableModel->make(true);
        }

        return view('admin.podcast.index', compact('lang','permissions'));
    }
    
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'ar_head' => 'required|max:255',
            'ar_title' => 'required|max:255',
            'en_head' => 'required|max:255',
            'en_title' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'ar_head.required' => __('news.ar_head_required'),
            'ar_title.required' => __('news.ar_title_required'),
            'en_head.required' => __('news.en_head_required'),
            'en_title.required' => __('news.en_title_required'),
        ]);
    
        if ($validator->fails()) {
            return $this->responseTemplate(null, false, $validator->errors());
        }
    
        try {
            DB::beginTransaction();
            $data = $request->only($this->targetModel->getFillable());
            
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('podcast_images', 'media');
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
        $news = $this->targetModel->find($id);

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

    private function updateNews(Request $request, Podcast $news) {
        $validator = Validator::make($request->all(), [
            'ar_head' => 'required|max:255',
            'ar_title' => 'required|max:255',
            'en_head' => 'required|max:255',
            'en_title' => 'required|max:255',
            'image' => 'nullable',
        ], [
            'ar_head.required' => __('news.ar_head_required'),
            'ar_title.required' => __('news.ar_title_required'),
            'en_head.required' => __('news.en_head_required'),
            'en_title.required' => __('news.en_title_required'),
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
                $data['image'] = $request->file('image')->store('podcast_images', 'media');
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

    private function activateNews(Podcast $news) {
        Podcast::where('is_active', 1)->update(['is_active' => 0]);
        // Activate the selected festival
        $news->is_active = 1;
        $news->save();

        return $this->responseTemplate($news, true, __('news.object_updated'));
    }
}
