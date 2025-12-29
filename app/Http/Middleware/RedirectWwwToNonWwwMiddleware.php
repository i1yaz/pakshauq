<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectWwwToNonWwwMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (str_starts_with($request->getHost(), 'www.')) {
            $newUrl = 'https://' . substr($request->getHost(), 4) . $request->getPathInfo();

            return redirect($newUrl, 301);
        }

        return $next($request);
    }
}
