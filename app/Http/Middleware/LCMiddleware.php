<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LCMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (isset(Auth::user()->role->name)) {

            $role = Auth::user()->role->name;

            if ($role === 'LC') {
                return $next($request);
            }
        }
        return redirect('/login');
    }
}
