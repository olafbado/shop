<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function redirectTo()
    {
        if (auth()->user()->isAdmin()) {
            return '/admin/dashboard';
        }
        return '/client/panel';
    }

    protected function authenticated($request, $user)
    {
        \Log::info('Authenticated method called for user role: ' . $user->role);
        if ($user->isAdmin()) {
            return redirect('/admin/dashboard');
        }
        return redirect('/client/panel');
    }
}
