<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\User;

class LoginController extends Controller {
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
    protected $redirectTo = '/home';

    /**
     * user has unsuccessfully tried to login 10 times
     */
    protected $maxAttempts = 10;

    /**
     * blocked from logging in for 30 seconds
     */
    protected $decayMinutes = 0.5;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request) {

        $rules = [
            $this->username() => 'required',
            'password' => 'required',
        ];

        $this->validate($request, $rules, []);
    }
    
    public function maxAttempts() {
        return property_exists($this, 'maxAttempts') ? $this->maxAttempts : 5;
    }

    public function decayMinutes() {
        return property_exists($this, 'decayMinutes') ? $this->decayMinutes : 1;
    }

}
