@extends('layouts.app')
@section('title', 'Form')
@section('content')
    {{-- for display multiple errors --}}
    {{-- <div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
</div> --}}
    {{-- <form action="{{url('form-submit')}}" method="post"> --}}
    <form action="{{ route('form.submit') }}" method="post">
        @csrf
        {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
        <input type="text" name="name" id="" placeholder="name" value="{{ old('name') }}">
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <br>
        <input type="text" name="email" id="" placeholder="email" value="{{ old('email') }}">
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <br>
        <input type="submit" value="submit">
    </form>
@endsection
