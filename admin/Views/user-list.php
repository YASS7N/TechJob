<?php

require_once '../../includes/db-connection.php';
require_once '../../includes/helper-functions.php';

$conn = connectDB();

// Fetch all users except admin
$query = "SELECT userId, fullname, username, email, phone, role FROM users WHERE role != 'admin'";
$result = $conn->query($query);

$users = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$i=0;

$conn->close();
?>

<div class="container mt-4">
    <h3 class="mb-4 text-white">
        <i class="fa-solid fa-users"></i> User List
    </h3>

<?php if (!empty($users)): ?>
    <div class="row g-3">
        <?php foreach ($users as $user): ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card bg-dark text-white h-100 p-3 shadow-sm rounded-4 border border-secondary">
                    <div class="d-flex flex-column gap-2">
                        <h5 class="mb-1">
                            <i class="fa-solid fa-user"></i>
                            <?= htmlspecialchars($user['fullname']) ?>
                        </h5>
                        <p class="mb-1 text-white-50">
                            <i class="fa-solid fa-user-tag"></i>
                            <strong>Username:</strong> <?= htmlspecialchars($user['username']) ?>
                        </p>
                        <p class="mb-1 text-white-50">
                            <i class="fa-solid fa-envelope"></i>
                            <strong>Email:</strong> <?= htmlspecialchars($user['email']) ?>
                        </p>
                        <p class="mb-1 text-white-50">
                            <i class="fa-solid fa-phone"></i>
                            <strong>Phone:</strong> <?= htmlspecialchars($user['phone']) ?>
                        </p>
                        <span class="badge <?= $user['role'] === 'employer' ? 'bg-success' : 'bg-primary' ?> text-white fs-6">
                            <i class="fa-solid fa-user-shield"></i>
                            <?= htmlspecialchars(ucfirst($user['role'])) ?>
                        </span>
                        <div class="mt-3 d-flex justify-content-center">
                            <form method="POST" action="../../TechJob/admin/handlers/delete-user.php" class="d-inline">
                                <input type="hidden" name="deleteUserId" value="<?= htmlspecialchars($user['userId']) ?>">
                                <button type="submit" class="btn btn-danger btn-sm rounded-pill">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p class="text-muted">No users found.</p>
<?php endif; ?>

</div>
