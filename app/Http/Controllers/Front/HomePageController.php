<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\HomePage;
use App\Services\Seo\SeoService;

class HomePageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function show()
    {
        /** @var \App\Models\HomePage $homePage */
        $homePage = (new HomePage)->firstOrFail();
        (new SeoService)->displayMetaTagsFromModel($homePage);
        $css = mix('/css/home/page/show.css');

        return view('templates.front.home.page.show', compact('homePage', 'css'));
    }
}
