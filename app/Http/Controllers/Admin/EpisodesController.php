<?php

namespace App\Http\Controllers\Admin;
use LaravelLocalization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Episode;
use App\Http\Traits\ResponseTemplate;
use Illuminate\Support\Facades\Storage;

class EpisodesController extends Controller
{
    use ResponseTemplate;

    private $targetModel;

    public function __construct() {
        $this->targetModel = new Episode;
    }

    public function index(Request $request) {
        $lang = LaravelLocalization::getCurrentLocale();

        $permissions = auth()->user()->category == 'admin' 
            ? 'admin' 
            : $this->getPermissions(['news_add', 'news_edit', 'news_delete', 'news_show']);

        if ($request->ajax()) {
            $model = $this->targetModel->query()
                ->with('playlist')
                ->adminFilter();

            $datatableModel = Datatables::of($model)
                ->addColumn('playlist', function ($row) {
                    return $row->playlist ? $row->playlist->ar_title . ' / ' . $row->playlist->en_title : '';
                })
                ->addColumn('activation', function ($row_object) use ($permissions) {
                    return view('admin.episodes.incs._active', compact('row_object', 'permissions'));
                })
                ->addColumn('actions', function ($row_object) use ($permissions) {
                    return view('admin.episodes.incs._actions', compact('row_object', 'permissions'));
                })
                ->rawColumns(['activation', 'actions']);

            return $datatableModel->make(true);
        }

        return view('admin.episodes.index', compact('lang','permissions'));
    }
    
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'ar_title' => 'required|max:255',
            'en_title' => 'required|max:255',
            'ar_description' => 'nullable|max:255',
            'en_description' => 'nullable|max:255',
            'number' => '',
            'time' => '',
            'playlist_id' => 'required',
            'video'=>'url',
            'sound_link' => 'nullable|url',
            'spotify_link' => 'nullable|url',
            'titok_link' => 'nullable|url',
            'youtube_link' => 'nullable|url',
        ]);
    
        if ($validator->fails()) {
            return $this->responseTemplate(null, false, $validator->errors());
        }
    
        try {
            DB::beginTransaction();
            $data = $request->only($this->targetModel->getFillable());
    
            $news = $this->targetModel->create($data);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollback();
            return $this->responseTemplate(null, false, [__('news.object_error')]);
        }
    
        return $this->responseTemplate($news, true, __('news.object_created'));
    }
    
    

    public function show($id) {
        $news = $this->targetModel->with(['playlist'])->find($id);

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

    private function updateNews(Request $request, Episode $news) {
        $validator = Validator::make($request->all(), [
           'ar_title' => 'required|max:255',
            'en_title' => 'required|max:255',
            'ar_description' => 'nullable|max:255',
            'en_description' => 'nullable|max:255',
            'number' => '',
            'time' => '',
            'playlist_id' => 'required',
            'video'=>'url',
            'sound_link' => 'nullable|url',
            'spotify_link' => 'nullable|url',
            'titok_link' => 'nullable|url',
            'youtube_link' => 'nullable|url',
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

    private function activateNews(Episode $news) {
        $news->is_active = !$news->is_active;
        $news->save();

        return $this->responseTemplate($news, true, __('news.object_updated'));
    }
}
