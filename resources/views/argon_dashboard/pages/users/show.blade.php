@extends('argon_dashboard.layout.app')

@section('title')
    About User
@endsection

@section('header')
    About User
@endsection

@section('content')
    <div class="container">
        <!-- Display user details -->
        <h1>{{ $user->name }}</h1>
        <p>Email: {{ $user->email }}</p>
        <p>Joined on: {{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y') }}</p>

    </div>
@endsection
