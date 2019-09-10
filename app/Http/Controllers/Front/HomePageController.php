<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use SEO;

class HomePageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function show()
    {
        SEO::setTitle(__('entities.home'));
        $css = mix('/css/home/page/show.css');

        return view('templates.front.home.page.show', compact('css'));
    }
}
