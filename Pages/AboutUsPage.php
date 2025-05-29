<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À Propos - Tech Job</title>
    <link rel="stylesheet" href="../styles/AboutUsPage/styles.css">
    <link rel="stylesheet" href="../styles/generalStyles.css">
    <link rel="stylesheet" href="../styles/HomePage/header.css">
    <link rel="stylesheet" href="../styles/HomePage/contact-section.css">
    <link rel="stylesheet" href="../styles/HomePage/footer.css">
    <link rel="stylesheet" href="../styles/HomePage/common-styles.css">
    <link rel="stylesheet" href="../css/about.css">
</head>
<body class="bg-light">
    <?php 
        $currentPage = 'About';
        include_once '../includes/applicant-header.php'
    ?>
    <script>
        const hamBurger = document.querySelector('.ham-burger');
        const navLinks = document.querySelector('.nav-links');
        const toggleClasses = () => navLinks.classList.toggle('active')
        hamBurger.addEventListener('click', toggleClasses);
    </script>

    <section class="main-section">
        <div class="content">
            <h1 class="heading">À Propos</h1>
            <p class="sub-heading">Autonomiser les chercheurs d'emploi et les employeurs</p>
        </div>
    </section>

    <section class="info-section">
        <div class="info-box">
            <h3 class="info-heading">Notre Vision</h3>
            <p class="info-text">
                Nous sommes un portail d'emploi de premier plan, axé sur la mise en relation des employeurs avec les meilleurs talents disponibles. Notre plateforme est conçue pour simplifier le processus de recrutement pour les employeurs et aider les chercheurs d'emploi à trouver leurs rôles idéaux, le tout en un clic. Que vous recherchiez un poste à temps plein, un emploi à temps partiel ou des opportunités en freelance, nous offrons une expérience fluide pour les chercheurs d'emploi et les recruteurs.
            </p>
        </div>
        <div class="info-box">
            <h3 class="info-heading">Notre Mission</h3>
            <p class="info-text">
                Notre mission est de combler le fossé entre les chercheurs d'emploi et les employeurs en créant une plateforme à la fois intuitive et efficace. Nous nous engageons à aider les individus à évoluer dans leur carrière tout en aidant les organisations à trouver les bonnes personnes pour contribuer à leur succès. Grâce à des outils de création de CV, des alertes emploi et une interface conviviale, nous visons à créer un environnement favorable à l'évolution de carrière et à la réussite du recrutement.
            </p>
        </div>
        <div class="info-box">
            <h3 class="info-heading">Nos Valeurs Fondamentales</h3>
            <p class="info-text">
                L'intégrité, l'inclusivité et l'innovation sont au cœur de tout ce que nous faisons. Nous croyons en une plateforme accessible et équitable pour tous, quel que soit le parcours ou le secteur. En favorisant une culture de transparence et d'amélioration continue, nous aspirons à créer une communauté où les talents peuvent s'épanouir et où les employeurs peuvent trouver le bon profil.
            </p>
        </div>
        <div class="info-box">
            <h3 class="info-heading">Ce Que Nous Offrons</h3>
            <p class="info-text">
                Des recommandations d'emploi personnalisées à la création de CV et aux évaluations de compétences, nous offrons une large gamme d'outils pour autonomiser les chercheurs d'emploi et les recruteurs. Notre plateforme vous accompagne à chaque étape — que vous exploriez des opportunités ou cherchiez à embaucher. Nous visons à être une solution tout-en-un qui évolue avec vous.
            </p>
        </div>
    </section>
<section class="team-section text-center my-5">
  <h2 class="fw-bold">Notre Équipe</h2>
  <p class="text-muted">Rencontrez les talents qui donnent vie à nos projets</p>

  <div class="container mt-5">
    <div class="row g-4 justify-content-center">
      <!-- Yassin -->
      <div class="col-md-4">
        <div class="team-card blue">
          <div class="top-section">
            <div class="profile-image">
              <img src="../assets/images/yassinn.png" alt="Photo de Yassin">
            </div>
            <span class="status-dot"></span>
          </div>
          <div class="bottom-section">
            <h5 class="fw-bold mb-1">Yassin Fikri</h5>
            <p class="role text-primary fw-semibold">Développeur Full Stack & Designer UX/UI</p>
            <p class="description">
              Expert en développement full-stack avec une forte sensibilité UI/UX. Maîtrise PHP, JavaScript et MySQL pour créer des interfaces élégantes et fonctionnelles.
            </p>
            <div class="tags">
              <span class="tag bg-teal text-white">MYSQL</span>
              <span class="tag bg-purple text-white">PHP</span>
              <span class="tag bg-warning text-black">Javascript</span>
              <span class="tag bg-primary text-white">UI/UX</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Ibrahim -->
      <div class="col-md-4">
        <div class="team-card green">
          <div class="top-section">
            <div class="profile-image">
              <img src="../assets/images/brahiim.png" alt="Photo de Ibrahim">
            </div>
            <span class="status-dot"></span>
          </div>
          <div class="bottom-section">
            <h5 class="fw-bold mb-1">Ibrahim Ouazzani</h5>
            <p class="role text-success fw-semibold">Développeur Full Stack</p>
            <p class="description">
              Développeur full-stack spécialisé dans le développement d'applications web dynamiques avec PHP, JavaScript et MySQL.
            </p>
            <div class="tags">
              <span class="tag bg-teal text-white">MYSQL</span>
              <span class="tag bg-purple text-white">PHP</span>
              <span class="tag bg-warning text-black">Javascript</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Othmane -->
      <div class="col-md-4">
        <div class="team-card purple">
          <div class="top-section">
            <div class="profile-image">
              <img src="../assets/images/othmane.png" alt="Photo de Othmane">
            </div>
            <span class="status-dot"></span>
          </div>
          <div class="bottom-section">
            <h5 class="fw-bold mb-1">Othmane Bouziane</h5>
            <p class="role text-red fw-semibold">Développeur Full Stack</p>
            <p class="description">
              Développeur full-stack compétent en PHP, JavaScript et MySQL, avec une solide expérience dans la création d'architectures web performantes.
            </p>
            <div class="tags">
              <span class="tag bg-teal text-white">MYSQL</span>
              <span class="tag bg-purple text-white">PHP</span>
              <span class="tag bg-warning text-black">Javascript</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>





    <?php include_once('../includes/footer.php') ?>
</body>
</html>
