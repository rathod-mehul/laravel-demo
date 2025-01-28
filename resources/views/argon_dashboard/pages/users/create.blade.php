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
                <input type="email" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Email address</label>
                <input type="email" class="form-control" id="name" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="password_confirmation">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
