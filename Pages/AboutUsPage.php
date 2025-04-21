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

    <style>
    .contact-links {
        color: #333; 
    }

    .link-group h4 {
        color: #444;
    }

    .link-list li {
        color: #555; 
        padding: 3px 0;
    }

    .link-list li:hover {
        color: #007bff; 
        cursor: pointer;
    }
    </style>

    <section class="contact-container-full" id="contact">
        <div class="contact-container">
            <div class="contact-header">
                <h2>Contactez-Nous</h2>
                <p>Contactez-nous pour toute demande ou assistance</p>
            </div>
            
            <div class="contact-content">
                <div class="contact-links">                
                    <div class="link-group">
                        <h4>Pour les Chercheurs d'Emploi</h4>
                        <ul class="link-list">
                            <li>Rechercher des Offres</li>
                            <li>Téléverser le CV</li>
                            <li>Emplois d'entreprise</li>
                        </ul>
                    </div>

                    <div class="link-group">
                        <h4>Pour les Employeurs</h4>
                        <ul class="link-list">
                            <li>Publier une Offre</li>
                            <li>Rechercher des Entreprises</li>
                            <li>Filtrer les Candidats</li>
                            <li>Voir les Offres Publiées</li>
                        </ul>
                    </div>
                </div>
                
                <div class="contact-info">                
                    <div class="contact-info-item">
                        <h4>Notre Équipe</h4>
                        <p>Yassin Fikri</p>
                        <p>Othmane Bouziane</p>
                        <p>Ibrahim Ouazzani</p>
                    </div>

                    <div class="contact-info-item">
                        <h4>Coordonnées</h4>
                        <p>Téléphone : +212 600 000 000</p>
                        <p>Email : Techjob.ma@gmail.com</p>
                        <p>Horaires : Disponible 24h/24, 7j/7</p>
                    </div>
                    
                    <div class="contact-info-item">
                        <h4>Suivez-Nous</h4>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include_once('../includes/footer.php') ?>
</body>
</html>
