@extends('argon_dashboard.layout.app')

@section('title')
    Create User
@endsection

@section('header')
    Create User
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Email address</label>
                <input type="email" class="form-control" id="name" name="email" value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Skills (Checkboxes) -->
            <div class="mb-3">
                <label>Skills:</label><br>

                <input type="checkbox" name="skills[]" value="PHP" id="php"
                    {{ old('skills') && in_array('PHP', old('skills')) ? 'checked' : '' }}>
                <label for="php" class="form-label">PHP</label>

                <input type="checkbox" name="skills[]" value="Laravel" id="laravel"
                    {{ is_array(old('skills')) && in_array('Laravel', old('skills')) ? 'checked' : '' }}>
                <label for="laravel" class="form-label">Laravel</label>

                <input type="checkbox" name="skills[]" value="JavaScript" id="javascript"
                    {{ is_array(old('skills')) && in_array('JavaScript', old('skills')) ? 'checked' : '' }}>
                <label for="javascript" class="form-label">JavaScript</label>

                @error('skills')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <!-- Gender (Radio Buttons) -->
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                    <label class="form-check-label" for="male">
                        male
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" checked>
                    <label class="form-check-label" for="female">
                        female
                    </label>
                </div>
                @error('gender')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <br>
                <button type="button" id="toggle-btn" class="btn btn-primary">view</button>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="password_confirmation"
                    value="{{ old('confirmPassword') }}">
                @error('password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <select class="form-select" aria-label="Default select example" name="phone_id">
                    <option value="0" selected>Select Mobile</option>
                    @foreach ($phones as $phone)
                        <option value="{{ $phone->id }}">{{ $phone->model }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                Details:
                <input type="text" class="form-control" name="address" value="{{ old('address') }}"
                    placeholder="Address">
                <input type="text" class="form-control" name="hobby" value="{{ old('hobby') }}" placeholder="Hobby">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload Image</label>
                <input class="form-control" type="file" id="formFile" name="image">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ url('/users') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('toggle-btn').addEventListener('click', function() {

            let passwordField = document.getElementById('password');
            let confirmPasswordField = document.getElementById('confirmPassword');
            let toggleButton = document.getElementById('toggle-btn');

            if (passwordField.type === "password") {
                confirmPasswordField.type = "text";
                passwordField.type = "text";
                toggleButton.innerHTML = "Hide";
            } else {
                confirmPasswordField.type = "password";
                passwordField.type = "password";
                toggleButton.innerHTML = "Show";
            }

        })
    </script>
@endpush
