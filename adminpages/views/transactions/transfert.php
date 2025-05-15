<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Effectuer un Transfert - BDE ADMIN</title>
    <link rel="stylesheet" href="/../adminpages/assets/styles/forms.css">
</head>
<body>
    <div class="container">
        <h1>Effectuer un Transfert</h1>

        <form action="/adminpages/index.php?action=effectuer_transfert" method="post">
            <div class="form-group">
                <label for="compte_source_id">Compte Source:</label>
                <select id="compte_source_id" name="compte_source_id" required>
                    <option value="">Sélectionner un compte source</option>
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
                <label for="compte_destination_id">Compte Destination:</label>
                <select id="compte_destination_id" name="compte_destination_id" required>
                    <option value="">Sélectionner un compte destination</option>
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
                <label for="montant">Montant à transférer:</label>
                <input type="number" id="montant" name="montant" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" placeholder="Optionnel">
            </div>
            <button type="submit" class="button primary">Effectuer le Transfert</button>
            <a href="/adminpages/index.php?action=home" class="button secondary">Annuler</a>
        </form>
    </div>
</body>
</html>