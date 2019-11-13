<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\SimplePage;
use App\Services\Seo\SeoService;

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
        $simplePage = (new SimplePage)->where('url', $url)->where('active', true)->firstOrFail();
        (new SeoService)->displayMetaTagsFromModel($simplePage);
        $css = mix('/css/simple-pages/show.css');

        return view('templates.front.simple-pages.show', compact('simplePage', 'css'));
    }
}
