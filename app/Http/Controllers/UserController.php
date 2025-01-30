<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PharIo\Manifest\Email;

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
            'name' => 'required|string|max:255', // Validate that the name is required, a string, and no longer than 255 characters
            'email' => 'required|email|unique:users,email',
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

        # Query builder method
        // DB::table('users')->insert([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' =>  Hash::make($request->password),
        // ]);

        # Eloquent method
        User::create([
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
        # Query builder method
        // $user = DB::table('users')->find($id);

        # Eloquent method
        $user =  User::find($id);
        return view('argon_dashboard.pages.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        # Query builder method
        // $user = DB::table('users')->find($id);

        # Eloquent method
        $user = User::find($id);
        return view('argon_dashboard.pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $input = Arr::only($request->all(), ['name', 'email']);


        # Query builder method
        // DB::table('users')
        //     ->where('id', $id)
        //     ->update($input);

        # Eloquent method
        User::where('id', $id)->update($input);

        return redirect(url('users'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        # Query builder method
        // DB::table('users')->where('id', $id)->delete();

        # Eloquent method
        User::where('id', $id)->delete();
        return redirect(url('users'));
    }
}
