<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;

class NewsController extends Controller
{
    public function index()
    {
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
            'news' => $newsItems,
            'categories' => NewsCategory::all()->toArray(),
        ];

        return response()->json([
            'status' => true,
            'message' => 'Data retrieved successfully',
            'data' => $data
        ]);
    }

    public function targetNews($id)
    {
        // Find the news item by id and eager load the newsCategory relationship
        $news = News::with('newsCategory')->find($id);

        if (!$news || !$news->is_active) {
            return response()->json([
                'status' => false,
                'message' => 'News item not found or inactive',
                'data' => []
            ], 404);
        }

        // Convert the news item to an array and prepend 'media/' to the image path
        $newsArray = $news->toArray();
        $newsArray['image'] = 'media/' . $newsArray['image'];

        // Prepare the response data
        $data = [
            'news' => $newsArray,
            'category' => $news->newsCategory ? $news->newsCategory->toArray() : null,
        ];

        return response()->json([
            'status' => true,
            'message' => 'Data retrieved successfully',
            'data' => $data
        ]);
    }
}
