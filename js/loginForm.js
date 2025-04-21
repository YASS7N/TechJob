function formValidator(e) {
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;
  const usernameRegex = /^[a-zA-Z_-]{5,}$/;
  const passwordRegex =
    /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_+={}[\]|\\:;"'<>,.?/~`]).{8,}$/;

  if (!usernameRegex.test(username)) {
    alert(
      'Le nom d\'utilisateur doit contenir au moins 5 caractères et ne peut contenir que des lettres, des tirets bas (_) ou des tirets (-).'
    );
    e.preventDefault();
    return false;
  }
  if (!passwordRegex.test(password)) {
    alert(
      'Le mot de passe doit contenir au moins 8 caractères, incluant une majuscule, une minuscule, un chiffre et un caractère spécial.'
    );
    e.preventDefault();
    return false;
  }
  return true;
}