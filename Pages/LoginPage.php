<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Connexion - TechJob</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/login.css" />
</head>
<body>
  <button class="top-right-btn" onclick="window.location.href='admin.php'">CONNEXION ADMIN</button>

  <img src="../assets/images/login.png" class="fade-bg" alt="background" />
  <div class="blue-overlay"></div>
  <form class="form-container" action="../controllers/check-login.php" method="POST">
    <h3>Content de vous revoir</h3>
    <div class="form-fields">
      <div class="input-group">
        <input type="text" id="username" name="username" required placeholder=" " />
        <label for="username">Nom d'utilisateur</label>      
    </div>
      <div class="input-group">
        <input type="password" id="password" name="password" required placeholder=" " />
        <label for="password">Mot de passe</label>
      </div>
      <button type="submit" class="btn-login">Se connecter</button>
    </div>
    <div class="bottom-line">
      <p>Vous n'avez pas de compte ?
        <a class="login-form-bottom-link" href="RolePage.php">Créez-en un maintenant !</a>
      </p>
    </div>
    <?php
      session_start();
      if (isset($_SESSION['login_error'])) {
          echo '<div class="error">' . htmlspecialchars($_SESSION['login_error']) . '</div>';
          unset($_SESSION['login_error']);
      }
    ?>
  </form>

  <footer>© 2025 TechJob - Tous droits réservés</footer>

</body>
</html>
