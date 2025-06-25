<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Saro Connect - Home</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f8fb;
      color: #333;
    }

    header {
      background: #004d4d;
      color: white;
      padding: 12px 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    .heading {
      font-size: 1.8rem;
      font-weight: 600;
    }

    .logo {
      border-radius: 50%;
      border: 2px solid white;
      transition: transform 0.3s ease;
    }

    .logo:hover {
      transform: scale(1.1);
    }

    .video-section {
      position: relative;
    }

    .video-section video {
      width: 100%;
      height: auto;
      object-fit: cover;
    }

    .cards-section {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
      padding: 40px 30px;
    }

    .card {
      background-color: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
      text-align: center;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card h2 {
      color: #004d4d;
    }

    .btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007BFF;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      margin-top: 15px;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #0056b3;
    }

    .info-section {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      padding: 40px 20px;
      background-color: #e6f2f2;
    }

    .info-card {
      background: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
      width: 250px;
      text-align: center;
      transition: transform 0.3s ease;
    }

    .info-card:hover {
      transform: scale(1.05);
    }

    .info-card h2 {
      color: #007BFF;
    }

    .meetings-section {
      padding: 40px 20px;
      background-color: #f0f0f0;
    }

    .meetings-heading h2 {
      color: #004d4d;
      text-align: center;
      font-size: 2rem;
    }

    .meetings-list {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
      margin-top: 20px;
    }

    .meeting-card {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      width: 90%;
      max-width: 600px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .meeting-card:hover {
      transform: translateY(-5px);
    }

    .meeting-card h3 {
      color: #007BFF;
    }

    .footer-container {
      background-color: #002e2e;
      color: white;
      padding: 25px 20px;
    }

    .footer-top {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      align-items: center;
    }

    .footer-links a,
    .logo-section a {
      color: #fff;
      text-decoration: none;
      margin: 5px 15px;
      transition: color 0.3s;
    }

    .footer-links a:hover,
    .logo-section a:hover {
      color: #f4b400;
    }

    .footer-bottom {
      text-align: center;
      border-top: 1px solid #444;
      margin-top: 15px;
      padding-top: 10px;
      font-size: 0.9rem;
    }

    @media (max-width: 768px) {
      .heading {
        font-size: 1.4rem;
        text-align: center;
        width: 100%;
        margin-bottom: 10px;
      }

      .cards-section,
      .info-section {
        padding: 20px;
        grid-template-columns: 1fr;
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

  <!-- Header Section -->
  <header>
    <h1 class="heading">Save a Rupee Organisation (SARO)</h1>
    <a href="profile.php">
      <img src="images/profile.jpg" alt="Profile" class="logo" height="50" width="50">
    </a>
  </header>

  <!-- Video Section -->
  <div class="video-section">
    <video autoplay loop muted>
      <source src="videos/home_img.mp4" type="video/mp4" />
    </video>
  </div>

  <!-- Cards Section -->
  <section class="cards-section">
    <div class="card">
      <h2>Fine Amount</h2>
      <p><i><strong>Pay fines imposed for violating college rules. Submit your payment proof and track the status of each fine easily through this section...</strong></i></p>
      <a href="fine.php" class="btn">Go to Fine Amount</a>
    </div>
    <div class="card">
      <h2>Events</h2>
      <p><i><strong>Discover and register for upcoming events hosted by SARO Club. From charity drives to campus engagements, stay connected and get involved !</strong></i></p>
      <a href="events.html" class="btn">Go to Events</a>
    </div>
    <div class="card">
      <h2>Daily Challenges</h2>
      <p><i><strong>Participate in fun and meaningful daily tasks designed to spark impact and interaction. Earn recognition by completing each challenge!</strong></i></p>
      <a href="challenges.html" class="btn">Go to Challenges</a>
    </div>
    <div class="card">
      <h2>Emergency Donations</h2>
      <p><i><strong>Make a difference in critical situations. Contribute instantly to support students or families in urgent medical or financial need.</strong></i></p>
      <a href="donations.html" class="btn">Donate Now</a>
    </div>
  </section>

  <!-- Info Section -->
  <section class="info-section">
    <div class="info-card">
      <h2>Our Vision</h2>
      <p>Empowering students to uplift society through collective responsibility, empathy, and innovative service.</p>
    </div>
    <div class="info-card">
      <h2>Our Mission</h2>
      <p>To build a student-driven system of aid and support for peers in need, promoting compassion and action on campus.</p>
    </div>
    <div class="info-card">
      <h2>Coordinators</h2>
      <p>Karthik, Sneha, and Aditya lead our student-driven efforts—managing events, donations, and SARO outreach.</p>
    </div>
    <div class="info-card">
      <h2>Contact Information</h2>
      <p>📧 saro@srit.ac.in
      📞 +91 12345 67890
Available: Mon–Fri, 10 AM – 4 PM.</p>
    </div>
  </section>

  <!-- Meetings Section -->
  <section class="meetings-section">
    <div class="meetings-heading">
      <h2>Meetings</h2>
      <p>Explore our past and upcoming meetings to stay informed.</p>
    </div>
    <div class="meetings-list">
      <div class="meeting-card">
        <h3>Annual SARO Gathering</h3>
        <p><strong>Date:</strong> 15th January 2025</p>
        <p><strong>Time:</strong> 10:00 AM - 2:00 PM</p>
        <p><strong>Location:</strong> SRIT Auditorium</p>
      </div>
      <div class="meeting-card">
        <h3>Volunteer Training Session</h3>
        <p><strong>Date:</strong> 25th February 2025</p>
        <p><strong>Time:</strong> 9:00 AM - 12:00 PM</p>
        <p><strong>Location:</strong> Room 203, SRIT</p>
      </div>
      <div class="meeting-card">
        <h3>Monthly Review Meeting</h3>
        <p><strong>Date:</strong> 5th March 2025</p>
        <p><strong>Time:</strong> 3:00 PM - 5:00 PM</p>
        <p><strong>Location:</strong> Online (Zoom)</p>
      </div>
    </div>
  </section>

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
      <p>© 2024 SRIT & SARO. All Rights Reserved.</p>
    </div>
  </footer>

</body>
</html>
