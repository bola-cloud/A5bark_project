<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use LaravelLocalization;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Track;

use App\Http\Traits\ResponseTemplate;

class TrackController extends Controller
{
    use ResponseTemplate;

    private $targetModel;

    public function __construct () {
        $this->targetModel = new Track;
    }

    public function index (Request $request) {

        $lang = LaravelLocalization::getCurrentLocale();

        $permissions = auth()->user()->category == 'admin' 
            ? 'admin' 
            : $this->getPermissions(['tracks_add', 'tracks_edit', 'tracks_delete', 'tracks_show']);
        
        if ($request->ajax()) {
            $model = $this->targetModel->query()
            ->with(['grade'])
            ->adminFilter()
            ->orderBy('grade_id', 'desc')
            ->orderBy('order', 'asc');
            
            $datatable_model = Datatables::of($model)
            ->addColumn('title', function ($row_object) use ($lang) {
                return $lang == 'ar' ? $row_object->ar_title : $row_object->en_title;
            })
            ->addColumn('grade', function ($row_object) use ($lang) {
                return isset($row_object->grade)
                    ? ($lang == 'ar' ? $row_object->grade->ar_title : $row_object->grade->en_title)
                    :  '---';
            })
            ->addColumn('courses_btn', function ($row_object) use ($permissions) {
                return view('admin.tracks.incs._courses_btn', compact('row_object', 'permissions'));
            })
            ->addColumn('activation', function ($row_object) use ($permissions) {
                return view('admin.tracks.incs._active', compact('row_object', 'permissions'));
            })
            ->addColumn('actions', function ($row_object) use ($permissions) {
                return view('admin.tracks.incs._actions', compact('row_object', 'permissions'));
            });

            return $datatable_model->make(true);
        }
        
        return view('admin.tracks.index', compact('permissions', 'lang'));
    }

    public function store (Request $request) {
        $validator = Validator::make($request->all(), [
            'ar_title'          => 'required|max:255',
            'en_title'          => 'required|max:255',
            'ar_description'    => 'required|max:9999',
            'en_description'    => 'required|max:9999',
            'order'             => 'required|numeric',
            'grade_id'          => 'required|exists:track_grades,id',
        ]);

        if ($validator->fails()) {
            return $this->responseTemplate(null, false, $validator->errors());
        }
        
        $data = $request->only($this->targetModel->getFillable());

        try {
            DB::beginTransaction();

                // Update track order if required
                $this->updateTrackOrders($request->grade_id, $request->order);

                $track = $this->targetModel->create($data);

            DB::commit();
        } catch(Exception $exception) {
            DB::rollback();

            return $this->responseTemplate(null, false, [__('tracks.object_error')]);
        }

        return $this->responseTemplate($track, true, [__('tracks.new_user_was_created')]);
    }

    public function show (Request $request, $id) {
        $course = $this->targetModel->query()->with(['grade', 'courses'])->find($id);
        
        if (!isset($course)) {
            return $this->responseTemplate(null, false, __('courses.object_not_found'));
        }

        return $this->responseTemplate($course, true);
    }

    public function update (Request $request, $id) {

        $track = $this->targetModel->find($id);
        
        if (!isset($track)) {
            return $this->responseTemplate(null, false, __('tracks.object_not_found'));
        }

        return isset($request->activate_object) 
            ? $this->activateTrack($request, $track)
            : $this->updateTrack($request, $track);
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
            
            if (isset($request->grade_id))
            $query->where('grade_id', $request->grade_id);

            $data = $query->get();
        }

        return response()->json($data);
    }
    
    //  HELPER METHODS
    private function updateTrack (Request $request, Track $track) {
        $validator = Validator::make($request->all(), [
            'ar_title'        => 'required|max:255',
            'en_title'        => 'required|max:255',
            'ar_description'  => 'required|max:9999',
            'en_description'  => 'required|max:9999',
            'order'           => 'required|numeric',
            'grade_id'        => 'required|exists:track_grades,id',
        ]);

        if ($validator->fails()) {
            return $this->responseTemplate(null, false, $validator->errors());
        }
        
        $data = $request->only($this->targetModel->getFillable());
        
        try {
            DB::beginTransaction();
           
                if ($track->order != $request->order) {
                    // Update track order if required
                    $this->updateTrackOrder($request->grade_id, $track->order, $request->order);
                }

                $track->update($data);

            DB::commit();
        } catch(Exception $exception) {
            DB::rollback();

            return $this->responseTemplate(null, false, [__('tracks.object_error')]);
        }

        return $this->responseTemplate($track, true, [__('tracks.object_updated')]);
    }
    
    private function activateTrack (Request $request, Track $course) {
        try {
            DB::beginTransaction();
            
            $course->is_active = !$course->is_active;
            $course->save();

            DB::commit();
        } catch(Exception $exception) {
            DB::rollback();

            return $this->responseTemplate(null, false, [__('tracks.object_error')]);
        }

        return $this->responseTemplate($course, true, __('tracks.object_updated'));
    }

    private function updateTrackOrder ($grade_id, $old_order, $new_order) {
        // Flip track order with onther
        $track = $this->targetModel->query()
            ->where('grade_id', $grade_id)
            ->where('order', $new_order)
            ->first();
        
        if (isset($track)) {
            $track->order = $old_order;
            $track->save();
        }
        
    }

    private function updateTrackOrders ($grade_id, $order) {
        $tracks = $this->targetModel->query()
            ->where('grade_id', $grade_id)
            ->where('order', '>=', $order)
            ->get();
        
        forEach($tracks as $track) {
            $track->order += 1;
            $track->save();
        }
        
    }

}
