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
    <form id="userForm">
        <input type="text" placeholder="name" name="name">
        <input type="text" placeholder="email" name="email">
        <input type="text" placeholder="password" name="password">
        <input type="submit">
    </form>
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
    <script>
        $(document).ready(() => {
            const loadUsers = () => {
                $.ajax({
                    url: "users-ajax",
                    method: "GET",
                    success: (result) => {
                        result.forEach(user => {
                            appendUserRow(user);
                        });
                    }
                })
            }

            loadUsers();

            function appendUserRow(user) {
                // Get tbody element
                let tbody = document.getElementById("userTableBody"); // Change ID as per your table

                // Create table row
                let tr = document.createElement("tr");

                // Create and append table data cells
                let tdId = document.createElement("td");
                tdId.textContent = user.id;
                tr.appendChild(tdId);

                let tdName = document.createElement("td");
                tdName.textContent = user.name;
                tr.appendChild(tdName);

                let tdEmail = document.createElement("td");
                tdEmail.textContent = user.email;
                tr.appendChild(tdEmail);

                let tdEdit = document.createElement("td");
                let editBtn = document.createElement("a");
                editBtn.href = `http://127.0.0.1:8000/users/${user.id}/edit`;
                editBtn.className = "btn btn-success";
                editBtn.textContent = "Edit";
                tdEdit.appendChild(editBtn);
                tr.appendChild(tdEdit);

                let tdDelete = document.createElement("td");
                let deleteBtn = document.createElement("a");
                deleteBtn.href = "javascript:void(0)";
                deleteBtn.className = "btn btn-danger";
                deleteBtn.textContent = "Delete";
                deleteBtn.setAttribute("onclick", `confirmDelete(${user.id})`);
                tdDelete.appendChild(deleteBtn);
                tr.appendChild(tdDelete);

                // Append the row to tbody
                tbody.prepend(tr);
            }

            $('#userForm').on('submit', (e) => {
                e.preventDefault();
                console.log($('#userForm').serialize());

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "users-ajax",
                    method: "POST",
                    data: $('#userForm').serialize(),
                    success: (result) => {
                        console.log(result);
                        appendUserRow(result);
                    },
                    error: (error) => {
                        console.log(error);
                    }
                })
            })

        })
    </script>
@endpush
