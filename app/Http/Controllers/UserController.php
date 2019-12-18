<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Update User.
     *
     * @params Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request) {       
        
        $user = User::find($request->input('id'));        
        return view('user/user', array('user' => $user));
    }

    public function update(Request $request) {
       $this->validate(request(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'numeric',
            'terms' => 'required'
        ]);
       
        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->confirmed_email = request('confirmed_email');
        $user->phone = request('phone');
        $user->terms = request('terms');

        $user->save();

        return back();
    }

}
