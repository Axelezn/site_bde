<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - LaManu BDE ADMIN</title>
    <link rel="stylesheet" href="../../adminpages/assets/styles/login.css">
</head>
<body>
    <div class="overlay"></div>
    <div class="login-container">
        <div class="logo">
            <img src="../../../adminpages/assets/imgs/Logo_version_petit.png">
        </div>
        <h2 class="connection-title">CONNEXION</h2>
        <form method="POST">
            <div class="form-group">
                <label for="email">Adresse mail</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="mdp" required>
            </div>
            <button type="submit" class="login-button">Se connecter</button>
        </form>
        <!-- <a href="#" class="forgot-password">Mot de passe oublié ?</a> -->
        <!-- <p class="register-link">Pas encore de compte ? <a href="#">Inscrivez-vous</a></p> -->
        <p>Pas encore inscrit ? <a href="index.php?action=signup">Créer un compte</a></p>
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    </div>
</body>
</html>