<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param $permission
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$permission)
    {
        if (!(auth()->user()->tokenCan($permission)))
        {
           abort(403);
        }

        return $next($request);
    }
}
