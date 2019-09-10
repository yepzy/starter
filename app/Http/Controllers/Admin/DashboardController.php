<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Utils\SeoService;
use SEO;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        SEO::setTitle(__('entities.dashboard'));

        return view('templates.admin.dashboard.index');
    }
}
