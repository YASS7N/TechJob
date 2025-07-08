<?php
session_start();

// Auto-login from "remember me" cookie
if (!isset($_SESSION['userId']) && isset($_COOKIE['remember_me'])) {
    require_once '../includes/db-connection.php';
    $conn = connectDB();

    $userId = $_COOKIE['remember_me'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE userId = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION['userId'] = $user['userId'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['user'] = $user;
        $_SESSION['login_success'] = "Welcome back, " . $user['username'] . "!";

        $redirectPage = ($user['role'] === 'employer') ? "EmployerPage.php" : "HomePage.php";
        header("Location: $redirectPage");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Connexion - TechJob</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/loginstyle.css" />
</head>
<body>
  <a href="HomePage.php" class="back-button">
        <i class="fas fa-arrow-left"></i>
        Retourner
    </a>

  <img src="../assets/images/login.png" class="fade-bg" alt="background"/>
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
        <label class="remember-me">
    <input type="checkbox" name="remember"/>
    Se souvenir de moi
  </label>
      <button type="submit" class="btn-login">Se connecter</button>
    </div>
 <div class="forgot-password-wrapper">
  <a href="forgot-password.php" class="forgot-text">
       <p>Mot de passe oublié ?
  <a class="forgot-link ms-1" href="forgot-password.php">Cliquez ici</a>
      </p>
  </a>
</div>

</div>
    
    <div class="bottom-line">
      <p>Vous n'avez pas de compte ?
  <a class="login-form-bottom-link" href="SignRolePage.php">Créez-en un maintenant !</a>
      </p>
    </div>
    <?php
      if (isset($_SESSION['login_error'])) {
          echo '<div class="error">' . htmlspecialchars($_SESSION['login_error']) . '</div>';
          unset($_SESSION['login_error']);
      }
    ?>
  </form>

  <footer>© 2025 TechJob - Tous droits réservés</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
