<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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

        $user = Auth::user();  // Obtén el usuario autenticado

        if ($user->hasRole('customer')) {
            return redirect('welcome');
        }

        if ($user->hasRole('customer_support')) {
            return redirect('admin/customers');
        }

        if ($user->hasRole('administration')) {
            return redirect('home');
        }

        if ($user->hasRole('marketing')) {
            return redirect('admin/products');
        }

        if ($user->hasRole('super_admin')) {
            return redirect('home');
        }

        return '/login';
    }
}
