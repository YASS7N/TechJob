<?php
require_once '../includes/db-connection.php';

if (!isset($_GET['category_id'])) {
    echo json_encode([]);
    exit;
}

$conn = connectDB();

$categoryId = $_GET['category_id'];
$query = "SELECT * FROM specializations WHERE category_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $categoryId);
$stmt->execute();
$result = $stmt->get_result();

$specializations = [];
while ($row = $result->fetch_assoc()) {
    $specializations[] = $row;
}

echo json_encode($specializations);
?>