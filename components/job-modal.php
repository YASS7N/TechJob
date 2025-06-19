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
    echo "Offre d'emploi introuvable !";
    exit;
}

if ($result && $job = mysqli_fetch_assoc($result)) {
    $skills = explode(',', $job['skills']);
?>
    <h2><?= htmlspecialchars($job['title']) ?></h2>
    <p><strong>Entreprise :</strong> <?= htmlspecialchars($job['companyName']) ?></p>
    <p><strong>Lieu :</strong> <?= htmlspecialchars($job['location']) ?></p>
    <p><strong>Salaire :</strong> <?= htmlspecialchars($job['salaryRange']) ?></p>
    <p><strong>Type :</strong> <?= htmlspecialchars($job['type']) ?></p>
    <p><strong>Durée :</strong> <?= htmlspecialchars($job['duration']) ?></p>
    <p><strong>Expérience requise :</strong> <?= htmlspecialchars($job['experience']) ?></p>
    <p><strong>Description :</strong> <?= nl2br(htmlspecialchars($job['description'])) ?></p>
    <p><strong>Exigences :</strong> <?= nl2br(htmlspecialchars($job['requirements'])) ?></p>
    <p><strong>Compétences :</strong></p>
    <div class="skills-container">
        <?php foreach ($skills as $skill): ?>
            <span class="skill-badge"><?= htmlspecialchars(trim($skill)) ?></span>
        <?php endforeach; ?>
    </div>
<?php
} else {
    echo "<p>Offre d'emploi introuvable !</p>";
}
?>
