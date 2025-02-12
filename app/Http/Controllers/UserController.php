<?php

namespace App\Http\Controllers;

use App\Mail\UserTestMail;
use App\Models\Details;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        // $users = User::orderBy('id', 'desc')->get();
        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('argon_dashboard.pages.users.users', ['users' => $users]);
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
            'gender' => 'required|string',
            'skills' => 'nullable|array',
            'password' => [
                'required',
                'string',
                'min:8', // Minimum length of 8 characters
                'confirmed', // Ensure password_confirmation field matches
                'regex:/[A-Z]/', // Must contain at least one uppercase letter
                'regex:/[0-9]/', // Must contain at least one number
                'regex:/[@$!%*?&]/', // Must contain at least one special character
            ],
            // 'image' => [
            //     'required',
            // RulesFile::image(),
            // RulesFile::types(['mp3', 'wav'])

            // ]
        ]);

        $inputs = [
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password),
            'gender' => $request->gender,
            'skills' => $request->skills
        ];

        $file = $request->file('image');
        if (!empty($file)) {
            $name = $file->getClientOriginalName();
            $file->move('images', $name);
            $inputs['image'] = $name;
        }
        if (isset($request->phone_id)) {
            $inputs['phone_id'] = $request->phone_id;
        }

        # Query builder method
        // DB::table('users')->insert([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' =>  Hash::make($request->password),
        //     'created_at' => now()
        // ]);

        # Eloquent method
        $user = User::create($inputs);
        // info(['$user' => $user]);
        $details = [
            'address' => $request->address,
            'hobby' => $request->hobby,
            'user_id' => $user->id,
        ];
        // dd($details);
        $user->details()->create($details); // insert details using relation
        Mail::to('user@mail.com')->send(new UserTestMail($user));
        // Mail::to('user@mail.com')->send(new UserTestMail($user));
        // Details::create($details);
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

        $phones = Phone::all();
        return view('argon_dashboard.pages.users.edit', compact(['user', 'phones']));
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

        $input = Arr::only($request->all(), ['name', 'email', 'phone_id']);

        //Check if the user want to remove the imag
        if ($request->has('remove_img') && $request->remove_img == 1) {
            // dd($request->has('remove_img'));
            if (File::exists($oldImgPath)) {
                File::delete($oldImgPath);
                $input['image'] = null;
            }
        }

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

        $details = Arr::only($request->all(), ['address', 'hobby']);

        # Query builder method
        // DB::table('users')
        //     ->where('id', $id)
        //     ->update($input);

        # Eloquent method
        User::where('id', $id)->update($input);
        // Details::where('id', $id)->update($details);
        $user->details()->update($details); // update details using relation



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
        // $user->details()->delete(); // delete details using relation

        return redirect(url('users'));
    }
}
