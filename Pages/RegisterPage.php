<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Inscription - JobSpark</title>
    <link rel="stylesheet" href="../styles/generalStyles.css">
    <link rel="stylesheet" href="../styles/RegisterPage/form.css">
    <link rel="stylesheet" href="../styles/RegisterPage/input-field-row.css">
    <link rel="stylesheet" href="../styles/RegisterPage/media-queries.css">
    <link rel="stylesheet" href="../styles/RegisterPage/common-styles.css">
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
?>

<form class="form-container" action="../controllers/check-register.php" method="POST">
<img src="../assets/images/signup.png" class="image-column">
<div class="form-content">
        <h3 class="register-form-heading">Créer un Compte</h3>
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
                    <input type="username" id="username" name="username" required placeholder=" ">
                    <label for="username">Nom d'utilisateur</label>
                </div>
                 <div class="input-group-register-form">
                    <input type="email" id="email" name="email" required placeholder=" ">
                    <label for="email">E-mail</label>
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
            </div>
        </div>

        <div class="full-width-row">
            <div class="role-selection">
                <p class="role-title">Inscrivez-vous en tant que :</p>
                <div class="radio-group">
                    <div class="radio-option">
                        <input type="radio" id="applicant" name="role" value="applicant" required>
                        <label for="applicant">Chercheur d'emploi</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="employer" name="role" value="employer">
                        <label for="employer">Employeur</label>
                    </div>
                </div>
            </div>
            <button class="btn-register" type="submit">S'inscrire</button>

            <div class="bottom-line">
                <p>Vous avez déjà un compte ?</p>
                <a href="./LoginPage.php">Connectez-vous ici !</a>
            </div>
        </div>
    </div>
</form>

<script src="../js/registerForm.js"></script>

</body>
</html>