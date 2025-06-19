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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

<section class="tab-pane fade" id="applicants">
  <div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0 text-custom-dark">Candidats récents</h4>
      <div class="input-group w-auto">
        <input type="text" id="search-applicant" class="form-control" placeholder="Rechercher des candidats...">
        <button id="btn-search-applicant" class="btn btn-primary">Rechercher</button>
      </div>
    </div>
    <div class="card-body">
      <div class="row" id="applicant-list">
        <?php if (!empty($applicants)): ?>
          <?php foreach ($applicants as $applicant): ?>
            <div class="col-md-6 mb-3 applicant-item">
              <div class="card applicant-card">
                <div class="card-body">
                  <h5 class="card-title"><?= htmlspecialchars($applicant['fullName']); ?></h5>
                  <p class="mb-1"><strong>Email :</strong> <?= htmlspecialchars($applicant['email']); ?></p>
                  <p class="mb-1"><strong>Téléphone :</strong> <?= htmlspecialchars($applicant['telephone']); ?></p>
                  <p class="mb-1"><strong>Adresse :</strong> <?= htmlspecialchars($applicant['adresse']); ?></p>
                  <p class="mb-1"><strong>GitHub :</strong> 
                    <a href="<?= htmlspecialchars($applicant['github']); ?>" target="_blank" rel="noopener noreferrer">
                      <?= htmlspecialchars($applicant['github']); ?>
                    </a>
                  </p>
                  
                  <hr class="my-2">

                  <p class="mb-1"><strong>Diplôme :</strong> <?= htmlspecialchars($applicant['diplome']); ?></p>
                  <p class="mb-1"><strong>Établissement :</strong> <?= htmlspecialchars($applicant['etablissement']); ?></p>
                  <p class="mb-1"><strong>Année :</strong> <?= htmlspecialchars($applicant['annee']); ?></p>

                  <p class="mb-1"><strong>Compétences :</strong> <?= htmlspecialchars($applicant['competences']); ?></p>
                  <p class="mb-1"><strong>Langues :</strong> <?= htmlspecialchars($applicant['langues']); ?></p>

                  <hr class="my-2">

                  <p class="mb-1"><strong>Expérience :</strong> <?= htmlspecialchars($applicant['experience']); ?> ans</p>
                  <p class="mb-1"><strong>Date d'entrée :</strong> <?= htmlspecialchars($applicant['date_entree']); ?></p>

                  <div class="mt-3">
                    <?php if (!empty($applicant['cv_filename'])): ?>
                      <a href="/TechJob/uploaded-files/<?= rawurlencode($applicant['cv_filename']) ?>"
                         target="_blank" rel="noopener noreferrer"
                         class="btn btn-sm btn-primary">
                        Voir le CV
                      </a>
                    <?php else: ?>
                      <span class="text-muted">Aucun CV fourni</span>
                    <?php endif; ?>
                  </div>

                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p class="text-muted">Aucun candidat trouvé pour cette offre.</p>
        <?php endif; ?>
      </div>
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
</script>


<section class="tab-pane fade" id="active-jobs">
<div class="card">
<div class="card-header bg-white d-flex justify-content-between align-items-center">
    <h4 class="mb-0 text-custom-dark">Offres d'emploi actives</h4>
    <div class="input-group w-auto">
        <input type="text" class="form-control" placeholder="Rechercher des offres...">
        <button class="btn btn-primary">Rechercher</button>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <?php foreach ($activeJobs as $job): ?>
            <div class="col-md-6 mb-3">
                <div class="card applicant-card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($job['title']); ?></h5>
                        <p class="card-text text-muted mb-2"><?php echo htmlspecialchars($job['type']); ?> • <?php echo htmlspecialchars($job['location']); ?></p>
                        <p class="small mb-2">Salaire : <?php echo htmlspecialchars($job['salaryRange']); ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <button class="btn btn-sm btn-primary">Voir les détails</button>
                            <form action="../controllers/delete-job.php" method="POST" class="d-inline">
                                <input type="hidden" name="jobId" value="<?php echo htmlspecialchars($job['id']); ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                            </form>
                            <form action="../controllers/change-job-status.php" method="POST" class="d-inline">
                                <input type="hidden" name="jobId" value="<?php echo htmlspecialchars($job['id']); ?>">
                                <button type="submit" class="btn btn-sm btn-outline-success">Clôturer l'offre</button>
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
    <div class="input-group w-auto">
        <input type="text" class="form-control" placeholder="Rechercher des offres...">
        <button class="btn btn-primary">Rechercher</button>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <?php foreach ($allJobs as $job): ?>
            <div class="col-md-6 mb-3">
                <div class="card applicant-card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($job['title']); ?></h5>
                        <p class="card-text text-muted mb-2"><?php echo htmlspecialchars($job['type']); ?> • <?php echo htmlspecialchars($job['location']); ?></p>
                        <p class="small mb-2">Salaire : <?php echo htmlspecialchars($job['salaryRange']); ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <button class="btn btn-sm btn-primary">Voir les détails</button>
                            <button class="btn btn-sm btn-outline-primary skill-badge"><?php echo strtoupper(htmlspecialchars($job['status'])); ?></button>
                        </div>
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
</body>
</html>
