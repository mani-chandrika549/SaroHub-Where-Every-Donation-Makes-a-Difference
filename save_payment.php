<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "saro_connect";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get JSON input from the request
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['payment_id']) && isset($data['amount']) && isset($data['fine_reason'])) {
    $payment_id = $data['payment_id'];
    $amount = $data['amount'];
    $fine_reason = $data['fine_reason'];

    // Insert payment details into the database
    $sql = "INSERT INTO payments (payment_id, amount, fine_reason) VALUES ('$payment_id', '$amount', '$fine_reason')";

    if ($conn->query($sql) === TRUE) {
        echo "Payment details saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid payment data!";
}

$conn->close();
?>
