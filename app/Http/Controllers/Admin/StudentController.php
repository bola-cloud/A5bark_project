<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use LaravelLocalization;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Mail;
use App\Enums\TokenAbility;

use App\Models\User;
use App\Models\Student;

use App\Http\Traits\StudentTrait;
use App\Http\Traits\ResponseTemplate;

class StudentController extends Controller
{
    use StudentTrait;
    use ResponseTemplate;

    private $subModel;
    private $targetModel;

    public function __construct () {
        $this->targetModel = new User;
        $this->subModel    = new Student;
    }

    public function index (Request $request) {

        $lang = LaravelLocalization::getCurrentLocale();

        $permissions = auth()->user()->category == 'admin' 
            ? 'admin' 
            : $this->getPermissions(['students_add', 'students_edit', 'students_delete', 'students_show']);
        
        if ($request->ajax()) {
            $model = $this->targetModel->query()
            ->where('category', 'student')
            ->with(['student.gove', 'student.cent', 'parent'])
            ->adminFilter();

            if ($request->filled('gove')) {
                $model->whereHas('student', fn ($q) => $q->where('students.gove_id', $request->gove));
            }

            if ($request->filled('cent')) {
                $model->whereHas('student', fn ($q) => $q->where('students.cent_id', $request->cent));
            }

            if ($request->filled('birth_date_from')) {
                $model->whereHas('student', fn ($q) => $q->whereDate('students.birth_date', '>=', $request->birth_date_from));
            }
            
            if ($request->filled('birth_date_to')) {
                $model->whereHas('student', fn ($q) => $q->whereDate('students.birth_date', '<=', $request->birth_date_to));
            }

            if ($request->filled('preferences')) {
                $model->whereHas('student.preferences', fn ($q) => $q->whereIn('course_categories.id', $request->preferences));
            }
            
            $datatable_model = Datatables::of($model)
            ->addColumn('parent_name', function ($row_object) {
                return isset($row_object->parent) ? $row_object->parent->name : '---';
            })
            ->addColumn('parent_phone', function ($row_object) {
                return isset($row_object->parent) ? $row_object->parent->phone : '---';
            })
            ->addColumn('gove', function ($row_object) use ($lang) {
                return view('admin.students.incs._gove', compact('row_object', 'lang'));
            })
            ->addColumn('cent', function ($row_object) use ($lang) {
                return view('admin.students.incs._cent', compact('row_object', 'lang'));
            })
            ->addColumn('preferences', function ($row_object) use ($lang) {
                return view('admin.students.incs._preferences', compact('row_object', 'lang'));
            })
            ->addColumn('birth_date', function ($row_object) use ($lang) {
                return isset($row_object->student->birth_date) ? $row_object->student->birth_date : '---';
            })
            ->addColumn('top_student', function ($row_object) use ($permissions) {
                return view('admin.students.incs._top_student', compact('row_object', 'permissions'));
            })
            ->addColumn('activation', function ($row_object) use ($permissions) {
                return view('admin.students.incs._active', compact('row_object', 'permissions'));
            })
            ->addColumn('actions', function ($row_object) use ($permissions) {
                return view('admin.students.incs._actions', compact('row_object', 'permissions'));
            });

            return $datatable_model->make(true);
        }
        
        return view('admin.students.index', compact('permissions', 'lang'));
    }

    public function store (Request $request) {
        ['success' => $success, 'user' => $user, 'err' => $err] = $this->storeStudent($request);
        
        return $success 
            ? $this->responseTemplate($user, true, [__('students.new_user_was_created')])
            : $this->responseTemplate(null, false, $err);
    }

    public function show ($id) {
        $user = $this->targetModel->query()
        ->where('category', 'student')
        ->with(['student.preferences', 'student.gove', 'student.cent', 'parent', 'wallet'])->find($id);
        
        if (!isset($user)) {
            return $this->responseTemplate(null, false, __('students.object_not_found'));
        }
        
        return $this->responseTemplate($user, true);
    }

    public function update (Request $request, $id) {

        $user = $this->targetModel
        ->where('category', 'student')
        ->find($id);
        
        if (!isset($user)) {
            return $this->responseTemplate(null, false, __('students.object_not_found'));
        }

        if ($request->activate_object) {
            return $this->activateUser($request, $user);
        } else if (isset($request->is_top_object)) {
            return $this->topStudentUser($request, $user);
        } 

        return $this->updateUser($request, $user);
    }

    public function destroy ($id) {
        $user = $this->targetModel->where('category', 'student')->find($id);
        
        if (!isset($user)) {
            return $this->responseTemplate(null, false, __('students.object_not_found'));
        }

        $user->delete();

        return $this->responseTemplate($user, true, __('students.object_deleted'));   
    }

    public function dataAjax (Request $request) {
    	$data = [];

        if($request->has('q')){
            $search = $request->q;
            $query = $this->targetModel->query()
                    ->select("id", "name", "phone", "email")
                    ->where('category', 'student')
                    ->where(function ($q) use ($search) {
                        $q->orWhere('name','LIKE',"%$search%");
                        $q->orWhere('email','LIKE',"%$search%");
                        $q->orWhere('phone','LIKE',"%$search%");
                    });

            if (isset($request->no_parent))
            $query->where('parent_id', null);

            $data = $query->get();
        }

        return response()->json($data);
    }

    //  HELPER METHODS
    private function updateUser (Request $request, User $user) {
        ['success' => $success, 'user' => $user, 'err' => $err] = $this->updateStudent($request, $user);
        
        return $success 
            ? $this->responseTemplate($user, true, [__('students.object_updated')], 201)
            : $this->responseTemplate(null, false, $err, 403);
    }
    
    private function activateUser (Request $request, User $user) {
        try {
            DB::beginTransaction();
            
            $user->is_active = !$user->is_active;
            $user->save();

            DB::commit();
        } catch(Exception $exception) {
            DB::rollback();

            return $this->responseTemplate(null, false, [__('students.object_error')]);
        }

        return $this->responseTemplate($user, true, __('students.object_updated'));
    }

    private function topStudentUser (Request $request, User $user) {
        try {
            DB::beginTransaction();
            $student = $user->student;

            $student->is_top_student = !$student->is_top_student;
            $student->save();

            DB::commit();
        } catch(Exception $exception) {
            DB::rollback();

            return $this->responseTemplate(null, false, [__('students.object_error')]);
        }

        return $this->responseTemplate($user, true, __('students.object_updated'));
    }

}

