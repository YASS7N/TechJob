<?php
require_once '../../includes/db-connection.php';
require_once '../../includes/helper-functions.php';

$conn = connectDB();

$successMessage = "";
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);

    if (empty($fullname) || empty($username) || empty($email) || empty($phone) || empty($password)) {
        $errorMessage = "All fields are mandatory.";
    } else {
        $userId = uniqid();
        $role = 'admin'; // Hardcoded role

        $query = "INSERT INTO users (userId, fullname, username, email, phone, password, role) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        $stmt->bind_param('sssssss', $userId, $fullname, $username, $email, $phone, $password, $role);

        if ($stmt->execute()) {
            header("Location: ../dashboard.php?section=add-admin");
            exit;
        } else {
            $errorMessage = "Error adding admin: " . $conn->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
