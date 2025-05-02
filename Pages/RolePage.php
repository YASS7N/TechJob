<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisissez votre rôle - TechJob</title>
    <link rel="stylesheet" href="../css/roles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<a href="HomePage.php" class="back-button">
        <i class="fas fa-arrow-left"></i>
        Retourner
    </a>
    <div class="background-container">
        <img class="fade-bg" src="../assets/images/login.png" alt="background">
        <div class="overlay"></div>
    </div>
    
    <div class="choose-role-container">
        <h1 class="choose-role-title">CHOISISSEZ<br>VOTRE RÔLE</h1>
        <div class="role-buttons">
            <a href="./RegisterPage.php?role=applicant" class="role-button applicant">
                <i class="fas fa-user-graduate"></i>
                Chercheur d'emploi
            </a>
            <a href="./RegisterPage.php?role=employer" class="role-button employer">
                <i class="fas fa-briefcase"></i>
                Employeur
            </a>
        </div>
    </div>
</body>
</html>