<form class="form-container" action="../controllers/check-register.php" method="POST">
    <h3 class="register-form-heading">Inscription Employeur</h3>
    <div class="form-fields-row">
        <div class="input-column">
            <div class="input-group-register-form">
                <input type="text" id="firstName" name="firstName" required placeholder=" ">
                <label for="firstName">Prénom</label>
            </div>
            <div class="input-group-register-form">
                <input type="text" id="lastName" name="lastName" required placeholder=" ">
                <label for="lastName">Nom de famille</label>
            </div>
            <div class="input-group-register-form">
                <input type="text" id="username" name="username" required placeholder=" ">
                <label for="username">Nom d'utilisateur</label>
            </div>
            <div class="input-group-register-form">
                <input type="email" id="email" name="email" required placeholder=" ">
                <label for="email">E-mail professionnel</label>
            </div>
        </div>

        <div class="input-column">
            <div class="input-group-register-form">
                <input type="password" id="password" name="password" required placeholder=" ">
                <label for="password">Mot de passe</label>
            </div>
            <div class="input-group-register-form">
                <input type="password" id="confirmPassword" name="confirmPassword" required placeholder=" ">
                <label for="confirmPassword">Confirmer le mot de passe</label>
            </div>
            <div class="input-group-register-form">
                <input type="text" id="phoneNumber" name="phoneNumber" placeholder=" ">
                <label for="phoneNumber">Numéro de téléphone</label>
            </div>
        </div>
    </div>

    <div class="form-fields-row">
        <div class="input-column">
            <div class="input-group-register-form">
                <input type="text" id="companyName" name="companyName" required placeholder=" ">
                <label for="companyName">Nom de l'entreprise</label>
            </div>
        </div>
        <div class="input-group-register-form has-select">
  <select id="industry" name="industry" required>
    <option value="" disabled selected hidden></option>
    <option value="IT">Technologie de l'information</option>
    <option value="Finance">Finance</option>
    <option value="Health">Santé</option>
    <option value="Education">Éducation</option>
    <option value="Manufacturing">Fabrication</option>
    <option value="Retail">Commerce de détail</option>
    <option value="Other">Autre</option>
  </select>
  <label for="industry" class="select-label">Secteur d'activité</label>
</div>


<div class="input-group-register-form has-select">
  <select id="companySize" name="companySize" required>
    <option value="" disabled selected hidden></option>
    <option value="1-10">1-10 employés</option>
    <option value="11-50">11-50 employés</option>
    <option value="51-200">51-200 employés</option>
    <option value="201-500">201-500 employés</option>
    <option value="501-1000">501-1000 employés</option>
    <option value="1000+">1000+ employés</option>
  </select>
  <label for="companySize" class="select-label">Taille de l'entreprise</label>
</div>
</div>

    <input type="hidden" name="role" value="<?php echo $role; ?>">

    <button class="btn-register" type="submit">S'inscrire</button>

    <div class="bottom-line">
        <p>Vous avez déjà un compte ? <a href="./LoginPage.php">Connectez-vous ici !</a></p>
    </div>
</form>