<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Compte - BDE ADMIN</title>
    <link rel="stylesheet" href="/../adminpages/assets/styles/forms.css">
</head>
<body>
    <div class="container">
        <h1>Gestion des Comptes</h1>
        <h2>Ajouter un Compte</h2>

        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="index.php?action=ajouter_compte" method="post">
            <div class="form-group">
                <label for="nom">Nom du Compte :</label>
                <input type="text" id="nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="RIB">RIB (facultatif) :</label>
                <input type="text" id="RIB" name="RIB" maxlength="34">
            </div>

            <button type="submit" class="button primary">Ajouter le Compte</button>
            <a href="index.php?action=gerer_comptes" class="button secondary">Annuler</a>
        </form>
    </div>
</body>
</html>