<?php

namespace App\Http\Controllers\Admin;

use LaravelLocalization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\TrackGrade;
use App\Models\TrackGradePricing;

use App\Http\Traits\ResponseTemplate;

class TrackGradeController extends Controller
{
    use ResponseTemplate;

    private $targetModel;

    public function __construct () {
        $this->targetModel   = new TrackGrade;
        $this->relationModel = new TrackGradePricing;
    }

    public function index (Request $request) {
        
        $lang = LaravelLocalization::getCurrentLocale();
        
        $permissions = auth()->user()->category == 'admin' 
            ? 'admin' 
            : $this->getPermissions(['trackGrades_add', 'trackGrades_edit', 'trackGrades_delete', 'trackGrades_show']);

        if ($request->ajax()) {
            $model = $this->targetModel->query()
            ->withCount(['tracks'])
            ->adminFilter();
            
            $datatableModel = Datatables::of($model)
            ->addColumn('pricing_btn', function ($row_object) use ($permissions) {
                return view('admin.track_grades.incs._pricing_plans_btn', compact('row_object', 'permissions'));
            })
            ->addColumn('activation', function ($row_object) use ($permissions) {
                return view('admin.track_grades.incs._active', compact('row_object', 'permissions'));
            })
            ->addColumn('actions', function ($row_object) use ($permissions) {
                return view('admin.track_grades.incs._actions', compact('row_object', 'permissions'));
            });

            return $datatableModel->make(true);
        }
        
        return view('admin.track_grades.index', compact('lang', 'permissions'));
    }

    public function store (Request $request) {
        $validator = Validator::make($request->all(), [
            'ar_title'      => 'required|max:255',
            'en_title'      => 'required|max:255',
            'from'          => 'required|numeric|regex:/^[1-9]\d*$/',
            'to'            => 'required|numeric|regex:/^[1-9]\d*$/',
            'image'         => 'required|image|max:10240',
        ]);

        if ($validator->fails()) {
            return $this->responseTemplate(null, false, $validator->errors());
        }

        try {
            DB::beginTransaction();

            // Get the data and add the image path
            $data = $request->only($this->targetModel->getFillable());
            
            // Handle the image upload
            $data['image'] = str_replace('public/', '', $request->file('image')->store('public/media/grades_images'));

            $grade = $this->targetModel->create($data);
            
            DB::commit();
        } catch(Exception $exception) {
            DB::rollback();

            return $this->responseTemplate(null, false, [__('track_grades.object_error')]);
        }

        return $this->responseTemplate($grade, true, __('track_grades.object_created'));
    }

    public function show ($id) {
        $grade = $this->targetModel->with(['pricingPlans', 'groups', 'tracks' => fn ($q) => $q->with(['courses' => fn ($qu) => $qu->orderBy('order', 'asc')])])->find($id);

        if (!isset($grade)) {
            return $this->responseTemplate(null, false, __('track_grades.object_not_found'));
        }

        return $this->responseTemplate($grade, true, null);
    }

    public function update (Request $request, $id) {
        $grade = $this->targetModel->query()
        ->with(['tracks'])->find($id);

        if (!isset($grade)) {
            return $this->responseTemplate(null, false, __('track_grades.object_not_found'));
        }

        if (isset($request->activate_object)) {
            return $this->activateTrackGrades($grade);
        } else if (isset($request->update_price_plan)) {
            return $this->updateGradePrice($request, $grade);
        } else {
            return $this->updateTrackGrades($request, $grade);
        } 
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
            $query = $this->targetModel->query()
                ->select("id", "ar_title", "en_title", "from", "to")
                ->where(function ($q) use ($search) {
                    $q->orWhere('ar_title','LIKE',"%$search%");
                    $q->orWhere('en_title','LIKE',"%$search%");
                    $q->orWhere('from','LIKE',"%$search%");
                    $q->orWhere('to','LIKE',"%$search%");
                });

            $data = $query->get();
        }

        return response()->json($data);
    }

    // START HELPERS
    private function updateTrackGrades (Request $request, TrackGrade $grade) {
        $validator = Validator::make($request->all(), [
            'ar_title'  => 'required|max:255',
            'en_title'  => 'required|max:255',
            'from'      => 'required|numeric|regex:/^[1-9]\d*$/',
            'to'        => 'required|numeric|regex:/^[1-9]\d*$/',
            'image'     => 'nullable|image|max:10240',
        ]);

        if ($validator->fails()) {
            return $this->responseTemplate(null, false, $validator->errors());
        }
        
        try {
            DB::beginTransaction();

            // Get the data and add the image path if it was uploaded
            $data = $request->only($this->targetModel->getFillable());
            
            // Handle the image upload if it exists
            if ($request->hasFile('image')) {
                file_exists($grade->image) && unlink($grade->image);
                $data['image'] = str_replace('public/', '', $request->file('image')->store('public/media/users_files'));
            }

            $grade->update($data);
            
            DB::commit();
        } catch(Exception $exception) {
            DB::rollback();

            return $this->responseTemplate(null, false, [__('track_grades.object_error')]);
        }

        return $this->responseTemplate($grade, true, __('track_grades.object_updated'));
    }

    private function activateTrackGrades (TrackGrade $grade) {
        
        if ($grade->pricingPlans()->count() != 3) {
            $grade->is_active = false;
            $grade->save(); 
            
            return $this->responseTemplate(null, false, __('track_grades.canot_be_activated_without_adding_pricing_plans'));
        }
        
        $grade->is_active = !$grade->is_active;
        $grade->save();

        return $this->responseTemplate($grade, true, __('track_grades.object_updated'));
    }

    private function updateGradePrice (Request $request, TrackGrade $grade) {

        $validator = Validator::make($request->all(), [
            'ar_title'        => 'required|max:255',
            'en_title'        => 'required|max:255',
            'ar_description'  => 'required|max:255',
            'en_description'  => 'required|max:255',
            'price'           => 'required|integer', 
            'plan_type'       => 'required|in:1,2,3',
        
            // 'has_sale', 'sale_ratio', 'grade_id'
        ]);

        if ($validator->fails()) {
            return $this->responseTemplate(null, false, $validator->errors());
        }
        
        try {
            DB::beginTransaction();

            $data = $request->only($this->relationModel->getFillable());
            
            $grade->pricingPlans()->where('plan_type', $request->plan_type)->delete();
            
            $grade->pricingPlans()->create($data);
            
            $grade->load(['pricingPlans']);

            DB::commit();
        } catch(Exception $exception) {
            DB::rollback();

            return $this->responseTemplate(null, false, [__('track_grades.object_error')]);
        }

        return $this->responseTemplate($grade, true, __('track_grades.object_updated'));
    }

}
