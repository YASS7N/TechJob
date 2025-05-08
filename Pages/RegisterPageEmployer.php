<?php
session_start();

if (isset($_SESSION['register_errors'])) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oups...',
            html: '" . implode("<br>", $_SESSION['register_errors']) . "',
        });
    </script>";
    unset($_SESSION['register_errors']);
}

if (isset($_SESSION['registration_success'])) {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Succès !',
            text: '" . $_SESSION['registration_success'] . "',
        }).then(() => {
            window.location.href = './LoginPage.php';
        });
    </script>";
    unset($_SESSION['registration_success']);
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
    <link rel="stylesheet" href="../css/sign.css"/>
    <link rel="stylesheet" href="../css/select.css"/>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
<img class="fade-bg" src="../assets/images/login.png" alt="background">
<div class="blue-overlay"></div>
<form class="form-container" action="../controllers/check-register.php" method="POST">
  <h3>Inscription Employeur</h3>

  <div class="form-row">
    <div class="input-group">
      <input type="text" name="firstName" required placeholder=" " />
      <label>Prénom</label>
    </div>

    <div class="input-group">
      <input type="text" name="lastName" required placeholder=" " />
      <label>Nom de famille</label>
    </div>
  </div>

  <div class="form-row">
    <div class="input-group">
      <input type="text" name="username" required placeholder=" " />
      <label>Nom d'utilisateur</label>
    </div>

    <div class="input-group">
      <input type="email" name="email" required placeholder=" " />
      <label>E-mail professionnel</label>
    </div>
  </div>

  <div class="form-row">
    <div class="input-group">
      <input type="password" name="password" required placeholder=" " />
      <label>Mot de passe</label>
    </div>

    <div class="input-group">
      <input type="password" name="confirmPassword" required placeholder=" " />
      <label>Confirmer le mot de passe</label>
    </div>
  </div>

  <div class="form-row">
    <div class="input-group">
      <input type="text" name="phone" placeholder=" " />
      <label>Numéro de téléphone</label>
    </div>

    <div class="input-group">
      <input type="text" name="companyName" required placeholder=" " />
      <label>Nom de l'entreprise</label>
    </div>
  </div>

  <div class="form-row">
    <div class="input-group select-group">
      <select name="industry" required>
        <option value="" disabled selected hidden></option>
        <?php foreach ($secteurs as $secteur): ?>
          <option value="<?= htmlspecialchars($secteur['id']) ?>">
            <?= htmlspecialchars($secteur['nom']) ?>
          </option>
        <?php endforeach; ?>
      </select>
      <label>Secteur d'activité</label>
    </div>

    <div class="input-group select-group">
      <select name="companySize" required>
        <option value="" disabled selected hidden></option>
        <?php foreach ($tailles as $taille): ?>
          <option value="<?= htmlspecialchars($taille['id']) ?>">
            <?= htmlspecialchars($taille['libelle']) ?>
          </option>
        <?php endforeach; ?>
      </select>
      <label>Taille de l'entreprise</label>
    </div>
  </div>

  <input type="hidden" name="role" value="<?php echo $role; ?>">

  <button type="submit" class="btn-register">S'inscrire</button>

  <div class="bottom-line">
    <p>Vous avez déjà un compte ? <a href="./LoginPage.php">Connectez-vous ici !</a></p>
  </div>
</form>


  <script>
    document.querySelectorAll('select').forEach(select => {
      select.addEventListener('change', () => {
        if (select.value) {
          select.classList.add('has-value');
        } else {
          select.classList.remove('has-value');
        }
      });
    });
  </script>


</body>
</html>