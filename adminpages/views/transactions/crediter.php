<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créditer un Compte - BDE ADMIN</title>
    <link rel="stylesheet" href="/../adminpages/assets/styles/forms.css">
</head>
<body>
    <div class="container">
        <h1>Créditer un Compte</h1>

        <form action="/adminpages/index.php?action=crediter_compte" method="post">
            <div class="form-group">
                <label for="compte_id">Compte à créditer:</label>
                <select id="compte_id" name="compte_id" required>
                    <option value="">Sélectionner un compte</option>
                    <?php if (!empty($comptes)): ?>
                        <?php foreach ($comptes as $compte): ?>
                            <option value="<?php echo htmlspecialchars($compte['id']); ?>">
                                <?php echo htmlspecialchars($compte['nom']); ?> (RIB: <?php echo htmlspecialchars($compte['RIB']); ?>) - Solde: <?php echo htmlspecialchars(number_format($compte['solde'], 2)); ?> €
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="montant">Montant à créditer:</label>
                <input type="number" id="montant" name="montant" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" placeholder="Optionnel">
            </div>
            <button type="submit" class="button primary">Créditer</button>
            <a href="/adminpages/index.php?action=home" class="button secondary">Annuler</a>
        </form>
    </div>
</body>
</html>