<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Motion;
use App\Models\Adverticement;

class HomeController extends Controller
{
    public function index()
    {
        // Get active adverticement
        $adverticement = Adverticement::where('is_active', 1)->first();
        $adverticementArray = $adverticement ? $adverticement->toArray() : [];
        if (!empty($adverticementArray)) {
            $adverticementArray['image'] = 'media/' . $adverticementArray['image'];
        }

        // Get active motion
        $motion = Motion::where('is_active', 1)->first();
        $motionArray = $motion ? $motion->toArray() : [];
        if (!empty($motionArray)) {
            $motionArray['image'] = 'media/' . $motionArray['image'];
        }

        // Get the latest news from each category
        $categories = NewsCategory::all();
        $newsItems = [];

        foreach ($categories as $category) {
            $latestNews = $category->news()->where('is_active', 1)
                ->orderBy('created_at', 'desc')
                ->with('newsCategory')  // Eager load the newsCategory relationship
                ->first();
            if ($latestNews) {
                $newsItemArray = $latestNews->toArray();
                $newsItemArray['image'] = 'media/' . $newsItemArray['image'];
                $newsItems[] = $newsItemArray;
            }
        }

        // If we have less than 4 news items, fill the rest with the latest news overall
        if (count($newsItems) < 4) {
            $additionalNews = News::where('is_active', 1)
                ->orderBy('created_at', 'desc')
                ->with('newsCategory')  // Eager load the newsCategory relationship
                ->take(4 - count($newsItems))
                ->get()
                ->toArray();

            // Merge the additional news, ensuring no duplicates
            foreach ($additionalNews as $news) {
                $news['image'] = 'media/' . $news['image'];
                if (!in_array($news, $newsItems)) {
                    $newsItems[] = $news;
                }
            }
        }

        // Ensure we return only the latest 4 news items
        $newsItems = array_slice($newsItems, 0, 4);

        // Prepare the response data
        $data = [
            'adverticement' => $adverticementArray,
            'motion' => $motionArray,
            'news' => $newsItems,
        ];

        return response()->json([
            'status' => true,
            'message' => 'Data retrieved successfully',
            'data' => $data
        ]);
    }
}
