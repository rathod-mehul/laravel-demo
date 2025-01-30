@extends('argon_dashboard.layout.app')

@section('title')
    Create User
@endsection

@section('header')
    Create User
@endsection

@section('content')
    <div class="container">
        <form action="{{ url('store-user') }}" method="post">
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
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <br>
                <button type="button" id="toggle-btn" class="btn btn-primary">view/hide</button>

            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="password_confirmation"
                    value="{{ old('confirmPassword') }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ url('/users') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
