<?php
session_start();
require_once '../includes/helper-functions.php';
$userId = $_SESSION['user']['userId'];

$allJobs = fetchJobsByEmployer($userId);
$activeJobs = fetchActiveJobsByEmployer($userId);
$applicants = fetchApplicantsByUser($userId);

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

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
<title>Tableau de bord employeur - TechJob</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../styles/EmployerPage/employerStyles.css">
<link rel="stylesheet" href="../styles/HomePage/footer.css">
  <link rel="stylesheet" href="../css/employerStyles.css">
  <link rel="stylesheet" href="../css/candidats.css">
  <link rel="stylesheet" href="../css/offres.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  

<?php include_once '../includes/employer-header.php'; ?>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
        <ul>
        <?php foreach ($errors as $error): ?>
        <li><?php echo htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
        </ul>
        </div>
    <?php endif; ?>
    <div class="job-post-banner">
  <h1>Créez Votre Offre d'Emploi</h1>
  <p>Trouvez les meilleurs talents avec notre plateforme moderne</p>
</div>


<main class="container py-4">
<div class="row">

<?php include_once '../includes/employer-sidebar.php'; ?>
<section class="col-lg-9">
<div class="tab-content">
<div class="tab-pane fade show active" id="post-job">
<div class="card">
<div class="card-body">

    <?php include_once '../includes/post-job-form.php'; ?>  

</div>
</div>
</div>

<section class="tab-pane fade show active" id="applicants">
  <div class="applicants-container">
    <div class="header">
      <h4>Candidats récents</h4>
      <div class="search-bar">
        <input type="text" id="search-applicant" placeholder="Rechercher des candidats...">
        <button id="btn-search-applicant"><i class="fas fa-search"></i></button>
      </div>
    </div>

    <div class="applicant-list" id="applicant-list">
      <?php if (!empty($applicants)): ?>
        <?php foreach ($applicants as $applicant): ?>
          <div class="applicant-card">
            <div class="card-header">
              <div class="avatar">
                <?= strtoupper(substr($applicant['fullName'], 0, 1)) ?><?= strtoupper(substr(strstr($applicant['fullName'], ' '), 1, 1)) ?>
              </div>
              <div class="header-text">
                <h5><?= htmlspecialchars($applicant['fullName']); ?></h5>
              </div>
            </div>

            <div class="card-body">
            <div class="edu">
              <i class="fa-solid fa-user-graduate me-2 text-primary"></i>
              <?= htmlspecialchars($applicant['diplome']); ?> • <?= htmlspecialchars($applicant['etablissement']); ?> • <?= htmlspecialchars($applicant['annee']); ?>
            </div>
              <div class="info">
                <p><i class="fas fa-envelope"></i> <?= htmlspecialchars($applicant['email']); ?></p>
                <p><i class="fas fa-phone"></i> <?= htmlspecialchars($applicant['telephone']); ?></p>
                <p><i class="fas fa-location-dot"></i> <?= htmlspecialchars($applicant['adresse']); ?></p>
              </div>

              <div class="section">
                <h6>Compétences</h6>
                <?php foreach (explode(',', $applicant['competences']) as $index => $skill): ?>
                  <?php if ($index < 3): ?><span class="tag"><?= htmlspecialchars(trim($skill)) ?></span><?php endif; ?>
                <?php endforeach; ?>
                <?php if (count(explode(',', $applicant['competences'])) > 3): ?><span class="tag">+<?= count(explode(',', $applicant['competences'])) - 3 ?></span><?php endif; ?>
              </div>

              <div class="section">
                <h6>Langues</h6>
                <?php foreach (explode(',', $applicant['langues']) as $index => $lang): ?>
                  <?php if ($index < 2): ?><span class="tag gray"><?= htmlspecialchars(trim($lang)) ?></span><?php endif; ?>
                <?php endforeach; ?>
                <?php if (count(explode(',', $applicant['langues'])) > 2): ?><span class="tag gray">+<?= count(explode(',', $applicant['langues'])) - 2 ?></span><?php endif; ?>
              </div>

              <div class="meta">
                <p><i class="fas fa-briefcase"></i> Expérience : <?= htmlspecialchars($applicant['experience']); ?> ans</p>
                <p><i class="fas fa-calendar"></i> Entrée : <?= htmlspecialchars($applicant['date_entree']); ?></p>
              </div>

              <div class="btns">
                <a class="btn-gradient" href="/TechJob/uploaded-files/<?= rawurlencode($applicant['cv_filename']) ?>" target="_blank">
                  <i class="fas fa-file-pdf"></i> Voir le CV
                </a>
                <a class="btn-icon" href="<?= htmlspecialchars($applicant['github']); ?>" target="_blank">
                  <i class="fab fa-github"></i>
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="no-data">Aucun candidat trouvé pour cette offre.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<script>
  document.getElementById('btn-search-applicant').addEventListener('click', function() {
    const query = document.getElementById('search-applicant').value.toLowerCase();
    const applicants = document.querySelectorAll('.applicant-item');
    applicants.forEach(function(applicant) {
      const text = applicant.textContent.toLowerCase();
      applicant.style.display = text.includes(query) ? '' : 'none';
    });
  });
