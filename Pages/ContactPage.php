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
    <link href="https://unpkg.com/phosphor-icons@1.4.2/src/css/phosphor.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/contact.css">
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
    <div class="container py-5 mt-5">
    <div class="text-center mb-5">
      <h1 class="fw-bold display-5 text-primary">Contactez-Nous</h1>
      <p class="lead text-muted">Nous sommes là pour vous aider. Posez-nous vos questions ou demandes, on est à l'écoute.</p>
    </div>

    <div class="row g-4 align-items-stretch">
      <div class="col-lg-6">
        <div class="glass-card p-5 W h-80">
          <h5 class="mb-4 fw-semibold">Envoyez-nous un message</h5>
          <form>
            <div class="mb-3">
              <label class="form-label">Nom complet *</label>
              <input type="text" class="form-control form-control-lg" placeholder="Votre nom complet" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email *</label>
              <input type="email" class="form-control form-control-lg" placeholder="votre@email.com" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Sujet *</label>
              <input type="text" class="form-control form-control-lg" placeholder="Objet de votre message" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Message *</label>
              <textarea class="form-control form-control-lg" rows="5" placeholder="Votre message détaillé..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100 btn-lg shadow-sm">
              <i class="ph ph-paper-plane-tilt me-2"></i>Envoyer le message
            </button>
          </form>
        </div>
      </div>

        <div class="col-lg-6 info-section">
          <h4 class="fw-semibold fs-5 mb-2">Informations de Contact</h4>
      <p class="text-muted mb-4">Plusieurs moyens de nous joindre pour répondre à vos besoins.</p>

        <div class="info-box d-flex align-items-start p-3">
          <div class="icon-wrapper me-3"><i class="ph ph-phone icon"></i></div>
          <div>
            <h6 class="mb-1 fw-semibold">Téléphone</h6>
            <p class="mb-0">+212 600 000 000</p>
          </div>
        </div>

        <div class="info-box d-flex align-items-start p-3">
          <div class="icon-wrapper me-3"><i class="ph ph-envelope icon"></i></div>
          <div>
            <h6 class="mb-1 fw-semibold">Email</h6>
            <p class="mb-0">Techjob.maroc@gmail.com</p>
          </div>
        </div>
        <div class="info-box faq-box d-flex align-items-start p-3">
          <div class="icon-wrapper me-3"><i class="ph ph-question icon"></i></div>
          <div>
            <h6 class="mb-1 fw-semibold">Questions Fréquentes</h6>
            <p class="mb-1 text-muted">Consultez notre FAQ pour obtenir des réponses instantanées aux questions les plus courantes.</p>
            <a href="FaqPage.php" class="faq-link">Voir la FAQ →</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


  
<?php include_once('../includes/footer.php') ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
