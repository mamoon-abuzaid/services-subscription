<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Students;
class StudentApiController extends Controller
{
    public function create(Request $request){

        $students = new Students();
        $students->fname = $request->input ('fname');
        $students->lname = $request->input ('lname');
        $students->age = $request->input ('age');

        $students->save();
        return response()->json($students);
    }
    //
}
