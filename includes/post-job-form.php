<?php
    require_once '../includes/db-connection.php';

    $conn = connectDB();

    $query = 'SELECT * FROM categories';
    $result = mysqli_query($conn, $query);
    $categories = [];
    if($result) {
        while($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }
    }
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<form action="../controllers/post-job.php" method="POST">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Titre du poste</label> 
            <input type="text" name="job-title" class="form-control" placeholder="ex. Développeur Front end" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Catégorie</label>
            <select class="form-select" name="category" id="category" required>
                <option value="">Sélectionnez une catégorie</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= $cat['title'] ?></option>
                <?php endforeach; ?>    
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Spécialisation</label>
            <select class="form-select" name="specializations" id="specialization" required>
                <option value="">Sélectionnez une spécialisation</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Type de poste</label>
            <select class="form-select" name="duration" required>
                <option value="full-time">Temps plein</option>
                <option value="part-time">Temps partiel</option>
                <option value="contract">Contrat</option>
                <option value="internship">Stage</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Niveau d'expérience</label>
            <select class="form-select" name="level" required>
                <option value="entry-level">Débutant</option>
                <option value="mid-level">Intermédiaire</option>
                <option value="senior-level">Senior</option>
                <option value="expert-level">Expert</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Salaire</label>
            <div class="input-group">
                <input type="number" name="min-salary" class="form-control" placeholder="Min" min="0" required >
                <span class="input-group-text">à</span>
                <input type="number" name="max-salary" class="form-control" placeholder="Max" min="0" required >
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Lieu</label>
            <input type="text" name="location" class="form-control" placeholder="ex. Casablanca, Maroc" required>
        </div>
        <div class="col-6 mb-3">
            <label class="form-label">Compétences requises</label>
            <input type="text" name="skills" class="form-control" placeholder="ex. Javascript, PHP" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Entreprise</label> 
            <input type="text" name="company" class="form-control" placeholder="ex. Systems Limited" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Type</label>
            <select class="form-select" name="type" required>
                <option value="onsite">Sur site</option>
                <option value="remote">À distance</option>
                <option value="misson">Mission</option>
            </select>
        </div>
        <div class="col-12 mb-3">
            <label class="form-label">Description du poste</label>
            <textarea class="form-control" name="description" rows="4" placeholder="Entrez une description détaillée du poste" required></textarea>
        </div>
        <div class="col-12 mb-3">
            <label class="form-label">Exigences</label>
            <textarea class="form-control" name="requirements" rows="4" placeholder="Entrez les exigences du poste" required></textarea>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Publier l'offre</button>
        </div>
    </div>
</form>

<script>
document.getElementById('category').addEventListener('change', function() {
    var categoryId = this.value;
    var specializationDropdown = document.getElementById('specialization');
    specializationDropdown.innerHTML = '<option value="">Sélectionnez une spécialisation</option>';

    if (categoryId) {
        fetch('../controllers/get-specializations.php?category_id=' + categoryId)
            .then(response => response.json())
            .then(data => {
                console.log("Données reçues :", data); 
                data.forEach(function(specialization) {
                    var option = document.createElement('option');
                    option.value = specialization.id;
                    option.textContent = specialization.name; 
                    specializationDropdown.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des spécialisations :', error); 
            });
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // JavaScript for form submission and SweetAlert2
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            const formData = new FormData(this);

            // Submit the form using Fetch API
            fetch('../controllers/post-job.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: data.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Redirect or reset the form after success
                        window.location.href = '../Pages/EmployerPage.php'; // Redirect to employer page
                    });
                } else {
                    // Show error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        html: data.message, // Use HTML to display multiple errors
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Une erreur s\'est produite lors de la soumission du formulaire.',
                    confirmButtonText: 'OK'
                });
            });
        });
    </script>