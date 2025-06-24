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
    <link rel="stylesheet" href="../css/about-us.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
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
    
<section class="about-hero">
  <div class="about-hero-content">
    <h1>À Propos</h1>
    <h2>Autonomiser les chercheurs d'emploi et les employeurs</h2>
    <p>
      TECH JOB.ma révolutionne le marché de l'emploi technologique au Maroc en connectant les talents exceptionnels<br>
      avec les opportunités qui correspondent à leurs ambitions.
    </p>
  </div>
</section>

<section class="audience-section">
  <div class="audience-box">
    <div class="icon ap-blue">
      <i class="fa-solid fa-user"></i>
    </div>
    <h3>Pour les Chercheurs d'Emploi</h3>
    <p>
      Découvrez des opportunités exceptionnelles dans le secteur technologique. Notre plateforme vous connecte avec les
      entreprises les plus innovantes du Maroc et vous aide à construire la carrière de vos rêves.
    </p>
  </div>
  <div class="audience-box">
    <div class="icon ap-cyan">
      <i class="fa-solid fa-briefcase"></i>
    </div>
    <h3>Pour les Employeurs</h3>
    <p>
      Trouvez les talents technologiques dont votre entreprise a besoin. Notre réseau de professionnels qualifiés vous
      permet de recruter efficacement et de faire grandir vos équipes.
    </p>
  </div>
</section>

<section class="values-section">
  <h2>Nos Valeurs</h2>
  <div class="value-cards">
    <div class="value-card">
      <div class="icon ap-blue">
        <i class="fa-solid fa-bullseye"></i>
      </div>
      <h4>Excellence</h4>
      <p>Nous visons l'excellence dans chaque interaction</p>
    </div>
    <div class="value-card">
      <div class="icon ap-cyan">
        <i class="fa-solid fa-users"></i>
      </div>
      <h4>Communauté</h4>
      <p>Nous construisons une communauté tech forte</p>
    </div>
    <div class="value-card">
      <div class="icon ap-violet">
        <i class="fa-solid fa-arrow-trend-up"></i>
      </div>
      <h4>Innovation</h4>
      <p>Nous innovons constamment nos services</p>
    </div>
    <div class="value-card">
      <div class="icon ap-lime">
        <i class="fa-solid fa-briefcase"></i>
      </div>
      <h4>Opportunités</h4>
      <p>Nous créons des opportunités pour tous</p>
    </div>
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
