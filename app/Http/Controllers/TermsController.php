<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\TermService;
use App\User;

class TermsController extends Controller {

    /**
     * Show the application terms page.
     */
    public function show() {
        $terms = TermService::all();
        return view('terms/show', array('terms' => $terms));
    }

    /**
     * Show the application terms page.
     */
    public function showLatest() {
        $term = TermService::latest('publication_date')->first();
        return view('terms/show_latest_term', array('term' => $term));
    }

    /**
     * Add new term object.
     */
    public function add() {
        return view('terms/add');
    }

    /**
     * Create a new term object.
     *
     */
    protected function create(Request $request) {
        TermService::create([
            'administrative_name' => $request->administrative_name,
            'content' => $request->content,
            'published' => ($request->published == 'on') ? 1 : 0,
            'publication_date' => ($request->published == 'on') ? date('Y-m-d H:i:s') : NULL
        ]);
        return redirect('terms/show')->with('success', 'Term service ' . $request->administrative_name . ' has successfully created!');
    }

    public function publish($id) {

        $term = TermService::find($id);
        $term->published = 1;
        $term->publication_date = date('Y-m-d H:i:s');
        $term->save();

        return redirect('terms/show')->with('success', 'Term has been published!');
    }

    public function view($id) {

        $term = TermService::find($id);
        return view('terms/show_latest_term', array('term' => $term));
    }

    public function edit($id) {
        $term = TermService::find($id);
        return view('terms/edit', array('term' => $term));
    }

    public function update(Request $request, $id) {

        $term = TermService::find($id);
        $term->administrative_name = request('administrative_name');
        $term->content = request('content');
        $term->published = (request('published') == 'on') ? 1 : 0;
        $term->publication_date = (request('published') == 'on') ? date('Y-m-d H:i:s') : $term->publication_date;
        $term->save();

        $users = User::all();
        foreach ($users as $user) {

            $name = $user->name;
            $email = $user->email;

            $d = array(
                'url_updated_term' => url("/terms/view/{$id}"),
                'url_latest_term' => url("/terms/showLatest")
            );

            Mail::send('emails.updated_term_mail', $d, function($message) use ($name, $email) {
                $message->to($email, $name)->subject('Laravel Updated Term');
                $message->from('carmen.test.send.email@gmail.com', 'Laravel Site');
            });
        }
        
        return redirect('terms/show')->with('success', 'Term ' . $term->administrative_name . ' has successfully updated! An email has sent to all users.');
    }

    /**
     * Delete Term.
     *
     * @params $id
     */
    public function delete($id) {
        TermService::find($id)->delete();
        return redirect('terms/show')->with('success', 'Term has been deleted!');
    }

}
