<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Motion;
use App\Models\Adverticement;
use App\Models\NewsCategory;
use App\Models\Episode;
use App\Models\Festival;
use App\Models\Event;
use App\Models\PlayList;
use App\Models\Branch;

class HomeController extends Controller
{
    public function index()
    {
        $adverticement = Adverticement::where('is_active', 1)->first();
        $motion = Motion::where('is_active', 1)->get();
        $news = News::where('is_active', 1)->get();
        $podacstEpisode=Episode::where('is_active',1)->where('home_show',1)->first();

        // Get all categories
        $categories = NewsCategory::all();
        $latestNews = [];

        // Get the latest news from each category
        foreach ($categories as $category) {
            $latestNewsItem = $category->news()->where('is_active', 1)
                ->orderBy('created_at', 'desc')
                ->with('newsCategory')  // Eager load the newsCategory relationship
                ->first();
            if ($latestNewsItem) {
                $latestNews[] = $latestNewsItem->toArray();
            }
        }

        // If we have less than 4 news items, fill the rest with the latest news overall
        if (count($latestNews) < 4) {
            $additionalNews = News::where('is_active', 1)
                ->orderBy('created_at', 'desc')
                ->with('newsCategory')  // Eager load the newsCategory relationship
                ->take(4 - count($latestNews))
                ->get()
                ->toArray();

            // Merge the additional news, ensuring no duplicates
            foreach ($additionalNews as $newsItem) {
                if (!in_array($newsItem, $latestNews)) {
                    $latestNews[] = $newsItem;
                }
            }
        }

        // Ensure we return only the latest 4 news items
        $latestNews = array_slice($latestNews, 0, 4);

        // Convert each news item and its newsCategory back to an object
        $latestNews = array_map(function($item) {
            $item = (object) $item;
            if (isset($item->news_category)) {
                $item->news_category = (object) $item->news_category;
            }
            return $item;
        }, $latestNews);

        // Debug the converted latestNews objects
        // dd($latestNews);

        return view('front.home', compact('news', 'motion', 'adverticement', 'latestNews','podacstEpisode'));
    }

    public function advDetails()
    {
        $Adverticement= Adverticement::where('is_active',1)->first();
        return view('front.adverticement',compact('Adverticement'));
    }

    public function about()
    {
        return view('front.about');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $news = News::where('ar_title', 'LIKE', "%{$query}%")->orWhere('en_title', 'LIKE', "%{$query}%")->get();
        $festivals = Festival::where('ar_title', 'LIKE', "%{$query}%")->orWhere('en_title', 'LIKE', "%{$query}%")->get();
        $events = Event::where('ar_title', 'LIKE', "%{$query}%")->orWhere('en_title', 'LIKE', "%{$query}%")->get();
        $playlists = PlayList::where('ar_title', 'LIKE', "%{$query}%")->orWhere('en_title', 'LIKE', "%{$query}%")->get();
        $episodes = Episode::where('ar_title', 'LIKE', "%{$query}%")->orWhere('en_title', 'LIKE', "%{$query}%")->get();
        $advertisements = Adverticement::where('ar_title', 'LIKE', "%{$query}%")->orWhere('en_title', 'LIKE', "%{$query}%")->get();
        $branches = Branch::where('ar_name', 'LIKE', "%{$query}%")->orWhere('en_name', 'LIKE', "%{$query}%")->get();

        return view('front.search_dropdown', compact('query', 'news', 'festivals', 'events', 'playlists', 'episodes', 'advertisements', 'branches'));
    }
}
