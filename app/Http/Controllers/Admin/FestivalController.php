<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Festival;
use App\Http\Traits\ResponseTemplate;
use Illuminate\Support\Facades\Storage;
use LaravelLocalization;


class FestivalController extends Controller
{
    use ResponseTemplate;

    private $targetModel;

    public function __construct() {
        $this->targetModel = new Festival;
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
                    return view('admin.festival.incs._active', compact('row_object', 'permissions'));
                })
                ->addColumn('actions', function ($row_object) use ($permissions) {
                    return view('admin.festival.incs._actions', compact('row_object', 'permissions'));
                })
                ->rawColumns(['activation', 'actions']);

            return $datatableModel->make(true);
        }

        return view('admin.festival.index', compact('lang','permissions'));
    }
    
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'ar_title' => 'required|max:255',
            'en_title' => 'required|max:255',
            'media' => '',
            'start_date' => 'nullable|date',
        ]);
    
        if ($validator->fails()) {
            return $this->responseTemplate(null, false, $validator->errors());
        }
    
        try {
            DB::beginTransaction();
            $data = $request->only($this->targetModel->getFillable());
    
            if ($request->hasFile('media')) {
                $data['media'] = $request->file('media')->store('festival_images', 'media');
            } 
    
            $festival = $this->targetModel->create($data);
            DB::commit();
    
            return $this->responseTemplate($festival, true, __('festival.object_created'));
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->responseTemplate(null, false, [__('festival.object_error')]);
        }
    }
    
    
    

    public function show($id) {
        $news = $this->targetModel->find($id);

        if (!isset($news)) {
            return $this->responseTemplate(null, false, __('news.object_not_found'));
        }
        if ($news->media) {
            $news->media = asset('media/' . $news->media);
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

    private function updateNews(Request $request, Festival $news) {
        $validator = Validator::make($request->all(), [
           'ar_title' => 'required|max:255',
            'en_title' => 'required|max:255',
            'media' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'start_date'=> 'nullable||date',
        ]);
    
        if ($validator->fails()) {
            return $this->responseTemplate(null, false, $validator->errors());
        }
    
        try {
            DB::beginTransaction();

            $data = $request->only($this->targetModel->getFillable());

            if ($request->hasFile('media')) {
                if ($news->media) {
                    Storage::disk('media')->delete($news->image);
                }
                $data['media'] = $request->file('media')->store('festival_images', 'media');
            } else {
                unset($data['media']);
            }

            $news->update($data);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->responseTemplate(null, false, [__('news.object_error')]);
        }
    
        return $this->responseTemplate($news, true, __('news.object_updated'));
    }

    private function activateNews(Festival $news) {
        $news->is_active = !$news->is_active;
        $news->save();

        return $this->responseTemplate($news, true, __('news.object_updated'));
    }

    public function dataAjax(Request $request) {
    	$data = [];
        if($request->has('q')){
            $search = $request->q;

            $model = $this->targetModel->query()
            ->where('is_active', 1);

            $data = $model->where(function ($q) use ($request) {
                $q->orWhere('ar_title', 'like', "%$request->q%");
                $q->orWhere('en_title', 'like', "%$request->q%");
            })->get();
        }

        return response()->json($data);
    }
}
