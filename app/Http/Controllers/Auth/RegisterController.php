<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;

use App\Mail\WelcomeMail;

use App\User;
use App\TermService;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => [
                        'required',
                        'min:8',
                        'regex:/^.*(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).*$/',
                        'confirmed',
                    ],
                    'phone' => 'numeric',
                    'terms' => 'accepted'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {
        
        $term = TermService::latest('publication_date')->first();
        
        $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'phone' => $data['phone'],
                    'terms' => ($data['terms'] == 'on') ? 1 : 0,
                    'term_id' => $term->id,
                    'terms_accepted_datetime' => ($data['terms'] == 'on') ? date('Y-m-d H:i:s') : NULL
        ]);
        
//        Mail::to($data['email'])->send(new WelcomeMail($user));

        return $user;
    }

}
