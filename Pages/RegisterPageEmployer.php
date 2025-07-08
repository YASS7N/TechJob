<?php
session_start();
require_once '../includes/db-connection.php'; 

$conn = connectDB(); 

$tailles = [];
$taille_query = "SELECT id, taille FROM tailles_entreprise";
$taille_result = mysqli_query($conn, $taille_query);

if ($taille_result) {
    while ($row = mysqli_fetch_assoc($taille_result)) {
        $tailles[] = $row;
    }
}

$secteurs = [];
$secteur_query = "SELECT id, nom_secteur FROM secteurs_activite";
$secteur_result = mysqli_query($conn, $secteur_query);

if ($secteur_result) {
    while ($row = mysqli_fetch_assoc($secteur_result)) {
        $secteurs[] = $row;
    }
}

$role = isset($_GET['role']) ? htmlspecialchars($_GET['role']) : '';
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription Employeur - TechJob</title>
  <link rel="stylesheet" href="../styles/generalStyles.css">
  <link rel="stylesheet" href="../css/registerEmployer.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>


<img class="fade-bg" src="../assets/images/login.png" alt="background">
<div class="blue-overlay"></div>

<form class="form-container" action="../controllers/check-register.php" method="POST">
  <h3 class="register-form-heading">Créer un Compte Employeur</h3>
  <div class="form-fields-row">
    <div class="input-column">
      <div class="input-group-register-form">
        <input type="text" id="firstName" name="firstName" required placeholder=" ">
        <label for="firstName">Prénom</label>
      </div>
      <div class="input-group-register-form">
        <input type="text" id="lastName" name="lastName" required placeholder=" ">
        <label for="lastName">Nom de famille</label>
      </div>
      <div class="input-group-register-form">
        <input type="text" id="username" name="username" required placeholder=" ">
        <label for="username">Nom d'utilisateur</label>
      </div>
      <div class="input-group-register-form">
        <input type="email" id="email" name="email" required placeholder=" ">
        <label for="email">E-mail</label>
      </div>
      <div class="input-group-register-form">
        <select name="taille_entreprise" required>
          <option value="" disabled selected hidden>Taille de l'entreprise</option>
          <?php foreach ($tailles as $taille): ?>
            <option value="<?= $taille['id'] ?>"><?= htmlspecialchars($taille['taille']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="input-column">
      <div class="input-group-register-form">
        <input type="password" id="password" name="password" required placeholder=" ">
        <label for="password">Mot de passe</label>
      </div>
      <div class="input-group-register-form">
        <input type="password" id="confirmPassword" name="confirmPassword" required placeholder=" ">
        <label for="confirmPassword">Confirmer le mot de passe</label>
      </div>
      <div class="input-group-register-form">
        <input type="text" id="phoneNumber" name="phoneNumber" placeholder=" ">
        <label for="phoneNumber">Numéro de téléphone</label>
      </div>
      <div class="input-group-register-form">
        <select name="secteur_activite" required>
          <option value="" disabled selected hidden>Secteur d'activité</option>
          <?php foreach ($secteurs as $secteur): ?>
            <option value="<?= $secteur['id'] ?>"><?= htmlspecialchars($secteur['nom_secteur']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
  </div>

  <input type="hidden" name="role" value="<?php echo $role; ?>">

  <button class="btn-register" type="submit">S'inscrire</button>

  <div class="bottom-line">
    <p>Vous avez déjà un compte ? <a href="./LoginPage.php">Connectez-vous ici !</a></p>
  </div>
</form>

<script src="../js/registerForm.js"></script>
<?php if (isset($_SESSION['register_errors'])): ?>
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Erreur d\'inscription',
      html: `<?= implode('<br>', $_SESSION['register_errors']) ?>`,
      confirmButtonText: 'OK'
    });
  </script>
  <?php unset($_SESSION['register_errors']); ?>
<?php endif; ?>
</body>
</html>
