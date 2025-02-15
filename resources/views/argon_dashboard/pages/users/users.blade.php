@extends('argon_dashboard.layout.app')

@section('title')
    Users
@endsection

@section('header')
    Users
@endsection

@section('content')
    {{-- {{$users}} --}}
    @if (session('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Image</th>
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
                        <img width="75"
                            src="{{ $user->image ? asset('images/' . $user->image) : asset('images/default.png') }}"
                            alt="user profile image not found">
                    </td>
                    <td>
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-warning">Show</a>

                    </td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success">Edit</a>
                    </td>
                    <td>
                        <a href="javascript:void(0)" class="btn btn-danger"
                            onClick="confirmDelete({{ $user->id }})">Delete</a>
                        <form action="{{ route('users.destroy', $user->id) }}" id="deleteForm{{ $user->id }}"
                            method="post">
                            @csrf
                            @method('delete')
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <!-- Pagination Links -->
    <div class="mt-3">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
@endsection

@push('scripts')
    <script>
        //  JavaScript to handle confirmation

        function confirmDelete(userId) {
            // Show confirmation dialog
            if (confirm("Are you sure you want to delete this user?")) {
                let deleteForm = document.getElementById(`deleteForm${userId}`)
                console.log(deleteForm);
                deleteForm.submit()
            } else {
                // If user clicks Cancel, do nothing
                return false;
            }
        }
    </script>
@endpush
