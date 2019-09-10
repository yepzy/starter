<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;

class SeoController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function robotsTxt()
    {
        $sitemap = url('sitemap.xml');
        $robotsTxtContent = app()->environment() === 'production'
            ? <<<EOT
User-agent: *
Disallow:
Sitemap: $sitemap
EOT
            : <<<EOT
User-agent: *
Disallow: /
EOT;

        return response()->make($robotsTxtContent)->header('Content-Type', 'text/plain');
    }
}
