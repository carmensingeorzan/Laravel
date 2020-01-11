<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\User;
use Auth;

class MailController extends Controller {
     
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function confirmEmail($email) {
        $user = User::where('email', $email)->first();
        $name = $user->name;

        $data = array('url' => url("/acceptEmail/{$user->id}"));

        Mail::send('emails.confirm_mail', $data, function($message) use ($name, $email) {
            $message->to($email, $name)->subject('Laravel Confirm Email Address');
            $message->from('carmen.test.send.email@gmail.com', 'Laravel Site');
        });

        return back()->with('success', 'The email has been sent to ' . $email . '!');
    }

    public funcTion acceptEmail($id) {
        $user = User::find($id);
        $user->confirmed_email = 1;
        $user->save();
        
        Auth::loginUsingId($id);
        return redirect('/home')->with('success', 'The email ' . $user->email . ' has been confirmed!');
    }

}
