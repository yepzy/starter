<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\News\NewsArticle;
use Illuminate\Contracts\View\View;

class NewsArticlesController extends Controller
{
    public function show(NewsArticle $article): View
    {
        if (! $article->active) {
            abort(404);
        }
        if ($article->published_at->gt(now())) {
            abort(404);
        }
        $article->displaySeoMeta();

        return view('templates.front.news.articles.show', compact('article'));
    }
}
