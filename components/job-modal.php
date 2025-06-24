<?php
require_once "../includes/db-connection.php";

$default_id = 1;
$jobId = isset($_GET['jobId']) ? intval($_GET['jobId']) : $default_id;
if (!$jobId) {
    die("ID de l'emploi non spécifié !");
}

$conn = connectDB();
$sql = "SELECT * FROM jobs WHERE id = $jobId";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "<p>Offre d'emploi introuvable !</p>";
    exit;
}

$job = mysqli_fetch_assoc($result);
$skills = explode(',', $job['skills']);
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<link rel="stylesheet" href="../css/modal-job.css">

<div class="modal-content">
    <div class="modal-header">
        <h2><?= htmlspecialchars($job['title']) ?></h2>
        <span class="close" onclick="closeModal()">&times;</span>
    </div>

    <!-- Stylized Company Name -->
    <p class="company-name"><?= htmlspecialchars($job['companyName']) ?></p>

    <div class="info-grid">
        <div class="info-box blue"><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($job['location']) ?></div>
        <div class="info-box orange"><i class="fas fa-briefcase"></i> <?= htmlspecialchars($job['type']) ?></div>
        <div class="info-box green"><i class="fas fa-clock"></i> <?= htmlspecialchars($job['duration']) ?></div>
        <div class="info-box yellow"><i class="fas fa-sack-dollar"></i> <?= htmlspecialchars($job['salaryRange']) ?></div>
    </div>

    <div class="detail-box purple">
        <i class="fas fa-chart-line"></i> Expérience: <?= htmlspecialchars($job['experience']) ?>
    </div>

    <div class="detail-box green-card">
        <i class="fas fa-code"></i> Compétences: <?= htmlspecialchars(implode(', ', array_map('trim', $skills))) ?>
    </div>

    <div class="section">
        <h3>Description du poste</h3>
        <p><?= nl2br(htmlspecialchars($job['description'])) ?></p>
    </div>

    <div class="section">
        <h3>Exigences</h3>
        <p><?= nl2br(htmlspecialchars($job['requirements'])) ?></p>
    </div>
</div>
