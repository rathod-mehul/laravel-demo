@extends('argon_dashboard.layout.app')

@section('title')
    Users
@endsection

@section('header')
    Users
@endsection

@section('content')
    {{-- {{$users}} --}}
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
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ url('edit-user', $user->id) }}" class="btn btn-success">Edit</a>
                    </td>
                    <td>
                        <a href="#" class="btn btn-danger" onClick="confirmDelete('{{ url('delete-user', $user->id) }}')">Delete</a>
                        
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
