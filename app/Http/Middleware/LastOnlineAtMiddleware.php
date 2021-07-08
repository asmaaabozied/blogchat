<?php

namespace App\Http\Middleware;

use Closure;

class LastOnlineAtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->guest())
            return $next($request);
        \DB::table('users')->where('id', auth()->user()->id)->update(['last_activity' => now()]);
        return $next($request);

    }
}
