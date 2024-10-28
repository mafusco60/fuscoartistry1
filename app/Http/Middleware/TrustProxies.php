<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrustProx<?php
namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Fideloper\Proxy\TrustProxies as BaseTrustProxies;

class TrustProxies extends BaseTrustProxies
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string|null
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
/**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): *(\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
}
