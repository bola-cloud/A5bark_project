<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Festival;
use App\Models\Event;

class FestivalController extends Controller
{
    public function index()
    {
        $festival=Festival::where('is_active',1)->get();
        $events=Event::where('is_active',1)->get();
        return view('front.event',compact('festival','events'));
    }
    public function event($id)
    {
        $event=Event::find($id);
        return view('front.concert',compact('event'));
    }
}
