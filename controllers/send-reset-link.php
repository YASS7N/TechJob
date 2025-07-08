<?php
session_start();
require_once '../includes/db-connection.php';
require '../vendor/autoload.php';  // Composer autoloader

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = connectDB();
    $email = trim($_POST['email'] ?? '');

    if (empty($email)) {
        $_SESSION['error'] = "Veuillez entrer votre adresse email.";
        header("Location: ../Pages/forgot-password.php");
        exit();
    }

    // Find user by email
    $stmt = $conn->prepare("SELECT userId FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows !== 1) {
        // Security: don't reveal if email exists or not
        $_SESSION['message'] = "Si un compte existe pour cet email, un lien de réinitialisation a été envoyé.";
        header("Location: ../Pages/forgot-password.php");
        exit();
    }

    $user = $result->fetch_assoc();

    // Generate token and expiry (1 hour)
    $token = bin2hex(random_bytes(32));
    $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

    // Save token in DB
    $updateStmt = $conn->prepare("UPDATE users SET reset_token = ?, token_expires = ? WHERE userId = ?");
    $updateStmt->bind_param("sss", $token, $expiry, $user['userId']);
    $updateStmt->execute();

    // Reset link — update domain/path as needed
    $resetLink = "http://localhost/TechJob/Pages/reset-password.php?token=" . $token;

    // Send email using PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'techjobmorocco@gmail.com'; 
        $mail->Password   = 'rzeozkujuxforngn';    
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('yourgmail@gmail.com', 'TechJob Support');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(false);
        $mail->Subject = 'Réinitialisation de votre mot de passe';
        $mail->Body    = "Bonjour,\n\nPour réinitialiser votre mot de passe, cliquez sur ce lien:\n\n" . $resetLink . "\n\nCe lien expire dans 1 heure.\n\nSi vous n'avez pas demandé cette réinitialisation, ignorez cet email.";

        $mail->send();
        $_SESSION['message'] = "Si un compte existe pour cet email, un lien de réinitialisation a été envoyé.";
    } catch (Exception $e) {
        $_SESSION['error'] = "Erreur lors de l'envoi de l'email: {$mail->ErrorInfo}";
    }

    if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
    }


    header("Location: ../Pages/forgot-password.php");
    exit();
}
