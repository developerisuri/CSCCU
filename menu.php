<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customer Menu - View Orders</title>
<style>
    /* ---------- Global Reset ---------- */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: "Poppins", sans-serif;
        background: radial-gradient(circle at top left, #001F3F, #001220);
        overflow: hidden;
        color: white;
    }

    /* ---------- Animated Background ---------- */
    .bubbles span {
        position: absolute;
        bottom: -150px;
        width: 20px;
        height: 20px;
        background: rgba(0, 255, 255, 0.5);
        border-radius: 50%;
        animation: rise 10s infinite ease-in;
        opacity: 0.6;
    }

    @keyframes rise {
        0% { transform: translateY(0) scale(1); opacity: 0.6; }
        100% { transform: translateY(-110vh) scale(0.5); opacity: 0; }
    }

    .bubbles span:nth-child(odd) {
        background: rgba(0, 255, 180, 0.4);
    }

    .bubbles span:nth-child(1) { left: 5%; animation-delay: 0s; }
    .bubbles span:nth-child(2) { left: 15%; animation-delay: 2s; }
    .bubbles span:nth-child(3) { left: 25%; animation-delay: 4s; }
    .bubbles span:nth-child(4) { left: 45%; animation-delay: 6s; }
    .bubbles span:nth-child(5) { left: 65%; animation-delay: 3s; }
    .bubbles span:nth-child(6) { left: 75%; animation-delay: 1s; }
    .bubbles span:nth-child(7) { left: 85%; animation-delay: 5s; }

    /* ---------- Glassmorphic Card ---------- */
    .menu-box {
        position: relative;
        width: 400px;
        height: 250px;
        backdrop-filter: blur(20px);
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 20px;
        box-shadow: 0 0 20px rgba(0, 255, 255, 0.4);
        text-align: center;
        transition: 0.5s;
        overflow: hidden;
    }

    .menu-box:hover {
        transform: scale(1.05);
        box-shadow: 0 0 40px rgba(0, 255, 255, 0.6);
    }

    .menu-box h1 {
        font-size: 1.8em;
        margin-top: 40px;
        text-shadow: 0 0 10px cyan;
    }

    /* ---------- Glowing Button ---------- */
    .menu-box button {
        margin-top: 60px;
        padding: 15px 60px;
        border: none;
        border-radius: 40px;
        background: linear-gradient(90deg, #00f2ff, #00ffaa);
        color: #000;
        font-weight: bold;
        font-size: 1.1em;
        letter-spacing: 1px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        transition: 0.3s;
    }

    .menu-box button:hover {
        background: linear-gradient(90deg, #00ffaa, #00f2ff);
        box-shadow: 0 0 20px cyan, 0 0 40px lime;
        transform: translateY(-5px);
    }

    /* ---------- Button Pulse Glow ---------- */
    .menu-box button::after {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.2);
        transition: 0.5s;
    }

    .menu-box button:hover::after {
        left: 100%;
    }

</style>
</head>
<body>

<!-- Background animation -->
<div class="bubbles">
    <span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span>
</div>

<!-- Modern Card -->
<div class="menu-box">
    <h1>Welcome, Valued Customer 🌟</h1>
    <form action="view_orders.php" method="get">
        <button type="submit">View Orders</button>
    </form>
</div>

</body>
</html>
 