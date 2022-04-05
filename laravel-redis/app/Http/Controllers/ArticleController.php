<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        if (Cache::has('articles')) {
            $data = Cache::get('articles');
            return response()->json($data, 200);
        }
        $data = Article::all();
        foreach ($data as $item) {
            $item->status = true;
        }        
        Cache::put('articles', $data, 600);
        return response()->json($data, 200);
    }
}