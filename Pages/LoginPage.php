<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/generalStyles.css">
    <link rel="stylesheet" href="../styles/LoginPage/form.css">
    <link rel="stylesheet" href="../styles/LoginPage/input-fields.css">
    <link rel="stylesheet" href="../styles/LoginPage/media-queries.css">
    <title>Page de Connexion - JobSpark</title>
</head>
<body>
    <button class="top-right-btn" onclick="window.location.href='../admin/admin.php'">CONNEXION ADMIN</button>
    
    <img src="../assets/images/login-background.png" class="fade-bg" alt="login-background-image">
    <form class="form-container" action="../controllers/check-login.php" method="POST">
        <h3>Content de vous revoir</h3>
        <div class="form-fields">
             <div class="input-group">
                <input type="text" id="username" name="username" required placeholder=" ">
                <label for="username">Nom d'utilisateur</label>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" required placeholder=" ">
                <label for="password">Mot de passe</label>
            </div>
            <button type="submit" class="btn-login">Se connecter</button>
        </div>
        <div class="bottom-line">
            <p>Vous n'avez pas de compte ?</p>
            <a class="login-form-bottom-link" href="./RegisterPage.php">Créez-en un maintenant !</a>
        </div>
        <?php
            session_start();
            if (isset($_SESSION['login_error'])) {
                echo '<div class="error">' . htmlspecialchars($_SESSION['login_error']) . '</div>';
                unset($_SESSION['login_error']);
            }
        ?>
    </form>
    
    <script src="../js/loginForm.js"></script>
</body>
</html>