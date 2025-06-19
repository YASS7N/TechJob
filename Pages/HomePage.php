<?php
session_start();
require_once '../includes/db-connection.php';
require_once '../includes/helper-functions.php';

$conn = connectDB();

$isLoggedIn = isset($_SESSION['userId']);
$categories = getCategories($conn);
$featuredJobs = getFeaturedJobs($conn);
$testimonials = getRandomTestimonials($conn, 3);

$conn->close();

if (isset($_SESSION['login_success'])) {
    $loginSuccess = $_SESSION['login_success'];
    unset($_SESSION['login_success']);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/generalStyles.css">
    <link rel="stylesheet" href="../styles/HomePage/header.css">
    <link rel="stylesheet" href="../styles/HomePage/hero-section.css">
    <link rel="stylesheet" href="../styles/HomePage/categories-section.css">
    <link rel="stylesheet" href="../styles/HomePage/popular-jobs-section.css">
    <link rel="stylesheet" href="../styles/HomePage/companies-section.css">
    <link rel="stylesheet" href="../styles/HomePage/stats-section.css">
    <link rel="stylesheet" href="../styles/HomePage/testimonials-section.css">
    <link rel="stylesheet" href="../styles/HomePage/contact-section.css">
    <link rel="stylesheet" href="../styles/HomePage/footer.css">
    <link rel="stylesheet" href="../styles/HomePage/common-styles.css">
    <title>Tech Job - Trouvez Votre Emploi IT de Rêve</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
    <?php include_once('../includes/homepage-header.php') ?>

    <section class="categories">
        <div class="container">
            <h2 class="section-title">Catégories d'Emplois Populaires</h2>
            <div class="categories-grid">
                <?php foreach ($categories as $category): ?>
                    <?php if($category['job_count'] != 0 ): ?>    
                        <a href="JobsListing.php?category=<?php echo $category['id']; ?>" class="category-card">
                            <div class="category-info">
                                <div>
                                    <div class="category-name"><?php echo htmlspecialchars($category['name']); ?></div>
                                    <div class="job-count"><?php echo htmlspecialchars($category['job_count']); ?> emplois</div>
                                </div>
                                <div>→</div>
                            </div>
                        </a>
                    <?php endif?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="featured-jobs" id="jobs-section">
        <div class="container">
            <h2 class="section-title">Emplois en Vedette</h2>
            <div class="jobs-grid">
                <?php foreach ($featuredJobs as $job): ?>
                <div class="job-card">
                    <div class="card-header">
                        <h3 class="job-title"><?php echo htmlspecialchars($job['title']); ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="job-details"><?php echo htmlspecialchars($job['companyName']); ?></div>
                        <div class="job-details"><?php echo htmlspecialchars($job['location']); ?></div>
                        <div class="job-details"><?php echo htmlspecialchars($job['salaryRange']); ?> • <?php echo htmlspecialchars($job['duration']); ?></div>
                        <a href="#" class="view-job" data-job-id="<?php echo $job['id']; ?>">Voir les détails →</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <div id="jobModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modal-job-details"></div>
        </div>
    </div>
    <script src="../js/featuredJobsModal.js"></script>

    <?php include_once('../includes/homepage-stats.php') ?>

    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">Ce Que Nos Utilisateurs Disent</h2>
            <div class="testimonials-grid">
                <?php 
                foreach ($testimonials as $index => $testimonial): 
                    $cardClass = ($index === 1) ? 'testimonial-card accent' : 'testimonial-card';
                ?>
                    <div class="<?php echo $cardClass; ?>">
                        <div class="quote-icon">"</div>
                        <p class="testimonial-text">
                            <?php echo htmlspecialchars($testimonial['review']); ?>
                        </p>
                        <div class="testimonial-author">
                            <div class="author-img">
                                <img src="../assets/images/<?php echo htmlspecialchars($testimonial['image']); ?>" 
                                    alt="<?php echo htmlspecialchars($testimonial['name']); ?>">
                            </div>
                            <div class="author-info">
                                <h4 class="author-name"><?php echo htmlspecialchars($testimonial['name']); ?></h4>
                                <p class="author-role"><?php echo htmlspecialchars($testimonial['occupation']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php if (empty($testimonials)): ?>
                    <div class="no-testimonials">
                        <p>Aucun témoignage disponible pour le moment.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php include_once('../includes/homepage-companies.php') ?>
    <?php include_once('../includes/footer.php') ?>

    <?php if (isset($loginSuccess)) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Bienvenue !',
                text: '<?php echo $loginSuccess; ?>',
                showConfirmButton: false,
                timer: 2000
            });

            
        </script>
    <?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const menuLink = document.querySelector('.ham-burger');
  const navLinks = document.querySelector('.nav-links');

  menuLink.addEventListener('click', () => {
    navLinks.classList.toggle('active');
  });
});

</script>

</body>
</html>
