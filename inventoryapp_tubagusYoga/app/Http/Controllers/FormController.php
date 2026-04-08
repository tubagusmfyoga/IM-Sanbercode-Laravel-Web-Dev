<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function welcome(Request $request){
        $firstName = $request->input('first-name');
        $lastName = $request->input('last-name');
        return view('welcome', ['firstName' => $firstName, 'lastName' => $lastName]);
    }
}
