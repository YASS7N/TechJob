<?php
session_start();
$userId = $_SESSION['userId'] ?? null;
if (!$userId) {
    $redirect = true;
} else {
    $redirect = false;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST["nom"] ?? "";
    $email = $_POST["email"] ?? "";
    $telephone = $_POST["telephone"] ?? "";
    $adresse = $_POST["adresse"] ?? "";
    $github = $_POST["github"] ?? "";
    $diplome = $_POST["diplome"] ?? "";
    $etablissement = $_POST["etablissement"] ?? "";
    $annee = $_POST["annee"] ?? "";
    $competences = $_POST["competences"] ?? "";
    $langues = $_POST["langues"] ?? "";
    $experience = $_POST["experience"] ?? "";
    $date_entree = $_POST["date_entree"] ?? "";
    $jobId = $_POST["jobId"] ?? null;

    $upload_success = false;
    $upload_error = "";

    if (isset($_FILES["cv_file"]) && $_FILES["cv_file"]["error"] === UPLOAD_ERR_OK) {
        $fileTmp = $_FILES["cv_file"]["tmp_name"];
        $fileName = basename($_FILES["cv_file"]["name"]);
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if ($fileExt === "pdf") {
            $uploadDir = "uploaded-files/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $uniqueName = uniqid() . "_" . $fileName;
            $destination = $uploadDir . $uniqueName;

            if (move_uploaded_file($fileTmp, $destination)) {
                $upload_success = true;
            } else {
                $upload_error = "Erreur lors de l'envoi du fichier.";
            }
        } else {
            $upload_error = "Veuillez téléverser un fichier PDF uniquement.";
        }
    } else {
        $upload_error = "Aucun fichier n'a été sélectionné.";
    }

    if ($upload_success) {
        $conn = new mysqli("localhost", "root", "", "job");

        if ($conn->connect_error) {
            die("Erreur de connexion: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO applicants 
        (jobId, userId, nom, email, telephone, adresse, github, diplome, etablissement, annee, competences, langues, experience, date_entree, cv_filename)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


        if ($stmt) {
        $stmt->bind_param("sssssssssssssss", 
         $jobId, $userId, $nom, $email, $telephone, $adresse, $github, $diplome, $etablissement, $annee, 
         $competences, $langues, $experience, $date_entree, $uniqueName);

            if ($stmt->execute()) {
                echo "<script>alert('Votre CV a été soumis avec succès et enregistré !');</script>";
            } else {
                echo "<script>alert('Erreur lors de l\'exécution de la requête: " . $stmt->error . "');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Erreur de préparation de la requête: " . $conn->error . "');</script>";
        }

        $conn->close();
    } else {
        echo "<script>alert('Erreur: " . $upload_error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Créateur de CV IT</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link rel="stylesheet" href="../css/jobapplication.css">
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
  <div class="container py-5">
    <h2 class="text-center fw-bold mb-4">Créateur de CV IT</h2>

    <form method="POST" enctype="multipart/form-data">
      <!-- Informations personnelles -->
      <div class="card-custom">
        <div class="card-header-custom card-header-blue">
          <i class="fa-solid fa-user"></i> Informations personnelles
        </div>
        <div class="card-body-custom">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Nom complet *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                <input type="text" name="nom" class="form-control" placeholder="Votre nom complet" required>
              </div>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="votre@email.com" required>
              </div>
            </div>
            <div class="col-md-6">
              <label class="form-label">Téléphone *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                <input type="text" name="telephone" class="form-control" placeholder="+33 6 XX XX XX XX" required>
              </div>
            </div>
            <div class="col-md-6">
              <label class="form-label">Adresse *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                <input type="text" name="adresse" class="form-control" placeholder="Votre adresse" required>
              </div>
            </div>
            <div class="col-md-6">
              <label class="form-label">GitHub *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa-brands fa-github"></i></span>
                <input type="text" name="github" class="form-control" placeholder="github.com/votre-username" required>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Éducation -->
      <div class="card-custom">
        <div class="card-header-custom card-header-red">
          <i class="fa-solid fa-graduation-cap"></i> Éducation
        </div>
        <div class="card-body-custom">
          <div class="mb-3">
            <label class="form-label">Diplôme</label>
            <input type="text" name="diplome" class="form-control" placeholder="Licence / Master / BTS...">
          </div>
          <div class="mb-3">
            <label class="form-label">Établissement</label>
            <input type="text" name="etablissement" class="form-control" placeholder="Nom de l'établissement">
          </div>
          <div class="mb-3">
            <label class="form-label">Année</label>
            <input type="text" name="annee" class="form-control" placeholder="2020 - 2023">
          </div>
        </div>
      </div>

      <!-- Compétences -->
      <div class="card-custom">
        <div class="card-header-custom card-header-green">
          <i class="fa-solid fa-screwdriver-wrench"></i> Compétences
        </div>
        <div class="card-body-custom">
          <div class="mb-3">
            <label class="form-label">Compétences techniques</label>
            <input type="text" name="competences" class="form-control" placeholder="HTML, CSS, JavaScript, Python...">
          </div>
          <div class="mb-3">
            <label class="form-label">Langues</label>
            <input type="text" name="langues" class="form-control" placeholder="Français, Anglais, Arabe...">
          </div>
        </div>
      </div>

      <!-- Informations supplémentaires -->
      <div class="card-custom">
        <div class="card-header-custom" style="background: linear-gradient(90deg, #f0e6ff, #e6e6ff);">
          <i class="fa-regular fa-calendar-plus"></i> Informations supplémentaires
        </div>
        <div class="card-body-custom">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Années d'expérience *</label>
              <input type="text" name="experience" class="form-control" placeholder="Ex: 2 ans" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Date d'entrée prévue *</label>
              <input type="date" name="date_entree" class="form-control" required>
            </div>
          </div>

          <div class="mt-4">
            <label class="form-label">Téléverser un CV (PDF) :</label>
            <div class="border rounded p-4 text-center" style="border-style: dashed; background-color: #f9fafb; position: relative;">
              <i class="fa-solid fa-upload fa-2x mb-2" style="color:  #3a6eff;"></i>
              <p class="mb-1"><strong>Cliquez pour téléverser</strong> ou glissez-déposez</p>
              <p class="text-muted" style="font-size: 0.9rem;">PDF uniquement</p>
              <input type="file" name="cv_file" accept="application/pdf" class="form-control mt-2" required>
            </div>
          </div>
        </div>
      </div>
      <input type="hidden" name="jobId" value="<?php echo htmlspecialchars($_GET['jobId'] ?? '', ENT_QUOTES); ?>">

      <div class="text-center mt-4">
        <button class="btn btn-submit" type="submit">Soumettre</button>
      </div>
    </form>
  </div>
</body>
</html>
