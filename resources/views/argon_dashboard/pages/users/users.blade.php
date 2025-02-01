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
                <th>Show</th>
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
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-warning">Show</a>

                    </td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success">Edit</a>
                    </td>
                    <td>
                        <a href="javascript:void(0)" class="btn btn-danger" onClick="confirmDelete({{ $user->id }})">Delete</a>
                        <form action="{{ route('users.destroy', $user->id) }}" id="deleteForm{{ $user->id }}" method="post">
                            @csrf
                            @method('delete')
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
