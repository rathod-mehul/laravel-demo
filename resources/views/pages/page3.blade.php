@extends('layouts.app')
@section('title', 'Page 3')
@section('content')
    <p>This is my page 3 content.</p>
@endsection
@push('styles')
    <style>
        #sidebar {
            color: green;
        }
    </style>
@endpush
@push('scripts')
    <script>
        console.log('page 3');
    </script>
@endpush