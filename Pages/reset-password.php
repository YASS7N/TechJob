<?php
session_start();
require_once '../includes/db-connection.php';

$conn = connectDB();

$token = $_GET['token'] ?? '';

if ($token) {
    $sql = "SELECT * FROM users WHERE reset_token = ? AND token_expires > NOW()";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newPassword = $_POST['password'];
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $updateSql = "UPDATE users SET password = ?, reset_token = NULL, token_expires = NULL WHERE userId = ?";
            $updateStmt = mysqli_prepare($conn, $updateSql);
            mysqli_stmt_bind_param($updateStmt, "ss", $hashedPassword, $user['userId']);
            mysqli_stmt_execute($updateStmt);

            $_SESSION['message'] = "Mot de passe mis à jour. Vous pouvez vous connecter.";
            header("Location: LoginPage.php");
            exit();
        }
    } else {
        die("Lien expiré ou invalide.");
    }
} else {
    die("Lien manquant.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Réinitialiser mot de passe</title>
</head>
<body>
  <h2>Réinitialiser votre mot de passe</h2>

  <form method="POST">
    <label>Nouveau mot de passe :</label><br />
    <input type="password" name="password" required><br /><br />
    <button type="submit">Mettre à jour</button>
  </form>
</body>
</html>
