<?php
require_once '../../includes/db-connection.php';
$conn = connectDB();

$query = "SELECT 
            applicants.id AS applicant_id, 
            users.fullname, 
            users.email, 
            users.phone, 
            jobs.title AS job_title, 
            applicants.cv, 
            applicants.status 
          FROM applicants
          INNER JOIN users ON applicants.userId = users.userId
          INNER JOIN jobs ON applicants.jobId = jobs.id";
$result = $conn->query($query);
?>

<div class="container my-4">
    <h3 class="mb-4 text-white">
        <i class="fa-solid fa-users"></i> Applicant List
    </h3>

    <?php if ($result && $result->num_rows > 0): ?>
        <div class="row g-4">
            <?php while ($applicant = $result->fetch_assoc()): ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card bg-dark text-white shadow rounded-4 h-100 border border-secondary">
                        <div class="card-body d-flex flex-column">
                            <div class="mb-3">
                                <h5 class="card-title mb-2">
                                    <i class="fa-solid fa-user-circle"></i> <?= htmlspecialchars($applicant['fullname']) ?>
                                </h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-1">
                                        <i class="fa-solid fa-envelope"></i>
                                        <span class="ms-1"><?= htmlspecialchars($applicant['email']) ?></span>
                                    </li>
                                    <li class="mb-1">
                                        <i class="fa-solid fa-phone"></i>
                                        <span class="ms-1"><?= htmlspecialchars($applicant['phone']) ?></span>
                                    </li>
                                    <li class="mb-1">
                                        <i class="fa-solid fa-briefcase"></i>
                                        <span class="ms-1"><?= htmlspecialchars($applicant['job_title']) ?></span>
                                    </li>
                                    <li class="mb-1">
                                        <i class="fa-solid fa-id-badge"></i>
                                        <span class="ms-1">Applicant ID: <?= htmlspecialchars($applicant['applicant_id']) ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="mt-auto d-flex justify-content-end">
                                <form method="post" action="../../TechJob/admin/handlers/delete-applicant.php" onsubmit="return confirm('Are you sure you want to delete this applicant?');">
                                    <input type="hidden" name="applicantId" value="<?= htmlspecialchars($applicant['applicant_id']) ?>">
                                    <button type="submit" class="btn btn-danger btn-sm rounded-pill">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="text-muted">No applicants found.</p>
    <?php endif; ?>
</div>

<?php $conn->close(); ?>
