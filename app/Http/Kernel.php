<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        // Laravel's built-in middleware (you were missing these!)
        'auth' => \App\Http\Middleware\Authenticate::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        // Your custom ones
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'client' => \App\Http\Middleware\ClientMiddleware::class,
    ];
}
