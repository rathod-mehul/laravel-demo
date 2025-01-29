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