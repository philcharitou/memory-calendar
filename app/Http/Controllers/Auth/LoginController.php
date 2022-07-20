<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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

    public function showLoginForm()
    {
        $date = "2023-07-27 00:00:00";
        $date_tmp = Carbon::createFromDate($date);
        $days_left = $date_tmp->diffInDays(Carbon::now());

        return view('auth.login', compact('days_left'));
    }

    public function passwordLogin(Request $request){

        if($request->has('password')){
            if(Auth::attempt(['email' => 'passwordlogin@yoursite.com', 'password' => $request->input('password')])) {
                // User has the correct password
                return redirect('/');
            }
        }

        // Login failed
        return redirect()->intended('/login');
    }

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
}
