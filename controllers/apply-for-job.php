<?php
session_start();
require_once "../includes/db-connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = connectDB();
    // mysqli_real_escape_string is used to prevent
    // characters that could lead to SQL Injection attacks
    // this function sanitizes input for security
    $userId = mysqli_real_escape_string($conn, $_POST['userId']);
    $jobId = mysqli_real_escape_string($conn, $_POST['jobId']);
    $experience = intval($_POST['experience']);
    $joiningDate = mysqli_real_escape_string($conn, $_POST['joiningDate']);
    $coverLetter = mysqli_real_escape_string($conn, $_POST['coverLetter']);

    if (!empty($_FILES['cv']['name'])) {
        $cvName = $_FILES['cv']['name'];
        $cvTarget = "../uploaded-files/" . $cvName;
        if (move_uploaded_file($_FILES['cv']['tmp_name'], $cvTarget)) {
            $cvPath = $cvName;
        } else {
            echo "<script>alert('Échec du téléchargement du CV.')</script>";
            header('Location: JobApplication.php');
            exit;
        }
    } else {
        echo "<script>alert('Le CV est obligatoire.')</script>";
        header('Location: JobApplication.php');
        exit;
    }

    $sql = "INSERT INTO applicants (userId, jobId, cv, status, experience, joiningDate, coverLetter) 
            VALUES ('$userId', '$jobId', '$cvPath', 'new', '$experience', '$joiningDate', '$coverLetter')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Candidature envoyée avec succès !');</script>";
        header('Location: ../Pages/HomePage.php');
        exit;
    } else {
        echo "Erreur : " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    die("Méthode de requête invalide.");
}
?>
