<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "saro_hub");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $branch = htmlspecialchars($_POST['branch']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm-password']);

    $password_pattern = "/^(?=.*[A-Za-z])(?=.*\d).{6,}$/";
    
    if (!preg_match($password_pattern, $password)) {
        die("Password must be at least 6 characters long and include at least one letter and one number. <a href='register.html'>Go back</a>");
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        die("Passwords do not match. <a href='register.html'>Go back</a>");
    }

    
    

    // Check if email domain is valid
    if (!preg_match("/@srit\.ac\.in$/", $email)) {
        die("Registration is allowed only with a valid college email address (@srit.ac.in). <a href='register.html'>Go back</a>");
    }
    // Check if the email already exists in the database
    $email_check = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $email_check->bind_param("s", $email);
    $email_check->execute();
    $email_check->store_result();

    if ($email_check->num_rows > 0) {
        die("This email address is already registered. <a href='login.html'>Login here</a>");
    }


    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful! <a href='login.html'>Login here</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
