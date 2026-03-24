<?php
// main/landing_page.php
// Public landing page with clickable map image → goes to admin/circle.php

session_start();
$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cemetery Management System</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background: linear-gradient(135deg, #e8f0f5 0%, #d5e1ea 100%);
      color: #333;
      line-height: 1.6;
      min-height: 100vh;
    }
    header {
      background: #2c5282;
      color: white;
      padding: 1.5rem 5%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .logo {
      font-size: 1.8rem;
      font-weight: bold;
    }
    nav a {
      color: white;
      text-decoration: none;
      margin-left: 1.8rem;
      font-weight: 500;
      transition: opacity 0.2s;
    }
    nav a:hover {
      opacity: 0.85;
    }
    .hero {
      text-align: center;
      padding: 6rem 5% 4rem;
      background: url('../images/front.jpeg') 
      center/cover no-repeat;
      color: white;
      position: relative;
    }
    .hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(44, 82, 130, 0.65);
    }
    .hero-content {
      position: relative;
      max-width: 900px;
      margin: 0 auto;
    }
    h1 {
      font-size: 3.2rem;
      margin-bottom: 1rem;
    }
    .subtitle {
      font-size: 1.35rem;
      margin-bottom: 2rem;
      opacity: 0.95;
    }
    .clickable-map {
      margin: 2.5rem auto 1rem;
      max-width: 700px;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 8px 30px rgba(0,0,0,0.25);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
    }
    .clickable-map:hover {
      transform: scale(1.03);
      box-shadow: 0 12px 40px rgba(0,0,0,0.3);
    }
    .clickable-map img {
      width: 100%;
      height: auto;
      display: block;
    }
    .map-caption {
      text-align: center;
      font-size: 1.1rem;
      margin-top: 0.8rem;
      opacity: 0.9;
    }
    .btn {
      display: inline-block;
      padding: 0.9rem 2.2rem;
      font-size: 1.1rem;
      font-weight: 600;
      border-radius: 50px;
      text-decoration: none;
      transition: all 0.25s ease;
      margin: 0 0.8rem 1rem;
    }
    .btn-primary {
      background: #3182ce;
      color: white;
      border: 2px solid #3182ce;
    }
    .btn-primary:hover {
      background: #2b6cb0;
      transform: translateY(-2px);
    }
    .btn-outline {
      background: transparent;
      color: white;
      border: 2px solid white;
    }
    .btn-outline:hover {
      background: rgba(255,255,255,0.15);
    }
    .features {
      padding: 5rem 5%;
      max-width: 1100px;
      margin: 0 auto;
      text-align: center;
    }
    .features h2 {
      font-size: 2.4rem;
      margin-bottom: 3rem;
      color: #2c5282;
    }
    .feature-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2.5rem;
    }
    .feature-card {
      background: white;
      padding: 2.2rem;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.08);
      transition: transform 0.25s;
    }
    .feature-card:hover {
      transform: translateY(-8px);
    }
    .feature-card h3 {
      color: #2c5282;
      margin-bottom: 1rem;
    }
    footer {
      background: #2c5282;
      color: white;
      text-align: center;
      padding: 2rem;
      margin-top: 4rem;
    }
    @media (max-width: 768px) {
      h1 { font-size: 2.6rem; }
      .hero { padding: 5rem 5% 3rem; }
      .clickable-map { max-width: 100%; }
    }
  </style>
</head>
<body>

<header>
  <div class="logo">Cemetery System</div>
  <nav>
    <?php if ($is_logged_in): ?>
      <a href="../admin/circle.php">Dashboard</a>
      <a href="../admin/circle.php?logout=1">Logout</a>
    <?php else: ?>
      <a href="../login/login.php">Login</a>
    <?php endif; ?>
  </nav>
</header>

<section class="hero">
  <div class="hero-content">
    <h1>Memorial & Cemetery Management</h1>
    <p class="subtitle">Honor, Remember, and Manage with Dignity and Ease</p>

    <?php if ($is_logged_in): ?>
      <a href="../admin/circle.php" class="btn btn-primary">Go to Dashboard</a>
    <?php else: ?>
      <a href="" class="btn btn-primary">Learn More</a>
     
    <?php endif; ?>
  </div>
</section>
 <!-- Clickable picture → goes to circle.php (interactive map) -->
    <div class="clickable-map" onclick="window.location.href='../user/circle.php';" title="Click to view interactive cemetery map">
      <img src="../images/pic.png" alt="Cemetery layout map with sections and plots">
      <p class="map-caption">Explore the interactive cemetery map → Click here</p>
    </div>
<section class="features">
  <h2>Key Features</h2>
  <div class="feature-grid">
    <div class="feature-card">
      <h3>Interactive Map</h3>
      <p>Visualize burial plots with color-coded availability and group information.</p>
    </div>
    <div class="feature-card">
      <h3>Secure Access</h3>
      <p>Staff-only login with session protection for sensitive cemetery data.</p>
    </div>
    <div class="feature-card">
      <h3>Search & Details</h3>
      <p>Quickly find graves by name, group, or location with detailed records.</p>
    </div>
  </div>
</section>

<footer>
  <p>© <?= date('Y') ?> Grave Finder • San Carlos City Pangasinan</p>
</footer>

</body>
</html>