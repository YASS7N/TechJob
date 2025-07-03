<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/navbar.css">
</head>
<body>
    <style>
.ham-burger i {
  font-size: 40px !important;
  color: black !important;
}
        </style>
<header id="header">
    <nav class="home-page-nav">
        <a href="HomePage.php" class="logo">
            <img src="../assets/logos/logo-1.png" alt="logo-navigation">
        </a>
        <div class="nav-links">
            <?php if ($currentPage !== 'Home'): ?>
                <a href="./HomePage.php#header">Accueil</a>
            <?php endif; ?>
            <?php if ($currentPage !== 'JobsListing'): ?>
                <a href="./JobsListing.php">Trouver un emploi</a>
            <?php endif; ?>
            <a href="./HomePage.php#jobs-section">Emplois en vedette</a>
            <?php if ($currentPage !== 'About'): ?>
                <a href="./AboutUsPage.php">À propos</a>
            <?php endif; ?>
            <a href="./ContactPage.php#contact">Contact</a>

            <?php if (isset($_SESSION['userId'])): ?>
                <a href="../controllers/logout.php" class="btn-logout">Déconnexion</a>
            <?php else: ?>
                <a href="./LoginPage.php" class="btn-login">Connexion</a>
            <?php endif; ?>
        </div>


      <div class="ham-burger menu-link">
<i class="fas fa-bars"></i>
</div>

    </nav>
</header>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const menuLink = document.querySelector('.ham-burger');
  const navLinks = document.querySelector('.nav-links');

  menuLink.addEventListener('click', () => {
    navLinks.classList.toggle('active');
  });
});

</script>
