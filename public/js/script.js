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
        editBtn.href = "javascript:void(0)"
        editBtn.className = "btn btn-success edit-user";
        editBtn.setAttribute("data-id", user.id);
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

    $('#createForm').on('submit', (e) => {
        e.preventDefault();
        console.log($('#createForm').serialize());

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "users-ajax",
            method: "POST",
            data: $('#createForm').serialize(),
            success: (result) => {
                console.log(result);
                appendUserRow(result);
                resetForm()
            },
            error: (xhr, status, error) => {
                console.log('status:', status);
                console.log('XHR object:', xhr);
                console.log('Responsive text:', xhr.responsiveText);
                console.log('Error Thrown:', error);
                console.log('hello how can i help you????', xhr.responseJSON.errors);
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    $("#error-messages").html(""); // Clear previous errors

                    $.each(errors, function (key, messages) {
                        $("#error-messages").append(
                            `<p class="text-danger">${messages[0]}</p>`);
                    });
                }
            }
        })
    })

    $('#editForm').on('submit', (e) => {
        e.preventDefault();
        console.log($('#createForm').serialize());

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "users-ajax",
            method: "POST",
            data: $('#createForm').serialize(),
            success: (result) => {
                console.log(result);
                appendUserRow(result);
                resetForm()
            },
            error: (xhr, status, error) => {
                console.log('status:', status);
                console.log('XHR object:', xhr);
                console.log('Responsive text:', xhr.responsiveText);
                console.log('Error Thrown:', error);
                console.log('hello how can i help you????', xhr.responseJSON.errors);
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    $("#error-messages").html(""); // Clear previous errors

                    $.each(errors, function (key, messages) {
                        $("#error-messages").append(
                            `<p class="text-danger">${messages[0]}</p>`);
                    });
                }
            }
        })
    })
})

// with normal function we have 2 ways to get attribute
// $(document).on('click', '.edit-user', function (e) {
// let id = $(this).data("id");
// let id = $(e.target).data("id");

$(document).on('click', '.edit-user', (e) => {
    e.preventDefault();
    let id = $(e.target).data("id");
    $('.user-form').attr('id', 'editForm');
    $('#password').addClass('d-none');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: `users-ajax/${id}/edit`,
        method: "GET",
        success: (result) => {
            console.log(result);
            $('#id').val(result.id)
            $('#name').val(result.name)
            $('#email').val(result.email)
            $('#name').val(result.name)
        },
        error: (xhr, status, error) => {
            console.log(error);
            console.log(status);
            console.log(xhr);
        }
    })
})

function resetForm() {
    if ($('.user-form').attr('id') == 'editForm') {
        $('#editForm')[0].reset();
        $('.user-form').attr('id', 'createForm');
        $('#password').removeClass('d-none');
        return;
    }
    $('#createForm')[0].reset();
}