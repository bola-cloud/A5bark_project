<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsCategory;
use App\Models\News;
use Carbon\Carbon;

class NewsController extends Controller
{
    public function index(){
        $categories = NewsCategory::where('is_active', 1)->get();
        $news = News::where('is_active', 1)->get();
        $selectedCategory = null;
        return view('front.news', compact('categories', 'news', 'selectedCategory'));
    }

    public function filterByCategory($categoryId){
        $categories = NewsCategory::where('is_active', 1)->get();
        $selectedCategory = NewsCategory::find($categoryId);
        if ($selectedCategory) {
            $news = News::where('is_active', 1)->where('news_category_id', $categoryId)->get();
        } else {
            $news = News::where('is_active', 1)->get();
        }
        return view('front.news', compact('categories', 'news', 'selectedCategory'));
    }

    public function details($id){
        $news = News::find($id);
        return view('front.news-details', compact('news'));
    }
}
