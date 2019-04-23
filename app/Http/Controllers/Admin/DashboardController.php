<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Utils\SeoService;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        (new SeoService)->seoMeta(__('entities.dashboard'));

        return view('templates.admin.dashboard.index');
    }
}
