<?php
session_start();
require_once '../includes/db-connection.php';
require_once '../includes/helper-functions.php';
$conn = connectDB();

// Set the current page correctly for header navigation
$currentPage = 'MyAccount';  // Make sure this is defined before including the header
require_once '../includes/applicant-header.php';

if (!isset($_SESSION['userId'])) {
    header("Location: LoginPage.php");
    exit();
}

$userId = $_SESSION['userId'];
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $description = $_POST['description'];

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === 0) {
        $targetDir = "../uploads/";
        $ext = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . "." . $ext;
        $targetFile = $targetDir . $filename;
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile);
        $profilePicture = "uploads/" . $filename;

        $query = "UPDATE users SET fullname='$fullname', description='$description', profile_picture='$profilePicture' WHERE userId='$userId'";
    } else {
        $query = "UPDATE users SET fullname='$fullname', description='$description' WHERE userId='$userId'";
    }

    if (mysqli_query($conn, $query)) {
        $message = "Profil mis à jour avec succès.";
    } else {
        $message = "Erreur: " . mysqli_error($conn);
    }
}

$result = mysqli_query($conn, "SELECT * FROM users WHERE userId='$userId'");
$user = mysqli_fetch_assoc($result);

$defaultImage = "../assets/icons/default-profile.png";
$profilePic = !empty($user['profile_picture']) ? "../" . $user['profile_picture'] : $defaultImage;

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="/TechJob/css/myaccount.css">
</head>
<body>
<div class="profile-card">
    <div class="profile-banner"></div>
    <div class="profile-image-wrapper">
        <img src="<?= $profilePic ?>" alt="Profile Picture" class="profile-img">
        <label for="profile_picture" class="edit-icon">
            <img src="../assets/icons/camera-icon.png" alt="Edit">
        </label>
    </div>
    <div class="profile-details">
        <h2><?= htmlspecialchars($user['fullname']) ?></h2>
        <p class="role-text">IT Specialist</p> <!-- you can make this dynamic later -->
        <p class="description-text"><?= !empty($user['description']) ? htmlspecialchars($user['description']) : "Ajoutez une description..." ?></p>
    </div>

    <form class="profile-form" action="" method="POST" enctype="multipart/form-data">
        <?php if ($message): ?>
            <p class="message"><?= $message ?></p>
        <?php endif; ?>

        <input type="file" id="profile_picture" name="profile_picture" accept="image/*" style="display: none;">

        <label for="fullname">Nom complet</label>
        <input type="text" id="fullname" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>" required>

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4"><?= htmlspecialchars($user['description'] ?? '') ?></textarea>

        <button type="submit">Mettre à jour</button>
    </form>
</div>

    <?php include_once('../includes/footer.php') ?>
</body>
</html>
