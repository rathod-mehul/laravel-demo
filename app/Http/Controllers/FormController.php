<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
        ], [
            'name' => 'Name lakho',
            'email.required' => 'Email lakho',
            'email.email' => 'Email Should Be Proper',
        ]);

        return $request->all();
    }
}
