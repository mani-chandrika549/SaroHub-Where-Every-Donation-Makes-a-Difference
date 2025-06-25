<?php
session_start();  // Ensure you start the session to access session variables

// Check if the request is a POST request and if the payment screenshot is set
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['payment-screenshot'])) {
    // Database connection (adjust this according to your configuration)
    $db = new mysqli('localhost', 'username', 'password', 'database_name');
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Retrieve the uploaded file
    $file = $_FILES['payment-screenshot'];
    $targetDir = "uploads/";  // Directory to store the file
    $targetFile = $targetDir . basename($file["name"]);
    
    // Move the uploaded file to the target directory
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        // Assuming the user is logged in and user_id is stored in session
        $userId = $_SESSION['user_id'];  // Ensure user is logged in
        $fineId = $_POST['fine_id'];     // Fine ID from the frontend (can be sent via AJAX)

        // Update payment status and store screenshot path in the database
        $stmt = $db->prepare("UPDATE fines SET payment_status = 'paid', payment_screenshot = ? WHERE id = ?");
        $stmt->bind_param("si", $targetFile, $fineId);
        $stmt->execute();
        $stmt->close();

        // Respond with success
        echo json_encode(["success" => true]);
    } else {
        // Respond with failure if the file could not be uploaded
        echo json_encode(["success" => false]);
    }
    
    // Close the database connection
    $db->close();
}
?>
