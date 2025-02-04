<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\File as RulesFile;
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
        $users = User::orderBy('id', 'desc')->get();

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
            'image' => [
                'required',
                // RulesFile::image(),
                RulesFile::types(['mp3', 'wav'])
                   
            ]
        ]);

        $inputs = [
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password),
        ];

        $file = $request->file('image');
        if (!empty($file)) {
            $name = $file->getClientOriginalName();
            $file->move('images', $name);
            $inputs['image'] = $name;
        }

        # Query builder method
        // DB::table('users')->insert([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' =>  Hash::make($request->password),
        //     'created_at' => now()
        // ]);

        # Eloquent method
        User::create($inputs);
        // return redirect(url('users'));
        return redirect()->route('users.index');
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
        $user = User::find($id);
        $oldImgPath = public_path('images/' . $user->image);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $input = Arr::only($request->all(), ['name', 'email']);
        $file = $request->file('image');
        if (!empty($file)) {
            // remove old image if exist it
            if (File::exists($oldImgPath)) {
                File::delete($oldImgPath);
            }

            $name = $file->getClientOriginalName();
            $file->move('images', $name);
            $input['image'] = $name;
        }

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

        $user = User::find($id);

        # Query builder method
        // DB::table('users')->where('id', $id)->delete();

        # Eloquent method
        User::where('id', $id)->delete();

        // delete the images with user
        $imagePath = public_path('images/' . $user->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }



        return redirect(url('users'));
    }
}
