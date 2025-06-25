<?php
include('db_connection.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $fine_reason = $_POST['fine_reason'];
    $amount = $_POST['amount'];
    $payment_status = 'Paid';
    $payment_date = date('Y-m-d H:i:s');

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["payment_screenshot"]["name"]);
    if (move_uploaded_file($_FILES["payment_screenshot"]["tmp_name"], $target_file)) {
        $file_uploaded = $target_file;
    } else {
        $file_uploaded = '';
    }

    $sql = "INSERT INTO fines (user_id, fine_reason, amount, payment_status, payment_screenshot, payment_date) 
            VALUES ('$user_id', '$fine_reason', '$amount', '$payment_status', '$file_uploaded', '$payment_date')";

    echo $conn->query($sql) === TRUE ? "Fine submitted successfully!" : "Error: " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Fine - SARO</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f8fb;
        }

        header {
            background: #004d4d;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .heading {
            font-size: 1.8rem;
        }

        .logo {
            border-radius: 50%;
        }

        .container {
            width: 50%;
            margin: 40px auto;
            padding: 25px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
        }

        input[type="text"], input[type="file"], select {
            width: 100%;
            padding: 10px;
            margin: 8px 0 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #28a745;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .btn {
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 8px;
            display: inline-block;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        footer {
            background-color: #002e2e;
            color: white;
            padding: 20px;
        }

        .footer-top {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 10px 0;
        }

        .footer-links a,
        .logo-section a {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
            transition: color 0.3s;
        }

        .footer-links a:hover,
        .logo-section a:hover {
            color: #f4b400;
        }

        .footer-bottom {
            text-align: center;
            border-top: 1px solid #444;
            margin-top: 10px;
            padding-top: 10px;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
            }

            .heading {
                font-size: 1.3rem;
            }

            .footer-top {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <h1 class="heading">Save a Rupee Organisation (SARO)</h1>
        <a href="profile.php">
            <img src="images/profile.jpg" alt="Profile" class="logo" height="50" width="50">
        </a>
    </header>

    <!-- Main Fine Form -->
    <div class="container">
        <h2>Submit Fine</h2>
        <form action="fine.php" method="POST" enctype="multipart/form-data">
            <label for="fine_reason">Fine Reason:</label>
            <select id="fine_reason" name="fine_reason" onchange="updateAmount()" required>
                <option value="">Select a reason</option>
                <option value="college late">Late for college</option>
                <option value="No id card">No ID Card</option>
                <option value="No Proper DressCode">No Proper DressCode</option>
                <option value="Other">Other</option>
            </select>

            <label for="amount">Fine Amount (₹):</label>
            <input type="text" id="amount" name="amount" readonly required>

            <label for="payment_screenshot">Upload Screenshot:</label>
            <input type="file" name="payment_screenshot" id="payment_screenshot" required>

            <input type="submit" value="Submit Fine">
        </form>

        <a href="#" id="upiLink" class="btn" target="_blank">Pay via UPI</a>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-top">
            <div class="footer-links">
                <a href="home.php">Home</a>
                <a href="about.html">About Us</a>
                <a href="contact.html">Contact Us</a>
            </div>
            <div class="logo-section">
                <a href="logout.php">Logout</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2024 SRIT & Saro. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Script -->
    <script>
        function updateAmount() {
            var reason = document.getElementById("fine_reason").value;
            var amountField = document.getElementById("amount");
            var upiLink = document.getElementById("upiLink");
            var amount = '';

            switch(reason) {
                case 'college late':
                    amount = '20';
                    break;
                case 'No id card':
                    amount = '50';
                    break;
                case 'No Proper DressCode':
                    amount = '100';
                    break;
                default:
                    amount = '';
            }

            amountField.value = amount;

            if (amount) {
                upiLink.href = `upi://pay?pa=9346736773@ybl&pn=ManiSARO&am=${amount}&cu=INR`;
                upiLink.innerText = `Pay ₹${amount} via UPI`;
                upiLink.style.pointerEvents = 'auto';
                upiLink.style.opacity = '1';
            } else {
                upiLink.href = "#";
                upiLink.innerText = "Pay via UPI";
                upiLink.style.pointerEvents = 'none';
                upiLink.style.opacity = '0.6';
            }
        }

        window.onload = updateAmount;
    </script>
</body>
</html>
