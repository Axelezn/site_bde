<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Utilisateur BDE - BDE ADMIN</title>
    <link rel="stylesheet" href="/../adminpages/assets/styles/forms.css">
    <link rel="stylesheet" href="/../adminpages/assets/styles/buttons.css">
</head>
<body>
    <div class="container">
        <h1>Modifier l'Utilisateur BDE</h1>

        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="/adminpages/index.php?action=modifier_bde_utilisateur&id=<?php echo htmlspecialchars($bdeUtilisateur['id']); ?>" method="post">
            <div class="form-group">
                <label for="login">Login :</label>
                <input type="text" id="login" name="login" value="<?php echo htmlspecialchars($bdeUtilisateur['email'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="nouveau_mdp">Nouveau Mot de passe (laisser vide pour ne pas changer) :</label>
                <input type="password" id="nouveau_mdp" name="nouveau_mdp">
            </div>
            <div class="form-group button-container">
                <button type="submit" class="button primary">Modifier</button>
                <a href="/adminpages/index.php?action=gestion_bde_utilisateurs" class="button secondary">Annuler</a>
            </div>
        </form>
    </div>
</body>
</html>