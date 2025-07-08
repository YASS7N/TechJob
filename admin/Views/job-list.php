<?php
require_once __DIR__ . '/../../includes/db-connection.php';
$conn = connectDB();

$sql = "
    SELECT 
        jobs.id, 
        jobs.title, 
        jobs.companyName, 
        jobs.location, 
        jobs.status, 
        categories.title AS categoryTitle
    FROM jobs
    LEFT JOIN categories ON jobs.category = categories.id
    ORDER BY jobs.id DESC
";
$result = mysqli_query($conn, $sql);
?>

<h2 class="text-white mb-4">Liste des Offres</h2>

<div class="row g-3">
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="col-12">
            <div class="card d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center p-4">
                <div>
                    <h5 class="mb-2"><?= htmlspecialchars($row['title']) ?></h5>
                    <p class="mb-1 text-white-6 0">
                        <i class="fa-solid fa-building"></i> <?= htmlspecialchars($row['companyName']) ?> &nbsp;
                        <i class="fa-solid fa-location-dot"></i> <?= htmlspecialchars($row['location']) ?>
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge text-white" style="background-color: <?= categoryColor($row['categoryTitle']) ?>;">
                            <i class="fa-solid fa-tag"></i> <?= htmlspecialchars($row['categoryTitle']) ?>
                        </span>

                        <span class="badge <?= $row['status'] === 'active' ? 'bg-success' : 'bg-warning text-white' ?>">
                            <?= htmlspecialchars($row['status']) ?>
                        </span>
                    </div>
                </div>
                <div class="mt-3 mt-md-0 d-flex align-items-center gap-3">
                    <small class="text-light">ID #<?= $row['id'] ?></small>
                    <button class="btn btn-danger btn-sm">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php
function categoryColor($category) {
    $map = [
        'Design' => '#f97316',        // orange
        'Development' => '#3b82f6',   // blue
        'Management' => '#c084fc',    // violet
    ];
    return $map[$category] ?? '#94a3b8'; // default fallback
}
?>
