<?php
$token = $_GET['token'] ?? '';
?>
<form action="handle-reset.php" method="POST" class="w-100" style="max-width: 400px; margin: auto;">
  <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
  <div class="mb-3">
    <label for="newPassword">Nouveau mot de passe</label>
    <input type="password" name="newPassword" class="form-control" required>
  </div>
  <div class="mb-3">
    <label for="confirmPassword">Confirmez le mot de passe</label>
    <input type="password" name="confirmPassword" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-success w-100">Réinitialiser</button>
</form>
