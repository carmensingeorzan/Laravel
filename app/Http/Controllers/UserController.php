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
     * Show the application dashboard.
     */
    public function index() {
        $users = User::all();
        return view('user/home', array('users' => $users));
    }

    /**
     * Update User.
     *
     * @params $id
     */
    public function edit($id) {

        $user = User::find($id);
        return view('user/edit', array('user' => $user));
    }

    /**
     * Update User.
     *
     * @params $request, $id
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'numeric',
            'terms' => 'required'
        ]);

        $user = User::find($id);
        $user->name = request('name');
        $user->email = request('email');
        $user->phone = request('phone');
        $user->terms = (request('terms') == 'on') ? 1 : 0;
        $user->terms_accepted_datetime = ((request('terms') == 'on') && ($user->terms_accepted_datetime == NULL)) ? date('Y-m-d H:i:s') : $user->terms_accepted_datetime;
        $user->save();

        return redirect('home')->with('success', 'User ' . request('name') . ' has successfully updated!');
    }

    /**
     * Delete User.
     *
     * @params $id
     */
    public function destroy($id) {
        User::find($id)->delete();
        return response()->json([
                    'success' => true
        ]);
    }

    /**
     * Unverify email address of User.
     *
     * @params $id
     */
    public function unverify($id) {
        $user = User::find($id);
        $user->confirmed_email = 0;
        $user->save();

        return back()->with('success', 'The user email status set as unverified!');
    }
}
