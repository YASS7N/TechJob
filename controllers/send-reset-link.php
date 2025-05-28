<?php
require_once '../includes/db-connection.php';  
$conn = connectDB();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];

    // Prepare statement
    $stmt = mysqli_prepare($conn, "SELECT userId FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $userId);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);   

    if ($userId) {
        $token = bin2hex(random_bytes(32));
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Insert token into reset_tokens table
        $insert = mysqli_prepare($conn, "INSERT INTO reset_tokens (userId, token, expires_at) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($insert, "sss", $userId, $token, $expiry);
        mysqli_stmt_execute($insert);
        mysqli_stmt_close($insert);

        // Send email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.yourhost.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'your@email.com';
            $mail->Password = 'yourpassword';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('your@email.com', 'TechJob Support');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Réinitialisation de mot de passe';
            $mail->Body = "Cliquez sur ce lien pour réinitialiser votre mot de passe : <br>
              <a href='http://yourdomain.com/reset-password.php?token=$token'>Réinitialiser</a>";

            $mail->send();
            echo "✅ Lien de réinitialisation envoyé.";
        } catch (Exception $e) {
            echo "Erreur d'envoi de mail : {$mail->ErrorInfo}";
        }
    } else {
        echo "⚠️ Adresse email non trouvée.";
    }
}
