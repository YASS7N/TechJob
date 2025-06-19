<?php
require_once "../includes/helper-functions.php";
session_start();
$default = 0;
$categoryId = isset($_GET['category']) ? intval($_GET['category']) : $default;

if ($categoryId == $default) {
    $jobs = fetchAllJobs();
    $categoryName = '';
} else {
    $categoryName = "Jobs in " . fetchCategoryName($categoryId);
    $jobs = fetchJobsByCategory($categoryId);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TechJob - Offres d'Emploi<?= htmlspecialchars($categoryName) ?></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="stylesheet" href="../styles/generalStyles.css">
        <link rel="stylesheet" href="../styles/HomePage/header.css">
        <link rel="stylesheet" href="../styles/HomePage/footer.css">
        <link rel="stylesheet" href="../styles/HomePage/common-styles.css">
        <link rel="stylesheet" href="../css/jobslisting.css">
    </head>
    <body>

    <?php 
        $currentPage = "JobsListing";
        include_once '../includes/applicant-header.php'; 
    ?>

    <div class="hero-text-wrapper">
    <h1 class="hero-title">Trouvez votre emploi de rêves</h1>
    <p class="hero-subtitle">Postulez maintenant !</p>
    <div class="hero-underline"></div>
    </div>

    <div class="container">
        <h1 class="page-title"><?= htmlspecialchars($categoryName) ?></h1>
        <div class="job-list">
            <?php foreach ($jobs as $job): ?>
                <?= generateJobMarkup($job); ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="jobModal" class="modal" onclick="closeModal()">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="modal-body"></div>
        </div>
    </div>

    <?php include_once '../includes/footer.php'; ?>

    <script>
        function openModal(jobId) {
            fetch(`../components/job-modal.php?jobId=${jobId}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modal-body').innerHTML = html;
                    document.getElementById('jobModal').style.display = 'block';
                });
        }

        function closeModal() {
            document.getElementById('jobModal').style.display = 'none';
        }
    </script>
        <?php include_once('../includes/footer.php') ?>

</body>
</html>
