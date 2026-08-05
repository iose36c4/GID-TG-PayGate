<?php

namespace App\Http\Middleware;

use App\Helpers\Installation;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotInstalled
{
    protected array $allowedRoutes = [
        'install*',
        '_install*',
        'css/*',
        'js/*',
        'images/*',
        'fonts/*',
        'favicon.ico',
        'robots.txt',
        'sitemap*.xml',
        'health',
        'up',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        if (Installation::isInstalled()) {
            return $next($request);
        }

        foreach ($this->allowedRoutes as $pattern) {
            if ($request->is($pattern)) {
                return $next($request);
            }
        }

        return redirect()->route('install.requirements');
    }
}
