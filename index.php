<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shipping Management System</title>
  <style>
    /* === Global Styles === */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      overflow-x: hidden;
      background: linear-gradient(120deg, #001F3F, #003366, #004C99);
      background-size: 400% 400%;
      animation: gradientBG 10s ease infinite;
      position: relative;
      color: #fff;
    }

    /* === Animated Gradient Background === */
    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* === Navigation Bar === */
    nav {
      position: sticky;
      top: 0;
      width: 100%;
      background: rgba(0, 31, 63, 0.85);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 50px;
      backdrop-filter: blur(10px);
      z-index: 10;
      box-shadow: 0 2px 15px rgba(0, 230, 230, 0.3);
    }

    nav .logo {
      width: 50px;
      height: auto;
      filter: drop-shadow(0 0 5px #00e6e6);
    }

    nav ul {
      list-style: none;
      display: flex;
      gap: 30px;
    }

    nav ul li a {
      text-decoration: none;
      color: #00e6e6;
      font-weight: 500;
      transition: 0.3s;
    }

    nav ul li a:hover {
      color: #00ffff;
      text-shadow: 0 0 8px #00e6e6;
    }

    /* === Floating Glow Particles === */
    .glow {
      position: absolute;
      width: 10px;
      height: 10px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      animation: float 10s linear infinite;
    }

    @keyframes float {
      0% { transform: translateY(0) scale(1); opacity: 0.7; }
      50% { transform: translateY(-100vh) scale(1.5); opacity: 0.3; }
      100% { transform: translateY(0) scale(1); opacity: 0.7; }
    }

    /* === Main Container === */
    .container {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      z-index: 2;
      padding: 100px 20px 50px;
    }

    /* === Logo === */
    .main-logo {
      width: 120px;
      height: auto;
      margin-bottom: 20px;
      animation: logoGlow 3s ease-in-out infinite alternate;
      filter: drop-shadow(0 0 15px rgba(0, 230, 230, 0.6));
    }

    @keyframes logoGlow {
      from { filter: drop-shadow(0 0 10px rgba(0, 230, 230, 0.4)); }
      to { filter: drop-shadow(0 0 25px rgba(0, 255, 255, 0.8)); }
    }

    /* === Title Animation === */
    h1 {
      font-size: 3em;
      letter-spacing: 2px;
      color: #00e6e6;
      text-shadow: 0 0 10px #00e6e6, 0 0 20px #00e6e6, 0 0 40px #00b3b3;
      animation: glowPulse 2s infinite alternate;
    }

    @keyframes glowPulse {
      from { text-shadow: 0 0 5px #00e6e6, 0 0 10px #00b3b3; }
      to { text-shadow: 0 0 20px #00ffff, 0 0 40px #00cccc; }
    }

    p {
      margin-top: 10px;
      font-size: 1.1em;
      color: #ccefff;
      opacity: 0.8;
    }

    .btn {
      margin-top: 30px;
      padding: 12px 35px;
      background: linear-gradient(90deg, #00e6e6, #00b3b3);
      color: #001f3f;
      border: none;
      font-size: 1.1em;
      border-radius: 50px;
      cursor: pointer;
      transition: 0.4s ease;
      box-shadow: 0 0 10px #00e6e6;
    }

    .btn:hover {
      background: linear-gradient(90deg, #00b3b3, #00ffff);
      box-shadow: 0 0 20px #00ffff, 0 0 40px #00b3b3;
      transform: scale(1.05);
    }

    .fade-in {
      opacity: 0;
      transform: translateY(30px);
      animation: fadeIn 1s forwards;
    }

    @keyframes fadeIn {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* === Footer === */
    footer {
      background: rgba(0, 31, 63, 0.85);
      backdrop-filter: blur(10px);
      text-align: center;
      padding: 20px 50px;
      color: #00e6e6;
      font-size: 0.9em;
      box-shadow: 0 -2px 15px rgba(0, 230, 230, 0.2);
    }

    footer a {
      color: #00ffff;
      text-decoration: none;
      margin: 0 10px;
      transition: 0.3s;
    }

    footer a:hover {
      text-shadow: 0 0 5px #00ffff;
    }

  </style>
</head>
<body>

  <!-- Navigation -->
  <nav>
    <img src="logo.png" alt="CSC Logo" class="logo">
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
  </nav>

  <!-- Floating Glow Particles -->
  <div class="glow" style="left: 20%; animation-delay: 0s;"></div>
  <div class="glow" style="left: 40%; animation-delay: 2s;"></div>
  <div class="glow" style="left: 60%; animation-delay: 4s;"></div>
  <div class="glow" style="left: 80%; animation-delay: 6s;"></div>

  <!-- Main Container -->
  <div class="container fade-in">
    <img src="logo.png" alt="CSC Logo" class="main-logo">
    <h1>Welcome to CSC</h1>
    <p>Your smart shipping management system</p>
    <button class="btn" onclick="redirectToSelection()">Get Started</button>
  </div>

  <!-- Footer -->
  <footer>
    &copy; 2025 CSC Shipping System | 
    <a href="#">Facebook</a> | 
    <a href="#">Twitter</a> | 
    <a href="#">LinkedIn</a>
  </footer>

  <script>
    // Redirect on button click
    function redirectToSelection() {
      window.location.href = "menu.php";
    }
  </script>



