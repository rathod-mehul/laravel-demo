@extends('layouts.app')
@section('title', 'Page 2')
@section('content')
    <p>This is my page 2 content.</p>
@endsection
@push('styles')
    <style>
        #sidebar {
            color: yellow;
        }
    </style>
@endpush
@push('scripts')
    <script>
        console.log('page 2');
    </script>
@endpush
