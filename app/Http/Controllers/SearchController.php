<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SearchController extends Controller {

    public function search(Request $request) {
        if ($request->ajax()) {
            $output = "";
            $users = DB::table('users')
                    ->where('name', 'LIKE', '%' . $request->search . "%")
                    ->orWhere('email', 'LIKE', '%' . $request->search . "%")
                    ->orWhere('phone', 'LIKE', '%' . $request->search . "%")
                    ->get();
            if ($users) {
                foreach ($users as $key => $user) {
                    $output.='<tr class="fade' . $user->id . '">' .
                            '<th scope="col">' . $user->id . '</th>' .
                            '<th scope="col">' . $user->name . '</th>' .
                            '<th scope="col">' . $user->email . '</th>' .
                            '<th scope="col">' . $user->phone . '</th>' .
                            '<th scope="col">' .
                            '<a href="' . route('edit', ['id' => $user->id]) . '">Edit</a> | ' .
                            '<a class="deleteProduct" data-id="' . $user->id . '" data-token="' . csrf_token() . '" >Delete</a> |' .
                            '<a href="' . route('unverify', ['id' => $user->id]) . '">Unverify</a>' .
                            '</th>' .
                            '</tr>';
                }
                return Response($output);
            }
        }
    }

}
