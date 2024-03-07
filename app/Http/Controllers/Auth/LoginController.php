<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        $user = Auth::user();

        if (
            $user->hasRole('customer') ||
            $user->hasRole('administration') ||
            $user->hasRole('marketing') ||
            $user->hasRole('customer_support') ||
            $user->hasRole('super_admin')
        ) {
            return '/';
        }

        return '/login';
    }
}
