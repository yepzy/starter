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
        $robotsTxtContent = app()->environment() === 'production'
            ? <<<EOT
User-agent: *
Disallow:
EOT
            : <<<EOT
User-agent: *
Disallow: /
EOT;

        return response()->make($robotsTxtContent)
            ->header('Content-Type', 'text/plain');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sitemap()
    {
        //todo: declare sitemap
        $sitemap = 'Empty sitemap';
        return response()->make($sitemap)
            ->header('Content-Type', 'text/plain');
    }
}
