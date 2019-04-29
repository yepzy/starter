<?php

namespace App\Http\Controllers\Front;

use App\Services\Utils\SeoService;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function show()
    {
        (new SeoService)->seoMeta(__('entities.home'));
        $css = mix('/css/home/show.css');

        return view('templates.front.home.page.show', compact('css'));
    }
}
