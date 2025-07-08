<?php
define('BASE_URL', '/TechJob');

$partnerCompanies = [
    ['name' => 'Techninnovate Maroc', 'image' => 'techninnovate.png'],
    ['name' => 'StartupSuccess Casablanca', 'image' => 'startup.png'],
    ['name' => 'ModeFashion Rabat', 'image' => 'mode.png'],
    ['name' => 'DigitalBoost Marrakech', 'image' => 'digital.png'],
    ['name' => 'InnovateCorp Fès', 'image' => 'fes.png'],
    ['name' => 'SalesForce Pro Tanger', 'image' => 'sales.png'],
];
?>

<section class="companies py-5" style="background: #f9f9f9;">
    <div class="container text-center">
        <div class="mb-4">
            <div style="font-size: 2rem; color: #007bff;">
                <i class="fas fa-building"></i>
            </div>
            <h2 class="fw-bold mb-2" style="color: #007bff;">Les Meilleures Entreprises</h2>
            <p class="text-muted">Plus de 1000+ entreprises nous font confiance pour leur transformation digitale</p>
            <div class="mt-2" style="color: #fbc531; font-size: 1.2rem;">
                ★★★★★ <span class="text-dark fw-bold">Noté 4.9/5</span> par nos partenaires
            </div>
        </div>

        <div class="row justify-content-center g-4 mt-4">
            <?php foreach ($partnerCompanies as $company): ?>
                <div class="col-4 col-sm-3 col-md-2">
                    <div class="company-logo shadow-sm mx-auto" title="<?= htmlspecialchars($company['name']) ?>">
                        <img src="<?= BASE_URL ?>/assets/images/companies/<?= $company['image'] ?>" alt="<?= htmlspecialchars($company['name']) ?>">
                    </div>
                    <div class="small mt-2 text-muted"><?= htmlspecialchars($company['name']) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
.company-logo {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid #ddd;
}
.company-logo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
    display: block;
}
.company-logo img:hover {
    transform: scale(1.05);
}
</style>
