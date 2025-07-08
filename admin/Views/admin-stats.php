<?php
require_once __DIR__ . '/../../includes/db-connection.php';
$conn = connectDB();

$totalJobs = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM jobs"))[0];
$activeUsers = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM users WHERE role='applicant' OR role='employer'"))[0];
$companies = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(DISTINCT companyName) FROM jobs"))[0];
$applications = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM applicants"))[0];
?>

<div class="row mb-4">
    <!-- Total Jobs -->
    <div class="col-md-3">
        <div class="card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5>Total Jobs</h5>
                    <div class="value text-warning"><?= $totalJobs; ?></div>
                    <div class="change text-success">+12% from last month</div>
                </div>
                <i class="fa-solid fa-briefcase fa-2x text-primary"></i>
            </div>
        </div>
    </div>
    <!-- Active Users -->
    <div class="col-md-3">
        <div class="card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5>Active Users</h5>
                    <div class="value text-warning"><?= $activeUsers; ?></div>
                    <div class="change text-success">+8% from last month</div>
                </div>
                <i class="fa-solid fa-users fa-2x text-success"></i>
            </div>
        </div>
    </div>
    <!-- Companies -->
    <div class="col-md-3">
        <div class="card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5>Companies</h5>
                    <div class="value text-warning"><?= $companies; ?></div>
                    <div class="change text-success">+5% from last month</div>
                </div>
                <i class="fa-solid fa-building fa-2x text-warning"></i>
            </div>
        </div>
    </div>
    <!-- Applications -->
    <div class="col-md-3">
        <div class="card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5>Applications</h5>
                    <div class="value text-warning"><?= $applications; ?></div>
                    <div class="change text-success">+15% from last month</div>
                </div>
                <i class="fa-solid fa-chart-line fa-2x text-danger"></i>
            </div>
        </div>
    </div>
</div>

<h2 class="text-white">Welcome to Admin Dashboard</h2>
<p class="text-light">Select an option from the sidebar to manage the portal.</p>
