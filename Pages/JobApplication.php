<?php
session_start();
require_once "../includes/db-connection.php";

if (!isset($_SESSION['user']) || !isset($_GET['jobId'])) {
    $redirect = true;
} else {
    $jobId = $_GET['jobId'];
    $userId = $_SESSION['userId']; 
    $conn = connectDB();

    $sql = "SELECT title FROM jobs WHERE id = $jobId";
    $result = mysqli_query($conn, $sql);

    if (!$result || mysqli_num_rows($result) === 0) {
        $redirect = true;
    } else {
        $job = mysqli_fetch_assoc($result);
        $jobTitle = htmlspecialchars($job['title']);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postuler pour <?= $jobTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/generalStyles.css">
    <link rel="stylesheet" href="../styles/JobApplication/apply-form.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php if (isset($redirect) && $redirect): ?>
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Vous devez être connecté !',
            text: 'Veuillez vous connecter pour postuler à un emploi.',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'LoginPage.php';
        });
    </script>
<?php exit; endif; ?>

<div class="form-container">
    <h1>Postuler pour <?= $jobTitle ?></h1>
    <form action="../controllers/apply-for-job.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="jobId" value="<?= $jobId ?>">
        <input type="hidden" name="userId" value="<?= $userId ?>">
        
        <div class="form-group">
            <label for="experience">Expérience (années) :</label>
            <input type="number" name="experience" id="experience" min="0" required>
        </div>

        <div class="form-group">
            <label for="joiningDate">Date d'entrée prévue :</label>
            <input type="date" name="joiningDate" id="joiningDate" required>
        </div>

        <div class="form-group">
            <label for="cv">Téléverser un CV :</label>
            <p class="text-warning small">Incluez votre numéro de téléphone ou e-mail dans votre CV.</p>
            <input type="file" name="cv" id="cv" accept=".pdf" required>
        </div>

        <div class="form-group">
            <label for="coverLetter">Lettre de motivation :</label>
            <textarea name="coverLetter" id="coverLetter" rows="5" required></textarea>
        </div>

        <button type="submit" class="submit-btn">Soumettre la candidature</button>
    </form>
</div>

<script>
    document.getElementById('applicationForm').addEventListener('submit', function (event) {
        const fields = {
            experience: document.getElementById('experience').value.trim(),
            joiningDate: document.getElementById('joiningDate').value.trim(),
            cv: document.getElementById('cv').files[0],
            coverLetter: document.getElementById('coverLetter').value.trim()
        };

        let errorMessage = '';
        const today = new Date();

        if (!fields.experience || isNaN(fields.experience) || fields.experience < 0) {
            errorMessage += 'L\'expérience doit être un nombre valide >= 0.\n';
        }
        const selectedDate = new Date(fields.joiningDate);
        if (!fields.joiningDate || selectedDate < today) {
            errorMessage += 'La date d\'entrée est requise et ne peut pas être dans le passé.\n';
        }
        if (!fields.cv || !fields.cv.name.endsWith('.pdf')) {
            errorMessage += 'Veuillez téléverser un CV valide au format PDF.\n';
        }
        if (fields.coverLetter.length < 50) {
            errorMessage += 'La lettre de motivation doit contenir au moins 50 caractères.\n';
        }
        if (errorMessage) {
            event.preventDefault();
            alert(errorMessage);
        }
    });
</script>
</body>
</html>