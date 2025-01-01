@extends('layouts.app')
@section('title', 'Page 1')
@section('content')
    <p class="text-success">This is my page 1 content.</p>
@endsection
@push('styles')
    <style>
        #sidebar {
            color: red;
        }
    </style>
@endpush
@push('scripts')
    <script>
        console.log('page 1');
    </script>
@endpush
@prepend('scripts')
    <script>
        console.log('load first');
    </script>
@endprepend
