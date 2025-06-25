<?php
$case = isset($_GET['case']) ? htmlspecialchars($_GET['case']) : 'Unknown Case';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Donate for <?php echo $case; ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f8fb;
      color: #333;
    }

    /* Header */
    header {
      background-color: #004d4d;
      color: white;
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .heading {
      font-size: 1.6rem;
      margin: 0;
    }

    .logo {
      border-radius: 50%;
      object-fit: cover;
    }

    /* Container */
    .container {
      max-width: 600px;
      margin: 40px auto;
      padding: 25px;
      background: #fff;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      border-radius: 10px;
    }

    h2 {
      text-align: center;
      color: #007bff;
    }

    label {
      display: block;
      margin: 15px 0 5px;
      font-weight: 600;
    }

    input {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      margin-bottom: 15px;
      box-sizing: border-box;
    }

    button {
      width: 100%;
      padding: 12px;
      background: #007bff;
      color: white;
      font-weight: bold;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background: #0056b3;
    }

    .upi-link {
      display: none;
      margin-top: 15px;
      background-color: #28a745;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 5px;
      text-align: center;
      font-weight: 500;
    }

    .upi-link:hover {
      background-color: #218838;
    }

    .footer {
      text-align: center;
      padding: 20px;
      color: #777;
      font-size: 0.9rem;
    }

    /* Footer Styling */
    footer.footer-container {
      background-color: #002e2e;
      color: white;
      padding: 20px;
    }

    .footer-top {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      padding-bottom: 10px;
      border-bottom: 1px solid #444;
    }

    .footer-links, .logo-section {
      display: flex;
      gap: 20px;
    }

    .footer-links a, .logo-section a {
      color: white;
      text-decoration: none;
      font-size: 0.95rem;
    }

    .footer-links a:hover, .logo-section a:hover {
      color: #f4b400;
    }

    .footer-bottom {
      text-align: center;
      margin-top: 10px;
      font-size: 0.85rem;
    }

    @media (max-width: 768px) {
      header {
        flex-direction: column;
        align-items: center;
        gap: 10px;
      }

      .heading {
        font-size: 1.3rem;
      }

      .footer-top {
        flex-direction: column;
        align-items: center;
        gap: 10px;
      }
    }
  </style>
</head>
<body>

<!-- Header -->
<header>
  <h1 class="heading">Save a Rupee Organisation (SARO)</h1>
  <a href="profile.php">
    <img src="images/profile.jpg" alt="Profile" class="logo" height="50" width="50"/>
  </a>
</header>

<!-- Form Section -->
<div class="container">
  <h2>Donate for <?php echo $case; ?></h2>
  <form id="donation-form">
    <input type="hidden" id="case" value="<?php echo $case; ?>">
    
    <label for="amount">Enter Amount:</label>
    <input type="number" id="amount" name="amount" placeholder="Enter amount in INR" required>
    
    <label for="name">Your Name:</label>
    <input type="text" id="name" name="name" placeholder="Enter your name" required>
    
    <label for="email">Your Email:</label>
    <input type="email" id="email" name="email" placeholder="Enter your email" required>
    
    <button type="button" id="download-btn">Proceed to Pay</button>
    <a id="upiLink" href="#" target="_blank" class="upi-link">Pay via UPI</a>
  </form>
</div>

<!-- Footer -->
<footer class="footer-container">
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
  document.getElementById("download-btn").addEventListener("click", function () {
    var amount = document.getElementById("amount").value;
    var name = document.getElementById("name").value || "Donor";
    var upiId = "9346736773@ybl";

    if (!amount) {
      alert("Please enter an amount.");
      return;
    }

    var upiLink = `upi://pay?pa=${upiId}&pn=${encodeURIComponent(name)}&am=${amount}&cu=INR`;
    var upiButton = document.getElementById("upiLink");

    upiButton.href = upiLink;
    upiButton.innerText = `Pay ₹${amount} via UPI`;
    upiButton.style.display = "inline-block";
  });
</script>

</body>
</html>
