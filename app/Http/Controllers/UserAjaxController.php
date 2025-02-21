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
