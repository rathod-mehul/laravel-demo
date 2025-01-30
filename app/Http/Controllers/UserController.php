<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        # Query builder method
        // $users = DB::table('users')->orderBy('id', 'desc')->get();

        # Eloquent method
        $users = User::all();

        return view('argon_dashboard.pages.users.users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('argon_dashboard.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:8', // Minimum length of 8 characters
                'confirmed', // Ensure password_confirmation field matches
                'regex:/[A-Z]/', // Must contain at least one uppercase letter
                'regex:/[0-9]/', // Must contain at least one number
                'regex:/[@$!%*?&]/', // Must contain at least one special character
            ],
        ]);
        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password),
        ]);

        return redirect(url('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = DB::table('users')->find($id);

        return view('argon_dashboard.pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = Arr::only($request->all(), ['name', 'email']);
        DB::table('users')
            ->where('id', $id)
            ->update($input);

        return redirect(url('users'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('users')->where('id', $id)->delete();

        return redirect(url('users'));
    }
}
