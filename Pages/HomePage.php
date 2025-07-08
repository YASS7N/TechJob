<?php
session_start();
require_once '../includes/db-connection.php';
require_once '../includes/helper-functions.php';

$conn = connectDB();

$isLoggedIn = isset($_SESSION['userId']);
$categories = getCategories($conn);
$featuredJobs = getFeaturedJobs($conn);
$testimonials = [
    [
        'name' => 'Fatima Zahra Bennani',
        'occupation' => 'Responsable RH',
        'company' => 'TechInnovate Maroc',
        'review' => "Grâce à cette plateforme, nous avons pu recruter 3 développeurs en à peine deux semaines. Les profils étaient pertinents et la gestion des candidatures très fluide. Un outil indispensable pour nos besoins en IT.",
        'photoId' => '1573496359142-b8d87734a5a2',
    ],
    [
        'name' => 'Youssef El Alami',
        'occupation' => 'Développeur Full-Stack',
        'company' => 'Freelancer basé à Casablanca',
        'review' => "J'ai trouvé un emploi à distance chez une startup grâce à ce site. L'interface est intuitive et les annonces sont sérieuses. Une excellente plateforme pour les professionnels IT au Maroc.",
        'photoId' => '1507003211169-0a1dd7228f2d',
    ],
    [
        'name' => 'Aicha Benali',
        'occupation' => 'CEO',
        'company' => 'ModeTech Solutions Rabat',
        'review' => "Recruter via ce portail a été un vrai gain de temps. Nous avons reçu des candidatures ciblées en quelques heures seulement. Mention spéciale au service client très réactif.",
        'photoId' => '1544005313-94ddf0286df2',
    ],
    [
        'name' => 'Omar Tazi',
        'occupation' => 'Data Analyst Junior',
        'company' => 'Casablanca',
        'review' => "Je venais de terminer ma formation en Data Science et j’ai décroché mon premier poste via ce site. Merci pour cette opportunité, je recommande à tous les jeunes diplômés IT.",
        'photoId' => '1546456073-6712f79251bb',
    ],
    [
        'name' => 'Khadija Amrani',
        'occupation' => 'Recruteuse Tech',
        'company' => 'InnovateCorp Fès',
        'review' => "En tant que recruteuse, j’apprécie les outils de filtrage et la visibilité des profils. C’est clairement la meilleure plateforme marocaine pour trouver des talents IT qualifiés.",
        'photoId' => '1520813792240-56fc4a3765a7',
    ],
    [
        'name' => 'Mehdi Bouazza',
        'occupation' => 'Développeur Mobile',
        'company' => 'Tanger',
        'review' => "J'ai reçu plusieurs entretiens grâce à ce site. Les offres sont bien détaillées et j'ai pu postuler facilement depuis mon mobile. J'ai fini par signer un CDI dans une entreprise tech locale.",
        'photoId' => '1544723795-3fb6469f5b39',
    ],
];


$conn->close();

if (isset($_SESSION['login_success'])) {
    $loginSuccess = $_SESSION['login_success'];
    unset($_SESSION['login_success']);
}

