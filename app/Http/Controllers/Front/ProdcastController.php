<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlayList;
use App\Models\Episode;
use App\Models\Podcast;

class ProdcastController extends Controller
{
    public function index()
    {
        $playlists = PlayList::where('is_active',1)->paginate(9);
        $episodes = Episode::where('is_active',1)->paginate(9);
        $podcast = Podcast::where('is_active',1)->first();
        return view('front.podcast',compact('playlists','episodes','podcast'));
    }
    public function episodes($id)
    {
        $playlist=PlayList::find($id);
        $episodes = Episode::where('is_active',1)->where('playlist_id',$playlist->id)->orderBy('number', 'desc')->paginate(9);
        return view('front.episodes',compact('episodes','playlist'));
    }
}
