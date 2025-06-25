// Script to handle event registration, if needed in the future
const registerButtons = document.querySelectorAll('.register-btn');

registerButtons.forEach(button => {
    button.addEventListener('click', function() {
        alert('You have successfully registered for the event!');
    });
});