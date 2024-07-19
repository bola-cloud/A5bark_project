<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Place;
use App\Http\Traits\ResponseTemplate;
use Illuminate\Support\Facades\Storage;
use LaravelLocalization;

class PlacesController extends Controller
{
    use ResponseTemplate;

    private $targetModel;

    public function __construct() {
        $this->targetModel = new Place;
    }

    public function index(Request $request) {
        $lang = LaravelLocalization::getCurrentLocale();
        $permissions = auth()->user()->category == 'admin' 
            ? 'admin' 
            : $this->getPermissions(['news_add', 'news_edit', 'news_delete', 'news_show']);

        if ($request->ajax()) {
            $model = $this->targetModel->query()
                ->with('branch')
                ->adminFilter();

            $datatableModel = Datatables::of($model)
                ->addColumn('branch_name', function ($row) {
                    return $row->branch ? $row->branch->ar_name . ' / ' . $row->branch->en_name : '';
                })
                ->addColumn('activation', function ($row_object) use ($permissions) {
                    return view('admin.places.incs._active', compact('row_object', 'permissions'));
                })
                ->addColumn('actions', function ($row_object) use ($permissions) {
                    return view('admin.places.incs._actions', compact('row_object', 'permissions'));
                })
                ->rawColumns(['activation', 'actions']);

            return $datatableModel->make(true);
        }

        return view('admin.places.index', compact('lang','permissions'));
    }
    
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'working_hours' => 'required|max:255',
            'ar_name' => 'required|max:255',
            'address' => 'required|max:255',
            'en_name' => 'required|max:255',
            'branch_id' => 'nullable|exists:branches,id',
        ], [
            'working_hours.required' => __('news.working_hours_required'),
            'ar_name.required' => __('news.ar_name_required'),
            'ar_content.required' => __('news.ar_content_required'),
            'address.required' => __('news.address_required'),
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
        $news = $this->targetModel->with(['branch'])->find($id);

        if (!isset($news)) {
            return $this->responseTemplate(null, false, __('news.object_not_found'));
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

    private function updateNews(Request $request, Place $news) {
        $validator = Validator::make($request->all(), [
            'working_hours' => 'required|max:255',
            'ar_name' => 'required|max:255',
            'address' => 'required|max:255',
            'en_name' => 'required|max:255',
            'branch_id' => 'nullable|exists:branches,id',
        ]);
    
        if ($validator->fails()) {
            return $this->responseTemplate(null, false, $validator->errors());
        }
    
        try {
            DB::beginTransaction();

            $data = $request->only($this->targetModel->getFillable());

            $news->update($data);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->responseTemplate(null, false, [__('news.object_error')]);
        }
    
        return $this->responseTemplate($news, true, __('news.object_updated'));
    }

    private function activateNews(Place $news) {
        $news->is_active = !$news->is_active;
        $news->save();

        return $this->responseTemplate($news, true, __('news.object_updated'));
    }
}
