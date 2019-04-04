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
        $robotsTxtContent = app()->environment() == 'production'
            ? <<<EOT
User-agent: *
Disallow:
EOT
            : <<<EOT
User-agent: *
Disallow: /
EOT;

        // todo: declare sitemap
        return response()->make($robotsTxtContent)
            ->header('Content-Type', 'text/plain');
    }
}
