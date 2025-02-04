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
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload Image</label>
                <input class="form-control" type="file" id="formFile" name="image" value="{{ $user->image }}">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <h1>{{ $user->image }}</h1>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ url('users') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
