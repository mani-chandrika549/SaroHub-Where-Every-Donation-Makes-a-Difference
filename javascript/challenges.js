// Get all the "Register Now" and "Start Now" buttons
const registerButtons = document.querySelectorAll('.register-btn');
const startButtons = document.querySelectorAll('.start-btn');

// Add event listener to "Register Now" buttons
registerButtons.forEach((button, index) => {
    button.addEventListener('click', function() {
        // Show the "Start Now" button after registration
        startButtons[index].style.display = 'inline-block'; // Show Start Now button
        button.style.display = 'none'; // Hide Register Now button
        alert('You have successfully registered for this challenge! Now click Start Now to begin.');
    });
});

// Add event listener to "Start Now" buttons
startButtons.forEach(button => {
    button.addEventListener('click', function() {
        alert('You have started the challenge! Good luck!');
    });
});