<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - La Manu</title>
    <link rel="stylesheet" href="../../assets/styles/signup.css"
</head>
<body>
    <div class="overlay"></div>
    <div class="login-container">

        <div class="logo">
            <img src="../../assets/imgs/Logo_version_petit.png">
        </div>

        <h2 class="connection-title">S'inscrire</h2>
        <form method="POST" onsubmit="return validatePassword()">
            <div class="form-group">
                <label>Prénom</label>
                <input type="text" name="prenom" required>
            </div>
            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="mdp" required>
            </div>
             <div class="form-group">
                <label>Confirmer le mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <p id="password_error" class="error-message"></p>
            </div>
            <button type="submit">S'inscrire</button>
        </form>
    </div>
    <script>
        function validatePassword() {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirm_password").value;
            const passwordError = document.getElementById("password_error");

            if (password !== confirmPassword) {
                passwordError.textContent = "Les mots de passe ne correspondent pas.";
                return false; // Empêche la soumission du formulaire
            } else {
                passwordError.textContent = ""; // Efface le message d'erreur
                return true; // Autorise la soumission du formulaire
            }
        }
    </script>
</body>
</html>
