@extends('layouts.app')
@section('title', 'Form')
@section('content')
<form action="{{url('form-submit')}}" method="post">
    @csrf
    {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
    <input type="text" name="name" id="" placeholder="name">
    <input type="text" name="email" id="" placeholder="email">
    <input type="submit" value="submit">
</form>
@endsection
