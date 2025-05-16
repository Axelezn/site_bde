<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Utilisateur BDE - BDE ADMIN</title>
    <link rel="stylesheet" href="/../adminpages/assets/styles/forms.css">
    <link rel="stylesheet" href="/../adminpages/assets/styles/buttons.css">
</head>
<body>
    <div class="container">
        <h1>Créer un Utilisateur BDE</h1>

        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="post" action="/adminpages/index.php?action=creer_utilisateur_admin">
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="email">Email (Login) :</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="mdp">Mot de passe :</label>
                <input type="password" id="mdp" name="mdp" required>
            </div>
            <div class="form-group button-container">
                <button type="submit" class="button primary">Créer</button>
                <a href="/adminpages/index.php?action=gestion_bde_utilisateurs" class="button secondary">Annuler</a>
            </div>
        </form>
    </div>
</body>
</html>