@extends('argon_dashboard.layout.app')

@section('title')
    Edit User
@endsection

@section('header')
    Edit User
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Email address</label>
                <input type="email" class="form-control" id="name" name="email" value="{{ $user->email }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Skills (Checkboxes) -->
            <div class="mb-3">
                <label>Skills:</label><br>

                @php
                    $selectedSkills = old('skills', $user->skills ?? '[]'); // Get old values or database values
                @endphp

                <input type="checkbox" name="skills[]" value="PHP" id="php"
                    {{ is_array($selectedSkills) && in_array('PHP', $selectedSkills) ? 'checked' : '' }}>
                <label for="php" class="form-label">PHP</label>

                <input type="checkbox" name="skills[]" value="Laravel" id="laravel"
                    {{ is_array($selectedSkills) && in_array('Laravel', $selectedSkills) ? 'checked' : '' }}>
                <label for="laravel" class="form-label">Laravel</label>

                <input type="checkbox" name="skills[]" value="JavaScript" id="javascript"
                    {{ is_array($selectedSkills) && in_array('JavaScript', $selectedSkills) ? 'checked' : '' }}>
                <label for="javascript" class="form-label">JavaScript</label>

                @error('skills')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <!-- Gender (Radio Buttons) -->
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>

                @php
                    $selectedGender = old('gender', $user->gender ?? '');
                @endphp

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male"
                        {{ $selectedGender == 'male' ? 'checked' : '' }}>
                    <label class="form-check-label" for="male">Male</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female"
                        {{ $selectedGender == 'female' ? 'checked' : '' }}>
                    <label class="form-check-label" for="female">Female</label>
                </div>

                @error('gender')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- @dd($user->mobile->id) --}}
            <div class="mb-3">
                <label for="phone_id" class="form-label">Mobile you have:</label>
                <select class="form-select" aria-label="Default select example" name="phone_id" id="phone_id">
                    <option value="">Select Mobile</option>
                    @foreach ($phones as $phone)
                        <option value="{{ $phone->id }}"
                            @selected(old('phone_id', $user->phone_id ?? '') == $phone->id)>
                            {{ $phone->model }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address"
                    value="{{ $user->details->address }}">
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="hobby" class="form-label">Hobby</label>
                <input type="hobby" class="form-control" id="hobby" name="hobby"
                    value="{{ $user->details->hobby }}">
                @error('hobby')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Profile Image:</label>
                <img width="200"
                    src="{{ $user->image ? asset('images/' . $user->image) : asset('images/default.png') }}"
                    alt="img not found">
            </div>
            <div class="mb-3">
                <label for="remove_img">
                    <input type="checkbox" name="remove_img" id="remove_img" value="1">
                    I want to remove my profile image permanently
                </label>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload New Image</label>
                <input class="form-control" type="file" id="formFile" name="image" value="{{ $user->image }}">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ url('users') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
