<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user info
$user_stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_result = $user_stmt->get_result();
$user = $user_result->fetch_assoc();
$email = $user['email'];

// Fetch fine history
$fine_stmt = $conn->prepare("SELECT fine_reason, amount, payment_status, payment_screenshot, payment_date FROM fines WHERE user_id = ?");
$fine_stmt->bind_param("i", $user_id);
$fine_stmt->execute();
$fines = $fine_stmt->get_result();

// Fetch registered events
$event_stmt = $conn->prepare("SELECT event_name, name, email, registered_at FROM event_registrations WHERE email = ?");
$event_stmt->bind_param("s", $email);
$event_stmt->execute();
$event_results = $event_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SARO - User Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    :root {
      --saro-header: #004d4d;
      --saro-footer: #002e2e;
      --saro-accent: #007BFF;
      --text-light: #ffffff;
      --bg-light: #f6f8fa;
      --box-bg: #ffffff;
    }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: var(--bg-light);
    }

    /* HEADER */
    .img-heading-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 12px 20px;
      background-color: var(--saro-header);
    }

    .heading {
      flex-grow: 1;
      text-align: center;
      font-size: 1.8rem;
      color: var(--text-light);
      margin: 0;
      font-weight: 600;
    }

    .logo {
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #fff;
    }

    /* CONTAINER */
    .container {
      max-width: 960px;
      margin: 40px auto;
      background-color: var(--box-bg);
      padding: 30px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      border-radius: 10px;
    }

    h2, h3 {
      text-align: center;
      color: var(--saro-header);
    }

    .profile-info {
      margin-bottom: 30px;
      background-color: #e9f5f5;
      padding: 20px;
      border-radius: 8px;
    }

    .profile-info p {
      font-size: 18px;
      margin: 10px 0;
      color: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    th, td {
      border: 1px solid #ccc;
      padding: 12px;
      text-align: center;
    }

    th {
      background-color: var(--saro-header);
      color: white;
    }

    td img {
      width: 60px;
      height: auto;
      border-radius: 5px;
    }

    /* FOOTER */
    .footer-container {
      display: flex;
      flex-direction: column;
      background-color: var(--saro-footer);
      color: var(--text-light);
      padding: 20px 0;
    }

    .footer-top {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      padding: 0 20px;
    }

    .footer-links, .logo-section {
      display: flex;
      gap: 20px;
    }

    .footer-links a, .logo-section a {
      text-decoration: none;
      color: var(--text-light);
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .footer-links a:hover, .logo-section a:hover {
      color: var(--saro-accent);
    }

    .footer-bottom {
      text-align: center;
      margin-top: 20px;
      padding-top: 10px;
      border-top: 1px solid #444;
      font-size: 0.9rem;
    }

    @media (max-width: 768px) {
      .img-heading-container {
        flex-direction: column;
        align-items: center;
      }

      .footer-top {
        flex-direction: column;
        align-items: center;
        gap: 10px;
      }

      .heading {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>

<!-- HEADER -->
<header>
  <div class="img-heading-container">
    
    <h1 class="heading">Save a Rupee Organisation (SARO)</h1>
  </div>
</header>

<!-- PROFILE CONTENT -->
<div class="container">
  <h2>Your Profile</h2>

  <div class="profile-info">
    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
  </div>

  <!-- FINE HISTORY -->
  <h3>Fine History</h3>
  <table>
    <tr>
      <th>Reason</th>
      <th>Amount (₹)</th>
      <th>Status</th>
      <th>Screenshot</th>
      <th>Date</th>
    </tr>
    <?php while ($row = $fines->fetch_assoc()): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['fine_reason']); ?></td>
        <td><?php echo htmlspecialchars($row['amount']); ?></td>
        <td><?php echo htmlspecialchars($row['payment_status']); ?></td>
        <td>
          <?php if (!empty($row['payment_screenshot'])): ?>
            <a href="<?php echo htmlspecialchars($row['payment_screenshot']); ?>" target="_blank">
              <img src="<?php echo htmlspecialchars($row['payment_screenshot']); ?>" alt="screenshot">
            </a>
          <?php else: ?>
            No image
          <?php endif; ?>
        </td>
        <td><?php echo htmlspecialchars($row['payment_date']); ?></td>
      </tr>
    <?php endwhile; ?>
  </table>

  <!-- REGISTERED EVENTS -->
  <h3>Registered Events</h3>
  <table>
    <tr>
      <th>Event</th>
      <th>Name</th>
      <th>Email</th>
      <th>Registered On</th>
    </tr>
    <?php while ($row = $event_results->fetch_assoc()): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['event_name']); ?></td>
        <td><?php echo htmlspecialchars($row['name']); ?></td>
        <td><?php echo htmlspecialchars($row['email']); ?></td>
        <td><?php echo htmlspecialchars($row['registered_at']); ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</div>

<!-- FOOTER -->
<footer>
  <div class="footer-container">
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
  </div>
</footer>

</body>
</html>
