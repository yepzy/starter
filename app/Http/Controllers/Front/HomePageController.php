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
    public function index()
    {
        (new SeoService)->seoMeta(__('entities.home'));
        $css = mix('css/home.css');

        return view('templates.front.home', compact('css'));
    }
}
