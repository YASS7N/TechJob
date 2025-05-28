<?php
require_once '../includes/db-connection.php';

$token = $_POST['token'];
$newPassword = $_POST['newPassword'];
$confirmPassword = $_POST['confirmPassword'];

if ($newPassword !== $confirmPassword) {
    die("⚠️ Les mots de passe ne correspondent pas.");
}

$stmt = $pdo->prepare("SELECT userId, expires_at FROM reset_tokens WHERE token = ?");
$stmt->execute([$token]);
$row = $stmt->fetch();

if (!$row || strtotime($row['expires_at']) < time()) {
    die("❌ Token invalide ou expiré.");
}

$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
$update = $pdo->prepare("UPDATE users SET password = ? WHERE userId = ?");
$update->execute([$hashedPassword, $row['userId']]);

$pdo->prepare("DELETE FROM reset_tokens WHERE token = ?")->execute([$token]);

echo "✅ Mot de passe mis à jour avec succès.";
