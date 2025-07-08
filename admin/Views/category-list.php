<?php
require_once '../../includes/db-connection.php';
session_start();
$conn = connectDB();
$success = "";
if (isset($_SESSION['success']) && $success != "") {
    $success = $_SESSION['success'];
}

function fetchAllCategories($conn) {
    $query = "SELECT id, title, (SELECT COUNT(*) FROM jobs WHERE category = categories.id) AS numberOfJobs FROM categories ORDER BY id DESC";
    $result = $conn->query($query);

    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }

    return $categories;
}

$categories = fetchAllCategories($conn);
?>

<div class="container mt-4">
    <?php if ($success != ""): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $success ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

     <div class="card glassmorph-card shadow-sm rounded-4 p-3 mb-4">
        <h4 class="mb-3">
            <i class="fa-solid fa-plus"></i> Add New Category
        </h4>
        <form method="POST" action="../../TechJob/admin/handlers/add-new-category.php">
            <div class="mb-3">
                <label for="category" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="category" name="category" placeholder="Enter category name" required>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Add to Categories
            </button>
        </form>
    </div>

      <div class="card glassmorph-card shadow-sm rounded-4 p-3">
        <h4 class="mb-3">
            <i class="fa-solid fa-list"></i> Category List
        </h4>

        <?php if (!empty($categories)): ?>
            <div class="table-responsive">
                <table class="table glass-table table-bordered align-middle mb-0 rounded-3">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Title</th>
                            <th class="text-center">Number of Jobs</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $index => $category): ?>
                            <tr>
                                <td class="text-center"><?= $index + 1; ?></td>
                                <td>
                                    <i class="fa-solid fa-tags"></i>
                                    <?= htmlspecialchars($category['title']); ?>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-secondary rounded-pill">
                                        <?= htmlspecialchars($category['numberOfJobs']); ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <form method="POST" action="../../TechJob/admin/handlers/delete-categories.php" class="d-inline">
                                        <input type="hidden" name="categoryId" value="<?= htmlspecialchars($category['id']); ?>">
                                        <button type="submit" class="btn btn-danger btn-sm rounded-pill">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-muted">No categories found.</p>
        <?php endif; ?>
    </div>
</div>

<?php unset($_SESSION['success']); ?>
