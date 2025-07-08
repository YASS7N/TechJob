<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ./admin-login.php");
    exit;
}
$name = $_SESSION['admin']['fullname'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles/dashboard.css">
    <link rel="stylesheet" href="../css/dashboard.css">
        <link rel="stylesheet" href="../css/dash.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><i class="fa-solid fa-rocket"></i> TECH JOB Admin Dashboard</a>
        <span class="navbar-text ms-auto text-white">Welcome back, <strong><?php echo htmlspecialchars($name); ?></strong></span>
        <a class="btn btn-danger ms-3" href="./handlers/logout-admin.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block sidebar">
            <div class="position-sticky">
                <ul class="nav flex-column" id="sidebar-menu">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" data-section="dashboard">
                            <i class="fa-solid fa-gauge"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-section="job-list">
                            <i class="fa-solid fa-briefcase"></i> Job List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-section="category-list">
                            <i class="fa-solid fa-layer-group"></i> Category List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-section="featured-jobs">
                            <i class="fa-solid fa-star"></i> Featured Jobs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-section="user-list">
                            <i class="fa-solid fa-users"></i> User List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-section="applicant-list">
                            <i class="fa-solid fa-user-check"></i> Applicant List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-section="add-admin">
                            <i class="fa-solid fa-user-plus"></i> Add Admin
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10" id="main-content">
            <!-- Loaded content will appear here -->
        </main>
    </div>
</div>

<script>
    const contentMap = {
        'job-list': 'Views/job-list.php',
        'category-list': 'Views/category-list.php',
        'featured-jobs': 'Views/featured-jobs.php',
        'user-list': 'Views/user-list.php',
        'applicant-list': 'Views/applicant-list.php',
        'add-admin': 'Views/add-admin.php',
        'dashboard': 'Views/admin-stats.php'
    };

    const baseURL = `${window.location.origin}/TechJob/admin/`;

    document.getElementById('sidebar-menu').addEventListener('click', (event) => {
        if (event.target.closest('a')) {
            event.preventDefault();
            const link = event.target.closest('a');

            // Toggle active link
            document.querySelectorAll('#sidebar-menu .nav-link').forEach(link => link.classList.remove('active'));
            link.classList.add('active');

            const section = link.getAttribute('data-section');
            if (contentMap[section]) {
                const pageUrl = `${baseURL}${contentMap[section]}`;
                fetch(pageUrl)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('main-content').innerHTML = html;
                        history.pushState({ section }, '', `${baseURL}dashboard.php?section=${section}`);
                    })
                    .catch(err => console.error(err));
            }
        }
    });

    window.addEventListener('popstate', (event) => {
        if (event.state?.section) {
            const section = event.state.section;
            if (contentMap[section]) {
                const pageUrl = `${baseURL}${contentMap[section]}`;
                fetch(pageUrl)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('main-content').innerHTML = html;
                        document.querySelectorAll('#sidebar-menu .nav-link').forEach(link => link.classList.remove('active'));
                        document.querySelector(`[data-section="${section}"]`).classList.add('active');
                    });
            }
        }
    });

    const urlParams = new URLSearchParams(window.location.search);
    const initialSection = urlParams.get('section') || 'dashboard';
    document.querySelector(`[data-section="${initialSection}"]`).click();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<canvas id="particles-canvas"></canvas>

<div class="floating-shape" style="top: 15%; left: 10%;"></div>
<div class="floating-shape" style="top: 35%; left: 80%; width: 120px; height: 120px;"></div>
<div class="floating-shape" style="top: 70%; left: 30%; width: 100px; height: 100px;"></div>

<div class="scan-line"></div>

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
        vx: (Math.random() - 0.5) * 0.4,
        vy: (Math.random() - 0.5) * 0.4,
        size: Math.random() * 2 + 1,
        hue: Math.random() * 60 + 180
    });
}

function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    particles.forEach((p, i) => {
        p.x += p.vx;
        p.y += p.vy;

        if (p.x < 0 || p.x > canvas.width) p.vx *= -1;
        if (p.y < 0 || p.y > canvas.height) p.vy *= -1;

        ctx.beginPath();
        ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
        ctx.fillStyle = `hsl(${p.hue}, 100%, 70%)`;
        ctx.fill();

        // draw connection lines
        for (let j = i + 1; j < particles.length; j++) {
            const dx = p.x - particles[j].x;
            const dy = p.y - particles[j].y;
            const dist = Math.sqrt(dx * dx + dy * dy);
            if (dist < 100) {
                ctx.beginPath();
                ctx.moveTo(p.x, p.y);
                ctx.lineTo(particles[j].x, particles[j].y);
                ctx.strokeStyle = `hsla(${p.hue}, 100%, 60%, 0.1)`;
                ctx.stroke();
            }
        }
    });

    requestAnimationFrame(animate);
}

animate();

</script>

</body>
</html>
