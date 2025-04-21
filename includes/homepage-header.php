<?php 
$currentPage = 'Accueil';
include '../includes/applicant-header.php';
?>

<script>
    const hamBurger = document.querySelector('.ham-burger');
    const navLinks = document.querySelector('.nav-links');
    const toggleClasses = () => navLinks.classList.toggle('active');
    hamBurger.addEventListener('click', toggleClasses);
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<section class="hero-slider">
    <div class="slides-container">
        <div class="slide active">
            <img src="../assets/images/background.jpg" class="background" alt="Background 1">
            <div class="slide-content">
                <div class="text-content">
                    <h1>Trouvez votre emploi IT de rêve</h1>
                    <h6>Commencez votre carrière avec Tech Job</h6>
                    <a href="JobsListing.php" class="btn-see-jobs">Voir les emplois disponibles</a>
                </div>
                <img src="../assets/images/person1.png" class="foreground" alt="Person 1">
            </div>
        </div>
        <div class="slide">
            <img src="../assets/images/background.jpg" class="background" alt="Background 2">
            <div class="slide-content">
                <div class="text-content">
                    <h1>Connectez-vous avec les meilleurs recruteurs</h1>
                    <h6>Nous construisons votre avenir dès maintenant</h6>
                    <a href="#jobs-section" class="btn-see-jobs">Voir les emplois disponibles</a>
                </div>
                <img src="../assets/images/person2.png" class="foreground" alt="Person 2">
            </div>
        </div>
        <div class="slide">
            <img src="../assets/images/background.jpg" class="background" alt="Background 3">
            <div class="slide-content">
                <div class="text-content">
                    <h1>Postulez plus rapidement que jamais</h1>
                    <h6>Une plateforme faite pour vous</h6>
                    <a href="#jobs-section" class="btn-see-jobs">Voir les emplois disponibles</a>
                </div>
                <img src="../assets/images/person3.png" class="foreground" alt="Person 3">
            </div>
        </div>
    </div>
</section>
<style>
.btn-see-jobs {
    margin-top: 2rem;
    padding: 0.75rem 2rem;
    border-radius: 8px;
    background: linear-gradient(135deg, #00f2ff, #3a6eff);
    color: white;
    font-weight: 600;
    font-size: 1.1rem;
    text-decoration: none;
    display: inline-block;
    text-align: center;
    transition: all 0.3s ease;
}

.btn-see-jobs:hover {
    transform: scale(1.05);
}

@media (max-width: 768px) {
    .btn-see-jobs {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
    }
}

</style>

<script>
    const slidesContainer = document.querySelector('.slides-container');
    let currentSlide = 0;

    function nextSlide() {
        currentSlide = (currentSlide + 1) % 3; 
        slidesContainer.style.transform = `translateX(-${currentSlide * 100}vw)`;
    }

    setInterval(nextSlide, 5000); 
</script>
