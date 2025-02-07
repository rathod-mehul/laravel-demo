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
        <img src="{{ $user->image ? asset('images/' . $user->image) : asset('images/default.png') }}" alt=""
            width="75">
        <br>
        <p>Gender: {{ $user->gender ?? '' }}</p>
        @if (!empty($user->skills))
            <p>Skills:</p>
            <ul> 
                @foreach ($user->skills as $skill)
                    <li>{{ $skill }}</li>
                @endforeach
            </ul>
        @else
            <p>No skills selected.</p>
        @endif
        {{-- @dump($user->moreDetails) --}}
        <p>Mobile: {{ $user->mobile->model ?? '' }}</p>
        <p>Address: {{ $user->details->address ?? '' }}</p>
        <p>Hobby: {{ $user->details->hobby ?? '' }}</p>
        <br>
        <a href="{{ url('users') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
