@extends('argon_dashboard.layout.app')

@section('title')
    Users
@endsection

@section('header')
    Users
@endsection

@section('content')
    {{-- {{$users}} --}}
    @include('argon_dashboard.pages.users_ajax.modal')
    @if (session('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <form id="createForm" class="user-form">
        <div id="error-messages"></div> <!-- Errors will be shown here -->
        <input type="text" placeholder="name" name="name" id="name">
        <input type="text" placeholder="email" name="email" id="email">
        <input type="password" placeholder="password" name="password" id="password">
        <input type="hidden" name="id" id="id">
        <input type="submit">
    </form>
    <button onClick="resetForm()">Reset</button>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody id="userTableBody">
        </tbody>
    </table>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/script.js') }}"></script>
@endpush
