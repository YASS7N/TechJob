<?php
require_once '../../includes/db-connection.php';
$conn = connectDB();

$featuredJobsQuery = "SELECT fj.id AS featuredId, j.title, j.companyName, j.location, j.salaryRange, j.type
                      FROM featuredJobs fj
                      INNER JOIN jobs j ON fj.jobId = j.id";
$featuredJobsResult = $conn->query($featuredJobsQuery);
$featuredJobs = $featuredJobsResult->fetch_all(MYSQLI_ASSOC);

$allJobsQuery = "SELECT id, title, companyName FROM jobs WHERE status = 'active'";
$allJobsResult = $conn->query($allJobsQuery);
$allJobs = $allJobsResult->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<div class="container mt-4">

    <div class="card glassmorph-card shadow-sm rounded-4 p-3 mb-4">
        <h4 class="mb-3">
            <i class="fa-solid fa-star"></i> Add New Featured Job
        </h4>
        <form method="POST" action="../../TechJob/admin/handlers/modify-featured-jobs.php">
            <input type="hidden" name="action" value="add">
            <div class="mb-3">
                <label for="jobId" class="form-label">Select Job</label>
                <select class="form-select" id="jobId" name="jobId" required>
                    <option value="">-- Select a Job --</option>
                    <?php foreach ($allJobs as $job): ?>
                        <option value="<?= htmlspecialchars($job['id']); ?>">
                            <?= htmlspecialchars($job['title']) ?> - <?= htmlspecialchars($job['companyName']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Add to Featured
            </button>
        </form>
    </div>

    <div class="card glassmorph-card shadow-sm rounded-4 p-3">
        <h4 class="mb-3">
            <i class="fa-solid fa-star"></i> Current Featured Jobs
        </h4>

        <?php if (count($featuredJobs) > 0): ?>
            <div class="table-responsive">
                <table class="table glass-table table-bordered align-middle mb-0 rounded-3">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Title</th>
                            <th>Company</th>
                            <th>Location</th>
                            <th>Salary Range</th>
                            <th>Type</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($featuredJobs as $index => $job): ?>
                            <tr>
                                <td class="text-center"><?= $index + 1; ?></td>
                                <td>
                                    <i class="fa-solid fa-briefcase"></i>
                                    <?= htmlspecialchars($job['title']); ?>
                                </td>
                                <td>
                                    <i class="fa-solid fa-building"></i>
                                    <?= htmlspecialchars($job['companyName']); ?>
                                </td>
                                <td>
                                    <i class="fa-solid fa-location-dot"></i>
                                    <?= htmlspecialchars($job['location']); ?>
                                </td>
                                <td>
                                    <i class="fa-solid fa-money-bill-wave"></i>
                                    <?= htmlspecialchars($job['salaryRange']); ?>
                                </td>
                                <td>
                                    <i class="fa-solid fa-tag"></i>
                                    <?= htmlspecialchars($job['type']); ?>
                                </td>
                                <td class="text-center">
                                    <form method="POST" action="../../TechJob/admin/handlers/modify-featured-jobs.php" class="d-inline">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="featuredId" value="<?= $job['featuredId']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm rounded-pill">
                                            <i class="fa-solid fa-trash"></i> Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-muted">No featured jobs found.</p>
        <?php endif; ?>
    </div>
</div>
