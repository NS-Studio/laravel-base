<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user() !== null && auth()->user()->hasAnyRole('admin', 'developer')) {

            return $next($request);
        } else {

            return redirect()->to('/');
        }
    }
}
