<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\TermService;

class TermsController extends Controller {

    /**
     * Show the application terms page.
     */
    public function terms() {
        return view('terms/terms');
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
        $term_service = TermService::create([
            'administrative_name' => $request->administrative_name,
            'content' => $request->content,
            'published' => ($request->published == 'on') ? 1 : 0,
            'publication_date' => ($request->published == 'on') ? date('Y-m-d H:i:s') : NULL
        ]);
        
        return redirect('terms')->with('success', 'Term service ' . $request->administrative_name . ' has successfully created!');
    }

}
