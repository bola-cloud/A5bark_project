<?php

namespace App\Http\Controllers\Admin;

use LaravelLocalization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\NewsCategory;

use App\Http\Traits\ResponseTemplate;

class NewsCategoryController extends Controller
{
    use ResponseTemplate;

    private $targetModel;

    public function __construct () {
        $this->targetModel = new NewsCategory;
    }

    public function index(Request $request) {
        $lang = LaravelLocalization::getCurrentLocale();
        
        $permissions = auth()->user()->category == 'admin' 
            ? 'admin' 
            : $this->getPermissions(['courseCategories_add', 'courseCategories_edit', 'courseCategories_delete', 'courseCategories_show']);
    
        if ($request->ajax()) {
            $model = $this->targetModel->query()->adminFilter();
            
            // Log the SQL query for debugging
            \Log::info('SQL Query: ' . $model->toSql());
    
            $datatableModel = Datatables::of($model)
            ->addColumn('activation', function ($row_object) use ($permissions) {
                return view('admin.news_category.incs._active', compact('row_object', 'permissions'));
            })
            ->addColumn('actions', function ($row_object) use ($permissions) {
                return view('admin.news_category.incs._actions', compact('row_object', 'permissions'));
            });
    
            return $datatableModel->make(true);
        }
        
        return view('admin.news_category.index', compact('lang', 'permissions'));
    }
    
    
    public function store (Request $request) {
        $validator = Validator::make($request->all(), [
            'ar_name'     => 'required|max:255|unique:news_categories,ar_name',
            'en_name'     => 'required|max:255|unique:news_categories,en_name',
        ], [
            'ar_name.required' => __('news_category.ar_name_required'),
            'en_name.required' => __('news_category.en_name_required'),
            'ar_name.max'      => __('news_category.ar_name_max'),
            'en_name.max'      => __('news_category.ar_name_max'),
        ]);

        if ($validator->fails()) {
            return $this->responseTemplate(null, false, $validator->errors());
        }

        try {
            DB::beginTransaction();
            $data     = $request->only($this->targetModel->getFillable());
            $category = $this->targetModel->create($data);
            
            DB::commit();
        } catch(Exception $exception) {
            DB::rollback();

            return $this->responseTemplate(null, false, [__('news_category.object_error')]);
        }

        return $this->responseTemplate($category, true, __('news_category.object_created'));
    }

    public function show ($id) {
        $gove = $this->targetModel->find($id);

        if (!isset($gove)) {
            return $this->responseTemplate(null, false, __('districts.object_not_found'));
        }

        return $this->responseTemplate($gove, true, null);
    }

    public function update (Request $request, $id) {
        $category = $this->targetModel->query()->find($id);

        if (!isset($category)) {
            return $this->responseTemplate(null, false, __('course_category.object_not_found'));
        }

        return isset($request->activate_object)
            ? $this->activateNewsCategory($category)
            : $this->updateNewsCategory($request, $category);
    }

    public function destroy ($id) {
        $gove = $this->targetModel->query()->find($id);

        if (!isset($gove)) {
            return $this->responseTemplate(null, false, __('districts.object_not_found'));
        }
        
        $gove->delete();

        return $this->responseTemplate($gove, true, __('districts.object_deleted'));
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

    // START HELPERS
    private function updateNewsCategory (Request $request, NewsCategory $category) {

        $validator = Validator::make($request->all(), [
            'ar_name'     => 'required|max:255|unique:news_categories,ar_name,' . $category->id,
            'en_name'     => 'required|max:255|unique:news_categories,en_name,' . $category->id,
        ], [
            'ar_name.required' => __('course_category.ar_name_required'),
            'en_name.required' => __('course_category.en_name_required'),
            'ar_name.max'      => __('course_category.ar_name_max'),
            'en_name.max'      => __('course_category.ar_name_max'),
        ]);

        if ($validator->fails()) {
            return $this->responseTemplate(null, false, $validator->errors());
        }
        
        try {
            DB::beginTransaction();

            $data = $request->only($this->targetModel->getFillable());

            $category->update($data);
            
            DB::commit();
        } catch(Exception $exception) {
            DB::rollback();

            return $this->responseTemplate(null, false, [__('course_category.object_error')]);
        }

        return $this->responseTemplate($category, true, __('districts.object_updated'));
    }

    private function activateNewsCategory (NewsCategory $category) {
        $category->is_active = !$category->is_active;
        $category->save();

        return $this->responseTemplate($category, true, __('course_category.object_updated'));
    }
    
}
