<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}
