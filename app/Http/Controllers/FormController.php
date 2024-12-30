<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function store(Request $request)
    {
        // $request = request();

        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'nullable|email:filter',
        // ], [
        //     'name' => 'Name lakho',
        //     'email.required' => 'Email lakho',
        //     'email.email' => 'Email Should Be Proper',
        // ]);

        $validator =  Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required',
            ],
            [
                'name' => 'Name lakho',
                'email.required' => 'Email lakho',
                'email.email' => 'Email Should Be Proper',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        // Retrieve a portion of the validated input...
        $validatedOnly = $validator->safe()->only(['name']);
        $validatedExcept = $validator->safe()->except(['email']);

        return $validatedExcept;
        // return $request->all();
    }
}
