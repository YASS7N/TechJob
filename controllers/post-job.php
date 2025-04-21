<?php
session_start();
require_once '../includes/db-connection.php';
$conn = connectDB();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the user is logged in
    if (!isset($_SESSION['user']['userId'])) {
        echo json_encode(["status" => "error", "message" => "Vous devez être connecté pour publier une offre."]);
        exit();
    }

    // Retrieve form data
    $title = $_POST['job-title'];
    $duration = $_POST['duration'];
    $level = $_POST['level'];
    $minSalary = $_POST['min-salary'];
    $maxSalary = $_POST['max-salary'];
    $type = $_POST['type'];
    $location = $_POST['location'];
    $skills = $_POST['skills'];
    $category = intval($_POST['category']);
    $specializations = $_POST['specializations']; // Retrieve specialization
    $company = $_POST['company'];
    $description = $_POST['description'];
    $requirements = $_POST['requirements'];
    $postedBy = $_SESSION['user']['userId']; // Retrieve userId from session

    // Initialize errors array
    $errors = [];

    // Validate required fields
    if (empty($title) || empty($location) || empty($skills) || empty($company) || empty($description) || empty($requirements) || empty($specializations)) {
        $errors[] = "Tous les champs sont obligatoires.";
    }

    // Validate salary range
    if (!is_numeric($minSalary) || !is_numeric($maxSalary) || $minSalary < 0 || $maxSalary < $minSalary) {
        $errors[] = "Fourchette de salaire invalide. Assurez-vous que le salaire minimum est inférieur ou égal au salaire maximum.";
    }

    // If there are errors, return them as JSON
    if (count($errors) > 0) {
        echo json_encode(["status" => "error", "message" => implode("<br>", $errors)]);
        exit();
    }

    // Prepare the SQL query using prepared statements
    $query = "INSERT INTO jobs 
              (postedBy, category, title, companyName, location, 
               salaryRange, duration, type, skills, status, description, 
               requirements, specializations, experience)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'active', ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Échec de la préparation de la requête SQL : " . $conn->error]);
        exit();
    }

    // Bind parameters
    $salaryRange = "MAD $minSalary-$maxSalary"; // Format salary range
    $stmt->bind_param(
        "sisssssssssss",
        $postedBy, $category, $title, $company, $location,
        $salaryRange, $duration, $type, $skills, $description, $requirements, $specializations, $level
    );

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Offre d'emploi publiée avec succès !"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erreur lors de la publication de l'offre : " . $stmt->error]);
    }
    exit();
}
?>