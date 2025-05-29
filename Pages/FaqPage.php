<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-Nous - Tech Job</title>
    <link rel="stylesheet" href="../styles/AboutUsPage/styles.css">
    <link rel="stylesheet" href="../styles/generalStyles.css">
    <link rel="stylesheet" href="../styles/HomePage/header.css">
    <link rel="stylesheet" href="../styles/HomePage/contact-section.css">
    <link rel="stylesheet" href="../styles/HomePage/footer.css">
    <link rel="stylesheet" href="../styles/HomePage/common-styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://unpkg.com/phosphor-icons@1.4.2/src/css/phosphor.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/faq.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="bg-light">
    <?php 
        $currentPage = 'Contact';
        include_once '../includes/applicant-header.php'
    ?>
    <script>
        const hamBurger = document.querySelector('.ham-burger');
        const navLinks = document.querySelector('.nav-links');
        const toggleClasses = () => navLinks.classList.toggle('active')
        hamBurger.addEventListener('click', toggleClasses);
    </script>
<div class="container main-title text-center">
  <h2 class="fw-bold text-primary">Questions Fréquemment Posées</h2>
  <p class="text-muted">Trouvez rapidement les réponses à vos questions sur notre portail d'emploi IT marocain. Que vous soyez candidat ou employeur, nous sommes là pour vous accompagner.</p>
</div>

  <div class="container mb-5">
  <h5 class="text-center section-title">Domaines d'expertise</h5>
  <div class="row text-center g-4">
    <div class="col-md-3">
      <div class="domain-card">
        <i class="bi bi-code-slash fs-2 text-primary"></i>
        <div class="mt-2">Développement</div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="domain-card">
        <i class="bi bi-palette fs-2 text-purple"></i>
        <div class="mt-2">Design</div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="domain-card">
        <i class="bi bi-shield-lock fs-2 text-danger"></i>
        <div class="mt-2">Cybersécurité</div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="domain-card">
        <i class="bi bi-kanban fs-2 text-success"></i>
        <div class="mt-2">Gestion de Projet</div>
      </div>
    </div>
  </div>
</div>

<div class="container faq-section">
  <div class="row g-4">
      <div class="col-md-6">
        <div class="p-4 bg-white rounded-4 shadow-sm">
        <h5 class="mb-3"><i class="bi bi-person-lines-fill me-2 text-primary"></i>Pour les Candidats</h5>
          <div class="accordion" id="accordionCandidats">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q1">
                  Comment créer un profil attractif sur la plateforme ?
                </button>
              </h2>
              <div id="q1" class="accordion-collapse collapse" data-bs-parent="#accordionCandidats">
                <div class="accordion-body text-success">
                  Remplissez toutes les sections, ajoutez une photo professionnelle, détaillez vos compétences, projets, tenez votre CV à jour, etc.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q2">
                  Quels types d'emplois IT puis-je trouver au Maroc ?
                </button>
              </h2>
              <div id="q2" class="accordion-collapse collapse" data-bs-parent="#accordionCandidats">
                <div class="accordion-body text-success">
                  Développement, design, cybersécurité, gestion de projet, DevOps, etc.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q3">
                  Comment postuler à une offre d'emploi ?
                </button>
              </h2>
              <div id="q3" class="accordion-collapse collapse" data-bs-parent="#accordionCandidats">
                <div class="accordion-body text-success">
                  Cliquez sur l'offre, puis sur “Postuler”, suivez les étapes pour soumettre votre candidature.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q4">
                  Puis-je modifier ma candidature après l'avoir envoyée ?
                </button>
              </h2>
              <div id="q4" class="accordion-collapse collapse" data-bs-parent="#accordionCandidats">
                <div class="accordion-body text-success">
                  Oui, allez dans votre espace candidat, section "Mes candidatures", pour éditer ou retirer.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q5">
                  Comment puis-je suivre l'état de mes candidatures ?
                </button>
              </h2>
              <div id="q5" class="accordion-collapse collapse" data-bs-parent="#accordionCandidats">
                <div class="accordion-body text-success">
                  Depuis votre tableau de bord, accédez à “Suivi des candidatures”.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="p-4 bg-white rounded-4 shadow-sm">
        <h5 class="mb-3"><i class="bi bi-building me-2 text-success"></i>Pour les Employeurs</h5>
          <div class="accordion" id="accordionEmployeurs">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#e1">
                  Comment publier une offre d'emploi ?
                </button>
              </h2>
              <div id="e1" class="accordion-collapse collapse" data-bs-parent="#accordionEmployeurs">
                <div class="accordion-body text-success">
                  Depuis votre tableau de bord, cliquez sur “Publier une offre” et complétez les informations nécessaires.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#e2">
                  Comment rechercher et filtrer les candidats ?
                </button>
              </h2>
              <div id="e2" class="accordion-collapse collapse" data-bs-parent="#accordionEmployeurs">
                <div class="accordion-body text-success">
                  Utilisez notre moteur de recherche par compétence, localisation, expérience, etc.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#e3">
                  Quels sont les tarifs pour les employeurs ?
                </button>
              </h2>
              <div id="e3" class="accordion-collapse collapse" data-bs-parent="#accordionEmployeurs">
                <div class="accordion-body text-success">
                  Nous proposons des plans adaptés à toutes tailles d'entreprise. Consultez notre page Tarifs.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#e4">
                  Comment contacter un candidat ?
                </button>
              </h2>
              <div id="e4" class="accordion-collapse collapse" data-bs-parent="#accordionEmployeurs">
                <div class="accordion-body text-success">
                  Depuis une candidature reçue, cliquez sur “Contacter” pour envoyer un message.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#e5">
                  Comment vérifier les compétences d'un candidat ?
                </button>
              </h2>
              <div id="e5" class="accordion-collapse collapse" data-bs-parent="#accordionEmployeurs">
                <div class="accordion-body text-success">
                  Consultez les tests techniques, certifications, et projets listés sur son profil.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="container my-5">
  <div class="custom-contact-box text-center">
    <i class="bi bi-question-circle fs-1 text-primary"></i>
    <h5 class="fw-bold mt-3">Vous ne trouvez pas votre réponse ?</h5>
    <p class="text-muted">Notre équipe est disponible pour répondre à toutes vos questions spécifiques.</p>
    <a href="ContactPage.php" class="btn btn-primary">Nous Contacter</a>
  </div>
</div>

    <?php include_once('../includes/footer.php') ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