function toggleExtra(btn) {
  const extras = btn.nextElementSibling;
  if (extras.classList.contains('d-none')) {
    extras.classList.remove('d-none');
    btn.style.display = 'none';
  }
}
</script>

<section class="tab-pane fade" id="active-jobs">
<div class="card border-0 shadow-sm rounded-3">
<div class="card-header bg-white d-flex justify-content-between align-items-center">
<h4 class="mb-0 text-custom-dark fw-bold">Offres d'emploi actives</h4>
<div class="search-bar">
      <input type="text" placeholder="Rechercher des offres...">
        <button id="btn-search-applicant"><i class="fas fa-search"></i></button>
    </div>
</div>
<div class="card-body">
<div class="row">
      <?php foreach ($activeJobs as $job): ?>
        <div class="col-md-6 mb-4">
            <div class="card applicant-card p-3 h-100">
                <div class="card-body">
                    <h5 class="fw-semibold mb-2 text-dark"><?php echo htmlspecialchars($job['title']); ?></h5>
                    <span class="badge-type <?php echo strtolower($job['type']) === 'remote' ? 'badge-remote' : 'badge-onsite'; ?>">
                        <?php echo htmlspecialchars($job['type']); ?>
                    </span>
                    <p class="mt-2 text-muted mb-1">
                        <i class="fas fa-map-marker-alt me-1 text-info"></i>
                        <?php echo htmlspecialchars($job['location']); ?>
                    </p>
                    <p class="text-muted mb-3">
                        <i class="fas fa-dollar-sign me-1 text-primary"></i>
                        Salaire : <?php echo htmlspecialchars($job['salaryRange']); ?>
                    </p>
                    <hr class="my-2">
                    <div class="job-actions d-flex gap-2">
                        <button class="btn btn-gradient text-white" data-bs-toggle="modal" data-bs-target="#jobDetailsModal" onclick='showJobDetails(<?php echo json_encode($job); ?>)'>Voir les détails</button>
                        <form action="../controllers/delete-job.php" method="POST" style="display: contents;">
                            <input type="hidden" name="jobId" value="<?php echo htmlspecialchars($job['id']); ?>">
                            <button type="submit" class="btn btn-outline-danger">Supprimer</button>
                        </form>
                        <form action="../controllers/change-job-status.php" method="POST" style="display: contents;">
                            <input type="hidden" name="jobId" value="<?php echo htmlspecialchars($job['id']); ?>">
                            <button type="submit" class="btn btn-outline-success">Clôturer l'offre</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</div>
</div>
</section>


