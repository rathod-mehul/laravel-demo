console.log("Js File");

document.getElementById('toggle-btn').addEventListener('click', function () {

    let passwordField = document.getElementById('password');
    let confirmPasswordField = document.getElementById('confirmPassword');
    let toggleButton = document.getElementById('toggle-btn');

    if (passwordField.type === "password") {
        confirmPasswordField.type = "text";
        passwordField.type = "text";
        toggleButton.innerHTML = "Hide";
    } else {
        confirmPasswordField.type = "password";
        passwordField.type = "password";
        toggleButton.innerHTML = "Show";
    }

})

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