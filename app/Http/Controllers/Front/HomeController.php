<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Motion;
use App\Models\Adverticement;

class HomeController extends Controller
{
    public function index()
    {
        $adverticement = Adverticement::where('is_active', 1)->get();
        $motion = Motion::where('is_active', 1)->get();
        $news = News::where('is_active', 1)->get();
        // $news = News::orderBy('id', 'desc')->paginate(10);
        return view('front.home',compact('news','motion','adverticement'));
    }
}