<section class="tab-pane fade" id="all-jobs">
<div class="card">
<div class="card-header bg-white d-flex justify-content-between align-items-center">
    <h4 class="mb-0 text-custom-dark">Toutes les offres d'emploi</h4>
    <div class="search-bar">
      <input type="text" placeholder="Rechercher des offres...">
        <button id="btn-search-applicant"><i class="fas fa-search"></i></button>
    </div>
</div>                          
<div class="card-body">
    <div class="row">
      <?php
function timeAgo($datetime) {
    $time = strtotime($datetime);
    $diff = time() - $time;

    if ($diff < 60) return 'Publié à l\'instant';
    if ($diff < 3600) return 'Publié il y a ' . floor($diff / 60) . ' minutes';
    if ($diff < 86400) return 'Publié il y a ' . floor($diff / 3600) . ' heures';
    return 'Publié il y a ' . floor($diff / 86400) . ' jours';
}

foreach ($allJobs as $job): 
    $skills = explode(',', $job['skills']);
?>
<div class="col-md-6 mb-4">
    <div class="card job-card shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <h5 class="fw-bold"><?php echo htmlspecialchars($job['title']); ?></h5>
                <span class="badge status-badge <?php echo $job['status'] === 'active' ? 'bg-success' : 'bg-secondary'; ?>">
                    <?php echo strtoupper($job['status']); ?>
                </span>
            </div>

            <div class="icon-text icon-type">
                <i class="fa-solid fa-building"></i> <?php echo htmlspecialchars($job['type']); ?>
            </div>

            <div class="icon-text icon-location">
                <i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($job['location']); ?>
            </div>

            <div class="icon-text icon-salary fw-semibold text-success">
                <i class="fa-solid fa-dollar-sign"></i> <?php echo htmlspecialchars($job['salaryRange']); ?>
            </div>

            <div class="icon-text icon-date text-muted small">
                <i class="fa-regular fa-calendar"></i> <?php echo timeAgo($job['datePosted']); ?>
            </div>

            <p class="description-preview mb-2">
                <?php echo htmlspecialchars($job['description']); ?>
            </p>

            <div class="mb-3">
                <?php foreach (explode(',', $job['skills']) as $skill): ?>
                    <span class="badge skill-badge"><?php echo htmlspecialchars(trim($skill)); ?></span>
                <?php endforeach; ?>
            </div>

            <button class="btn btn-gradient w-100"
                data-bs-toggle="modal"
                data-bs-target="#jobDetailsModal"
                onclick='showJobDetails(<?php echo json_encode($job, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>)'>Voir les détails</button>
        </div>
    </div>
</div>

<?php endforeach; ?>
</div>
</div>
</div>
</section>
</div>
</section>
</div>
</main>

<div class="modal fade" id="jobDetailsModal" tabindex="-1" aria-labelledby="jobDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
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

        <!-- Spécialisation -->
        <div class="detail-card pink">
          <i class="fa-solid fa-star"></i>
          <span><strong>Spécialisation:</strong> <span id="modalSpecializations"></span></span>
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

<?php include_once('../includes/footer.php') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
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
function showJobDetails(job) {
    document.getElementById('modalJobTitle').innerText = job.title;
    document.getElementById('modalCompany').innerText = job.companyName;
    document.getElementById('modalLocation').innerText = job.location;
    document.getElementById('modalType').innerText = job.type;
    document.getElementById('modalDuration').innerText = job.duration;
    document.getElementById('modalSalary').innerText = job.salaryRange ?? 'Non spécifié';
    document.getElementById('modalExperience').innerText = job.experience;
    document.getElementById('modalSpecializations').innerText = job.specializations;
    document.getElementById('modalSkills').innerText = job.skills ?? '—';
    document.getElementById('modalDescription').innerText = job.description;
    document.getElementById('modalRequirements').innerText = job.requirements;
}
</script>

</body>
</html>
