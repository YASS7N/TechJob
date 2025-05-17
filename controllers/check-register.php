<?php
session_start();
require_once '../includes/db-connection.php';
require_once '../includes/validator-functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connectDB();

    $firstName = sanitizeInput($_POST['firstName']);
    $lastName = sanitizeInput($_POST['lastName']);
    $username = sanitizeInput($_POST['username']);
    $email = sanitizeInput($_POST['email']);
    $phoneNo = sanitizeInput($_POST['phoneNumber']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $role = sanitizeInput($_POST['role']);
    $name = $firstName . " " . $lastName;

    $errors = [];

    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long";
    }

    if(!checkEmail($email)) {
         $errors[] = "Enter a valid email.";
    }

    $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $errors[] = "Username already exists";
    }
    $stmt->close();

    if (!empty($errors)) {
        $_SESSION['register_errors'] = $errors;
        if ($role === 'employeur') {
        header("Location: ../pages/RegisterPageEmployer.php");
        } else {
        header("Location: ../pages/RegisterPage.php");
        }
        exit();
         }

    try {
        $userId = generateUserId($firstName, $lastName);

        $stmt = $conn->prepare("INSERT INTO users (userId, fullname, username, email, phone, password, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("sssssss", 
            $userId,
            $name,
            $username,
            $email,
            $phoneNo,
            password_hash($password, PASSWORD_DEFAULT), 
            $role
        );

        if ($stmt->execute()) {
            $_SESSION['registration_success'] = "Your account has been successfully created! You can now log in.";
            header("Location: ../pages/RegisterPage.php");
            exit();
        } else {
            $_SESSION['register_errors'] = ["Registration failed. Please try again."];
            header("Location: ../pages/RolePage.php");
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['register_errors'] = ["An error occurred. Please try again later."];
        error_log("Registration error: " . $e->getMessage());
        header("Location: ../pages/RolePage.php");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../pages/RegisterPage.php");
    exit();
}
?>
