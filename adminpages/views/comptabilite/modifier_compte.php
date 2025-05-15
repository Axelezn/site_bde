<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Compte - BDE ADMIN</title>
    <link rel="stylesheet" href="/../adminpages/assets/styles/forms.css">
</head>
<body>
    <div class="container">
        <h1>Modifier le Compte</h1>

        <?php if (isset($_GET['error'])): ?>
            <div class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <?php if (isset($compte)): ?>
            <form action="/adminpages/index.php?action=modifier_compte&id=<?php echo $compte['id']; ?>" method="post">
                <div class="form-group">
                    <label for="nom">Nom du Compte:</label>
                    <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($compte['nom']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="RIB">IBAN:</label>
                    <input type="text" id="RIB" name="RIB" value="<?php echo htmlspecialchars($compte['RIB']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($compte['description']); ?>" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="button primary">Enregistrer les Modifications</button>
                    <a href="/adminpages/index.php?action=gerer_comptes" class="button secondary">Annuler</a>
                </div>
            </form>
        <?php else: ?>
            <p>Compte non trouvé.</p>
        <?php endif; ?>
    </div>
</body>
</html>