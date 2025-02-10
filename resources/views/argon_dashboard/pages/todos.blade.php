@extends('argon_Dashboard.layout.app')

@section('title')
    Todos app
@endsection

@section('header')
    Todos
@endsection

@section('content')
    <table class="table table-hover text-center">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">User ID</th>
                <th scope="col">Title</th>
                <th scope="col">Completed</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($todos as $todo)
                <tr>
                
                    {{-- @dd($todo) --}}
                    <td>{{ $todo['id'] }}</td>
                    <td>{{ $todo['userId'] }}</td>
                    <td>{{ $todo['title'] }}</td>
                    {{-- <td>{{ $todo['completed'] ? 'true' : 'false' }}</td> --}}
                    <td><span @class([
                        'badge',
                        'bg-success' => $todo['completed'],
                        'bg-danger' => !$todo['completed'],
                    ])>
                            {{ $todo['completed'] ? 'true' : 'false' }}
                        </span></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <span class="badge badge-success">Success</span>


    <!-- Pagination Links -->
    <div class="mt-3">
        {{ $todos->links('pagination::bootstrap-5') }}
    </div>
@endsection
