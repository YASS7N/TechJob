<?php
session_start();
if (isset($_SESSION['error'])) {
    $errorMessage = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="./styles/login.css">
    <link rel="stylesheet" href="../css/admin-login.css">
</head>
<body>

<div class="container">
    <h1>TechJob</h1>
    <h2>Admin Dashboard</h2>
    
    <?php if (!empty($errorMessage)): ?>
        <div class="alert"><?= htmlspecialchars($errorMessage) ?></div>
    <?php endif; ?>
    
    <form method="POST" action="./handlers/check-admin-login.php">
        <div class="form-group">
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
        </div>
        
        <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
        </div>
        <button type="submit" class="btn">Login</button>
        <a href="../Pages/LoginPage.php" class="link">Applicant/Employer Login</a>
    </form>
</div>

<canvas id="particles-canvas"></canvas>
<div class="floating-shape" style="top: 10%; left: 5%;"></div>
<div class="floating-shape" style="top: 40%; left: 70%; width: 100px; height: 100px;"></div>
<div class="floating-shape" style="top: 80%; left: 20%;"></div>
<div class="scan-line"></div>

<script src="./scripts/particles.js"></script>
<script>
    const canvas = document.getElementById("particles-canvas");
const ctx = canvas.getContext("2d");
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

let particles = [];

for (let i = 0; i < 80; i++) {
  particles.push({
    x: Math.random() * canvas.width,
    y: Math.random() * canvas.height,
    vx: (Math.random() - 0.5) * 0.5,
    vy: (Math.random() - 0.5) * 0.5,
    size: Math.random() * 2 + 1,
    hue: Math.random() * 60 + 180
  });
}

function animate() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  
  particles.forEach(p => {
    p.x += p.vx;
    p.y += p.vy;

    if (p.x < 0 || p.x > canvas.width) p.vx *= -1;
    if (p.y < 0 || p.y > canvas.height) p.vy *= -1;

    ctx.beginPath();
    ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
    ctx.fillStyle = `hsl(${p.hue}, 100%, 70%)`;
    ctx.fill();
  });

  requestAnimationFrame(animate);
}

animate();

</script>
</body>
</html>
