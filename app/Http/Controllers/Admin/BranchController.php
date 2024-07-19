<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Branch;
use App\Http\Traits\ResponseTemplate;
use Illuminate\Support\Facades\Storage;
use LaravelLocalization;

class BranchController extends Controller
{
    use ResponseTemplate;

    private $targetModel;

    public function __construct() {
        $this->targetModel = new Branch;
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
                    return view('admin.branch.incs._active', compact('row_object', 'permissions'));
                })
                ->addColumn('actions', function ($row_object) use ($permissions) {
                    return view('admin.branch.incs._actions', compact('row_object', 'permissions'));
                })
                ->rawColumns(['activation', 'actions']);

            return $datatableModel->make(true);
        }

        return view('admin.branch.index', compact('lang','permissions'));
    }
    
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'ar_name' => 'required|max:255',
            'en_name' => 'required|max:255',
            'image' => 'required',
        ], [
            'ar_head.required' => __('news.ar_head_required'),
            'ar_name.required' => __('news.ar_name_required'),
            'ar_content.required' => __('news.ar_content_required'),
            'en_head.required' => __('news.en_head_required'),
            'en_name.required' => __('news.en_name_required'),
            'en_content.required' => __('news.en_content_required'),
        ]);
    
        if ($validator->fails()) {
            return $this->responseTemplate(null, false, $validator->errors());
        }
    
        try {
            DB::beginTransaction();
            $data = $request->only($this->targetModel->getFillable());
            
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('branch_images', 'media');
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

    private function updateNews(Request $request, Branch $news) {
        $validator = Validator::make($request->all(), [
            'ar_name' => 'required|max:255',
            'en_name' => 'required|max:255',
            'image' => 'nullable',
        ], [
            'ar_head.required' => __('news.ar_head_required'),
            'ar_name.required' => __('news.ar_name_required'),
            'ar_content.required' => __('news.ar_content_required'),
            'en_head.required' => __('news.en_head_required'),
            'en_name.required' => __('news.en_name_required'),
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
                $data['image'] = $request->file('image')->store('branch_images', 'media');
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

    public function dataAjax(Request $request) {
    	$data = [];
        if($request->has('q')){
            $search = $request->q;

            $model = $this->targetModel->query()
            ->where('is_active', 1);

            $data = $model->where(function ($q) use ($request) {
                $q->orWhere('ar_name', 'like', "%$request->q%");
                $q->orWhere('en_name', 'like', "%$request->q%");
            })->get();
        }

        return response()->json($data);
    }

    private function activateNews(Branch $news) {
        $news->is_active = !$news->is_active;
        $news->save();
        return $this->responseTemplate($news, true, __('news.object_updated'));
        
    }
}
