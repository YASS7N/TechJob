<?php
$user = [];
$name="";
$username="";

if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    $name = $user['fullname'];
    $username = $user['username'];
} else {
    $name = 'Employer Name';
    $username = 'Your Username';
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="../css/employer-header.css">
<header class="custom-header">
    <nav class="navbar navbar-expand-lg">
        <div class="container">

            <a class="navbar-brand" href="#">
                <img src="../assets/logos/logo-1.png" alt="logo-nav">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="back-fill">
                        <i class="fa-solid fa-user"></i> <?php echo htmlspecialchars($username); ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="back-fill red" href="../controllers/logout.php">
                        <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
                    </a>
                </li>
            </ul>

            </div>
        </div>
    </nav>
</header>  