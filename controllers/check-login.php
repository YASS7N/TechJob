<?php
session_start();
require_once '../includes/db-connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connectDB();

    if (empty($_POST['username']) || empty($_POST['password'])) {
        $_SESSION['login_error'] = "Nom d'utilisateur et mot de passe requis.";
        header("Location: ../Pages/LoginPage.php");
        exit();
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']); 

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['userId'] = $user['userId'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['user'] = $user; 
            $_SESSION['login_success'] = "Welcome, " . $user['username'] . "!"; 

            $redirectPage = ($user['role'] === 'employer') ? "EmployerPage.php" : "HomePage.php";
            header("Location: ../Pages/$redirectPage");
            exit();
        } else {
            $_SESSION['login_error'] = "Nom d'utilisateur ou mot de passe invalide.";
        }
    } else {
        $_SESSION['login_error'] = "Nom d'utilisateur ou mot de passe invalide.";
    }

    $stmt->close();
    $conn->close();

    header("Location: ../Pages/LoginPage.php");
    exit();
}
?>