if (isset($_SESSION['application_success'])) {
    $applicationSuccess = true;
    unset($_SESSION['application_success']);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/details.css">
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
                                <div class="text-dark">→</div>
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
        <h3 class="job-title"><?= htmlspecialchars($job['title']) ?></h3>

        <div class="job-meta">
            <p><i class="fa-solid fa-building"></i> <strong>Entreprise :</strong> <?= htmlspecialchars($job['companyName']) ?></p>
            <p><i class="fa-solid fa-location-dot"></i> <strong>Lieu :</strong> <?= htmlspecialchars($job['location']) ?></p>
            <p><i class="fa-solid fa-dollar-sign"></i> <strong>Salaire :</strong> <?= htmlspecialchars($job['salaryRange']) ?></p>
        </div>

        <div class="job-tags">
            <span class="tag <?= strtolower($job['duration']) === 'remote' ? 'remote' : 'onsite' ?>">
                <i class="fa-solid fa-globe"></i> <?= htmlspecialchars($job['duration']) ?>
            </span>
            <span class="tag full-time">
                <i class="fa-solid fa-calendar-check"></i> <?= htmlspecialchars($job['type']) ?>
            </span>
        </div>

        <div class="job-actions">
            <button 
                class="btn btn-view" 
                data-bs-toggle="modal" 
                data-bs-target="#jobDetailsModal"
                onclick='showJobDetails(<?= json_encode($job, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'>Voir les détails</button>
            <a href="../Pages/JobApplication.php?id=<?= $job['id'] ?>" class="btn btn-apply">Postuler maintenant</a>
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

 <section class="testimonials py-5" style="background: #f8fbff;">
    <div class="container">
        <div class="text-center mb-4">
            <div style="font-size: 2rem; color: #007bff;">
                <i class="fas fa-quote-left"></i>
            </div>
            <h2 class="fw-bold mb-2" style="color: #007bff;">Ce Que Nos Utilisateurs Disent</h2>
            <p class="text-muted">Découvrez les témoignages authentiques de nos clients qui ont transformé leur business grâce à nos solutions innovantes</p>
            <div class="mt-2 mb-5" style="color: #fbc531; font-size: 1.2rem;">
                ★★★★★ <span class="text-dark fw-bold">4.9/5</span> basé sur <strong>1,247 avis</strong>
            </div>
        </div>

        <div class="row g-4">
            <?php 
            foreach ($testimonials as $index => $testimonial): 
                $cardClass = ($index === 1) ? 'testimonial-card accent' : 'testimonial-card';
                $photoId = htmlspecialchars($testimonial['photoId']); // e.g., '1573496359142-b8d87734a5a2'
                $imageUrl = "https://images.unsplash.com/photo-$photoId?w=150&h=150&fit=crop&crop=face";
            ?>
                <div class="col-md-6 col-lg-4">
                    <div class="bg-white rounded-4 shadow-sm p-4 h-100">
                        <div class="mb-3 text-warning" style="font-size: 1rem;">
                            ★★★★★
                        </div>
                        <p class="text-muted fst-italic">"<?php echo htmlspecialchars($testimonial['review']); ?>"</p>
                        <div class="d-flex align-items-center mt-4">
                            <img src="<?php echo $imageUrl; ?>" class="rounded-circle me-3" alt="<?php echo htmlspecialchars($testimonial['name']); ?>" width="50" height="50">
                            <div>
                                <div class="fw-bold"><?php echo htmlspecialchars($testimonial['name']); ?></div>
                                <div class="text-primary small">
                                    <i class="fas fa-briefcase me-1"></i><?php echo htmlspecialchars($testimonial['occupation']); ?>
                                </div>
                                <div class="text-muted small">
                                    <i class="fas fa-map-marker-alt me-1"></i><?php echo htmlspecialchars($testimonial['company']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php if (empty($testimonials)): ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">Aucun témoignage disponible pour le moment.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>


<div class="modal fade" id="jobDetailsModal" tabindex="-1" aria-labelledby="jobDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content rounded-4 shadow">
      <!-- Modal Header -->
      <div class="modal-header text-white" style="background: linear-gradient(90deg, #00e0ff, #2f80ed);">
        <h5 class="modal-title" id="jobDetailsModalLabel">Détails de l'offre</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body p-4">
        <h4 id="modalJobTitle" class="fw-bold text-dark text-center"></h4>
        <p class="text-primary text-center mb-4" id="modalCompany"></p>

        <!-- Row 1: Location + Type -->
        <div class="row g-3">
          <div class="col-md-6">
            <div class="info-card blue">
              <i class="fa-solid fa-location-dot"></i>
              <div class="info-text">
                <p class="label">Localisation</p>
                <p class="value" id="modalLocation"></p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="info-card orange">
              <i class="fa-solid fa-briefcase"></i>
              <div class="info-text">
                <p class="label">Type</p>
                <p class="value" id="modalType"></p>
              </div>
            </div>
          </div>

          <!-- Row 2: Duration + Salary -->
          <div class="col-md-6">
            <div class="info-card green">
              <i class="fa-solid fa-clock"></i>
              <div class="info-text">
                <p class="label">Durée</p>
                <p class="value" id="modalDuration"></p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="info-card yellow">
              <i class="fa-solid fa-sack-dollar"></i>
              <div class="info-text">
                <p class="label">Salaire</p>
                <p class="value" id="modalSalary"></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Expérience -->
        <div class="detail-card purple mt-4">
          <i class="fa-solid fa-user-tie"></i>
          <span><strong>Expérience:</strong> <span id="modalExperience"></span></span>
        </div>
        <!-- Compétences -->
        <div class="detail-card teal">
          <i class="fa-solid fa-screwdriver-wrench"></i>
          <span><strong>Compétences:</strong> <span id="modalSkills"></span></span>
        </div>

        <!-- Description -->
        <h5 class="text-dark mt-4">Description du poste</h5>
        <div class="detail-card gray">
          <span id="modalDescription"></span>
        </div>

        <!-- Exigences -->
        <h5 class="text-dark">Exigences</h5>
        <div class="detail-card blue-soft">
          <span id="modalRequirements"></span>
        </div>  
      </div>
    </div>
  </div>
</div>

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

    <?php if (isset($applicationSuccess)) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Candidature envoyée !',
            text: 'Votre CV a été soumis avec succès.',
            confirmButtonText: 'OK'
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

function showJobDetails(job) {
    document.getElementById('modalJobTitle').innerText = job.title;
    document.getElementById('modalCompany').innerText = job.companyName;
    document.getElementById('modalLocation').innerText = job.location;
    document.getElementById('modalType').innerText = job.type;
    document.getElementById('modalDuration').innerText = job.duration;
    document.getElementById('modalSalary').innerText = job.salaryRange || 'Non spécifié';
    document.getElementById('modalExperience').innerText = job.experience || '—';
    document.getElementById('modalSkills').innerText = job.skills || '—';
    document.getElementById('modalDescription').innerText = job.description || '—';
    document.getElementById('modalRequirements').innerText = job.requirements || '—';
}

</script>

</body>
</html>
