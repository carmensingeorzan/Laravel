<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\TermService;
use Auth;

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
    public function index(Request $request) {
        $user = auth()->user();
        if ($user->confirmed_email) {
            $users = User::all();
            return view('user/home', array('users' => $users));
        } else {
            Auth::logout();
            return redirect()->route('login', ['email' => $user->email]);
        }
    }

    /**
     * Update User.
     *
     * @params $id
     */
    public function edit($id) {

        $term = TermService::latest('publication_date')->first();
        $user = User::find($id);

        $add_message = '';
        if ($term->id != $user->term_id) {
            $add_message = 'You have accepted an oldest term service.';
        };

        return view('user/edit', array('user' => $user, 'add_message' => $add_message));
    }

    /**
     * Update User.
     *
     * @params $request, $id
     */
    public function update(Request $request, $id) {

        $flag = false;

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'numeric',
            'terms' => 'required'
        ]);

        $user = User::find($id);
        $user->name = request('name');

        if ($user->email != request('email')) {
            $user->confirmed_email = 0;
            $user->email = request('email');
            $flag = true;
        } else {
            $user->email = request('email');
        }
        $user->phone = request('phone');
        $user->terms = (request('terms') == 'on') ? 1 : 0;
        $user->terms_accepted_datetime = ((request('terms') == 'on') && ($user->terms_accepted_datetime == NULL)) ? date('Y-m-d H:i:s') : $user->terms_accepted_datetime;
        $user->save();

        $flash_message = 'User ' . request('name') . ' has successfully updated!';

        if ($flag) {
            $name = request('name');
            $email = request('email');

            $d = array('url' => url("/acceptEmail/{$user->id}"));

            Mail::send('emails.confirm_mail', $d, function($message) use ($name, $email) {
                $message->to($email, $name)->subject('Laravel Confirm Email Address');
                $message->from('carmen.test.send.email@gmail.com', 'Laravel Site');
            });
            $flash_message = $flash_message . " " . $email . " need to confirm the email address.";
        }

        return redirect('home')->with('success', $flash_message);
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

    public function accept($user_id) {

        $term = TermService::latest('publication_date')->first();

        $user = User::find($user_id);
        $user->term_id = $term->id;
        $user->save();

        return back()->with('success', 'The current published term was accepted!');
    }

}
