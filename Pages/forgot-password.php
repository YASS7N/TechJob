<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mot de passe oublié - TechJob</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/loginstyle.css" />
</head>
<body>

  <a href="LoginPage.php" class="back-button">
    <i class="fas fa-arrow-left"></i>
    Retourner
  </a>

  <img src="../assets/images/login.png" class="fade-bg" alt="background"/>
  <div class="blue-overlay"></div>

  <form class="form-container" method="POST" action="../controllers/send-reset-link.php">
    <h3>Mot de passe oublié</h3>

    <?php
      if (isset($_SESSION['message'])) {
          echo "<p style='color:green; font-size:0.9rem; margin-bottom:1rem;'>" . htmlspecialchars($_SESSION['message']) . "</p>";
          unset($_SESSION['message']);
      }
      if (isset($_SESSION['error'])) {
          echo "<p style='color:red; font-size:0.9rem; margin-bottom:1rem;'>" . htmlspecialchars($_SESSION['error']) . "</p>";
          unset($_SESSION['error']);
      }
    ?>

    <div class="form-fields">
      <div class="input-group">
        <input type="email" name="email" id="email" required placeholder=" " />
        <label for="email">Entrez votre adresse email</label>
      </div>

      <button type="submit" class="btn-login">Envoyer le lien de réinitialisation</button>
    </div>

    <div class="bottom-line mt-3">
      <p>Vous vous souvenez de votre mot de passe ?
        <a class="login-form-bottom-link" href="LoginPage.php">Retour à la connexion</a>
      </p>
    </div>
  </form>

  <footer>© 2025 TechJob - Tous droits réservés</footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
