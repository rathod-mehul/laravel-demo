<?php

namespace App\Http\Controllers;

use App\Mail\UserTestMail;
use App\Models\Details;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\File as RulesFile;
use PharIo\Manifest\Email;

class UserAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authId = Auth::id();
        $users = User::where('id', '!=', $authId)->get();

        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $phones = Phone::all();

        return view('argon_dashboard.pages.users.create', compact('phones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Validate that the name is required, a string, and no longer than 255 characters
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $inputs = [
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password),
        ];

        $user = User::create($inputs);

        return response()->json($user);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $input = Arr::only($request->all(), ['name', 'email']);
        User::where('id', $id)->update($input);
        $user->refresh();

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();

        return response()->json('deleted');
    }
}
