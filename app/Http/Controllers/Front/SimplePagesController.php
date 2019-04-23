<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\SimplePage;
use App\Services\Utils\SeoService;

class SimplePagesController extends Controller
{
    /**
     * @param string $url
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function show(string $url)
    {
        $page = (new SimplePage)->where('url', $url)->where('active', true)->firstOrFail();
        (new SeoService)->seoMeta($page->title);
        $css = mix('css/simple-pages.css');

        return view('templates.front.simplePages.show', compact('page', 'css'));
    }
}
