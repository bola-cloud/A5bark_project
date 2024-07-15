<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use LaravelLocalization;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Course;

use App\Http\Traits\ResponseTemplate;

class CourseController extends Controller
{
    use ResponseTemplate;

    private $targetModel;

    public function __construct () {
        $this->targetModel   = new Course;
    }

    public function index (Request $request) {

        $lang = LaravelLocalization::getCurrentLocale();

        $permissions = auth()->user()->category == 'admin' 
            ? 'admin' 
            : $this->getPermissions(['courses_add', 'courses_edit', 'courses_delete', 'courses_show']);
        
        if ($request->ajax()) {
            $model = $this->targetModel->query()
            ->withCount(['subscriptions'])
            ->with(['trainer', 'categories'])
            ->adminFilter();
            
            $datatable_model = Datatables::of($model)
            ->addColumn('created_at', function ($row_object) use ($lang) {
                return isset($row_object->created_at) ? explode(' ', $row_object->created_at)[0] : '---';
            })
            ->addColumn('subscription_long', function ($row_object) use ($lang) {
                return $row_object->subscription_type == 'limitted' ? $row_object->subscription_long . ' / month': '---';
            })
            ->addColumn('title', function ($row_object) use ($lang) {
                return $lang == 'ar' ? $row_object->ar_title : $row_object->en_title;
            })
            ->addColumn('categories', function ($row_object) use ($lang) {
                return view('admin.courses.incs._categories', compact('row_object', 'lang'));
            })
            ->addColumn('trainer', function ($row_object) use ($lang) {
                return $row_object->trainer->name;
            })
            ->addColumn('price', function ($row_object) use ($lang) {
                return $row_object->price . ' ' . ENV('APP_CURRENCY');
            })
            ->addColumn('trainer_ratio', function ($row_object) use ($lang) {
                return $row_object->trainer_ratio . '%';
            })
            ->addColumn('media_btn', function ($row_object) use ($permissions) {
                return view('admin.courses.incs._media_btn', compact('row_object', 'permissions'));
            })
            ->addColumn('top_course', function ($row_object) use ($permissions) {
                return view('admin.courses.incs._top_course', compact('row_object', 'permissions'));
            })
            ->addColumn('activation', function ($row_object) use ($permissions) {
                return view('admin.courses.incs._active', compact('row_object', 'permissions'));
            })
            ->addColumn('actions', function ($row_object) use ($permissions) {
                return view('admin.courses.incs._actions', compact('row_object', 'permissions'));
            });

            return $datatable_model->make(true);
        }
        
        return view('admin.courses.index', compact('permissions', 'lang'));
    }

    public function store (Request $request) {
        $validator = Validator::make($request->all(), [
            'ar_title'        => 'required|max:255',
            'en_title'        => 'required|max:255',
            'ar_description'  => 'required|max:9999',
            'en_description'  => 'required|max:9999',
            'price'           => 'required|min:1',
            'trainer_ratio'   => 'required|min:1|max:100',
            'trainer_id'      => 'required|exists:trainers,user_id',
            'categories'      => 'required|exists:course_categories,id',
            'subscription_type' => 'required|in:limitted,unlimitted',
            'subscription_long' => 'required_if:subscription_type,limitted',
            'image'             => 'required|image|max:10000'
        ]);

        if ($validator->fails()) {
            return $this->responseTemplate(null, false, $validator->errors());
        }
        
        $data = $request->only($this->targetModel->getFillable());
        
        if ($request->hasFile('image'))
        $data['image'] = str_replace('public/', '', $request->file('image')->store('public/media/course_cover_image'));
        
        try {
            DB::beginTransaction();

                $course = $this->targetModel->create($data);
                $course->categories()->sync(is_array($request->categories) ? $request->categories : explode(',', $request->categories));

            DB::commit();
        } catch(Exception $exception) {
            DB::rollback();

            return $this->responseTemplate(null, false, [__('courses.object_error')]);
        }

        return $this->responseTemplate($course, true, [__('courses.new_user_was_created')]);
    }

