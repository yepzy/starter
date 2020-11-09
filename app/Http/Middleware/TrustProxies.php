<?php

namespace App\Http\Middleware;

use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for the application.
     *
     * @var null|string|array
     */
    protected $proxies = '*';

    /**
     * The proxy header mappings.
     *
     * @var null|string|int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
