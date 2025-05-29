<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    

</head>
<body>
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
        <?php if (isset($_SESSION['userId'])): ?>
                <a href="MyAccount.php" class="account-link">
        <i class="fas fa-user-circle"></i> Mon compte</a>
            <?php endif; ?>


        <div class="ham-burger">
            <a href="#header" class="menu-link">
                <img src="../assets/icons/ham-burger.png" alt="icône-menu">
            </a>
        </div>
    </nav>
</header>
<style>
    .account-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
    font-size: 1rem;
    color: #111;
    text-decoration: none;
    transition: color 0.3s ease;
}

.account-link i {
    font-size: 1.2rem;
    color: #00f2ff;
}

.account-link:hover {
    color: #00f2ff;
}

</style>