    public function show (Request $request, $id) {
        $course = $this->targetModel->query()
        ->with(['trainer', 'categories', 'lessions'])->find($id);
        
        if (!isset($course)) {
            return $this->responseTemplate(null, false, __('courses.object_not_found'));
        }

        return $this->responseTemplate($course, true);
    }

    public function update (Request $request, $id) {

        $course = $this->targetModel->find($id);
        
        if (!isset($course)) {
            return $this->responseTemplate(null, false, __('courses.object_not_found'));
        }

        if (isset($request->activate_object)) {
            return $this->activateCourse($request, $course);
        } else if (isset($request->is_top_object)) {
            return $this->isTopCourseCourse($request, $course);
        } 

        return $this->updateCourse($request, $course);
    }

    public function destroy (Request $request, $id) {
        $course = $this->targetModel->find($id);
        
        if (!isset($course)) {
            return $this->responseTemplate(null, false, __('courses.object_not_found'));
        }

        $course->delete();

        return $this->responseTemplate($course, true, __('courses.object_deleted'));   
    }

    public function dataAjax (Request $request) {
    	$data = [];

        if($request->has('q')){
            $search = $request->q;
            $query  = $this->targetModel->query()
                    ->select("id", "ar_title", "en_title")
                    ->where(function ($q) use ($search) {
                        $q->orWhere('ar_title','LIKE',"%$search%");
                        $q->orWhere('en_title','LIKE',"%$search%");
                    });
            
            if (isset($request->is_active)) 
            $query->where('is_active', $request->is_active);

            $data = $query->get();
        }

        return response()->json($data);
    }

    //  HELPER METHODS
    private function updateCourse (Request $request, Course $course) {
        $validator = Validator::make($request->all(), [
            'ar_title'        => 'required|max:255',
            'en_title'        => 'required|max:255',
            'ar_description'  => 'required|max:9999',
            'en_description'  => 'required|max:9999',
            'price'           => 'required|min:1',
            'trainer_ratio'   => 'required|min:1|max:100',
            'trainer_id'      => 'required|exists:trainers,user_id',
            'categories'      => 'required|exists:course_categories,id',
            'subscription_type' => 'required|in:limitted,unlimitted',
            'subscription_long' => 'required_if:subscription_type,limitted',
        ]);

        if ($validator->fails()) {
            return $this->responseTemplate(null, false, $validator->errors());
        }
        
        $data = $request->only($this->targetModel->getFillable());

        try {
            DB::beginTransaction();
                    
            // Handle the image upload if it exists
            if ($request->hasFile('image')) {
                file_exists($course->image) && unlink($course->image);
                $data['image'] = str_replace('public/', '', $request->file('image')->store('public/media/course_cover_image'));
            }

            $course->update($data);
            $course->categories()->sync(is_array($request->categories) ? $request->categories : explode(',', $request->categories));

            DB::commit();
        } catch(Exception $exception) {
            DB::rollback();

            return $this->responseTemplate(null, false, [__('courses.object_error')]);
        }

        return $this->responseTemplate($course, true, [__('courses.object_updated')]);
    }
    
    private function activateCourse (Request $request, Course $course) {

        if ($course->lessions()->count() == 0 ) {
            return $this->responseTemplate(null, false, [__('courses.course_require_lession_to_activated')]);
        } 

        try {
            DB::beginTransaction();
            
            $course->is_active = !$course->is_active;
            $course->save();

            DB::commit();
        } catch(Exception $exception) {
            DB::rollback();

            return $this->responseTemplate(null, false, [__('courses.object_error')]);
        }

        return $this->responseTemplate($course, true, __('courses.object_updated'));
    }

    private function isTopCourseCourse (Request $request, Course $course) {
        
        if ($course->lessions()->count() == 0 ) {
            return $this->responseTemplate(null, false, [__('courses.course_require_lession_to_activated')]);
        } 

        try {
            DB::beginTransaction();
            
            $course->is_top_course = !$course->is_top_course;
            $course->save();

            DB::commit();
        } catch(Exception $exception) {
            DB::rollback();

            return $this->responseTemplate(null, false, [__('courses.object_error')]);
        }

        return $this->responseTemplate($course, true, __('courses.object_updated'));
    }

}
