<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasCompany
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->company_id === null) {
            return redirect('/');
        }

        return $next($request);
    }
}
