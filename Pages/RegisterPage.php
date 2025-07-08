<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Inscription - TechJob</title>
    <link rel="stylesheet" href="../styles/generalStyles.css">
    <link rel="stylesheet" href="../css/registration.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

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
<div class="page-wrapper">
<img class="fade-bg" src="../assets/images/login.png" alt="background">
<div class="blue-overlay"></div>
<form class="form-container" action="../controllers/check-register.php" method="POST">
    <h3 class="register-form-heading">Créer un Compte</h3>
    <div class="form-fields-row">
        <div class="input-column">
            <div class="input-group-register-form">
                <i class="fas fa-user"></i>
                <input type="text" id="firstName" name="firstName" required placeholder=" ">
                <label for="firstName">Prénom</label>
            </div>
            <div class="input-group-register-form">
                <i class="fas fa-user"></i>
                <input type="text" id="lastName" name="lastName" required placeholder=" ">
                <label for="lastName">Nom de famille</label>
            </div>
            <div class="input-group-register-form">
                <i class="fas fa-user-tag"></i>
                <input type="text" id="username" name="username" required placeholder=" ">
                <label for="username">Nom d'utilisateur</label>
            </div>
            <div class="input-group-register-form">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" required placeholder=" ">
                <label for="email">E-mail</label>
            </div>
        </div>

        <div class="input-column">
            <div class="input-group-register-form">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" required placeholder=" ">
                <label for="password">Mot de passe</label>
            </div>
            <div class="input-group-register-form">
                <i class="fas fa-lock"></i>
                <input type="password" id="confirmPassword" name="confirmPassword" required placeholder=" ">
                <label for="confirmPassword">Confirmer le mot de passe</label>
            </div>
            <div class="input-group-register-form">
                <i class="fas fa-phone"></i>
                <input type="text" id="phoneNumber" name="phoneNumber" placeholder=" ">
                <label for="phoneNumber">Numéro de téléphone</label>
            </div>
        </div>
    </div>

    <input type="hidden" name="role" value="<?php echo $role; ?>">

    <button class="btn-register" type="submit">S'inscrire</button>

    <div class="bottom-line">
        <p>Vous avez déjà un compte ? <a href="./LoginPage.php">Connectez-vous ici !</a></p>
    </div>
</form>
</div>
<script src="../js/registerForm.js"></script>

</body>
</html>
