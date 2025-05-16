<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs BDE - BDE ADMIN</title>
    <link rel="stylesheet" href="/../adminpages/assets/styles/admin.css">
    <link rel="stylesheet" href="/../adminpages/assets/styles/tables.css">
    <link rel="stylesheet" href="/../adminpages/assets/styles/buttons.css">
</head>
<body>
    <div class="container">
        <h1>Gestion des Utilisateurs BDE</h1>

        <?php if (isset($_GET['success'])): ?>
            <div class="success-message"><?php echo htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['error'])): ?>
            <div class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <div class="button-container">
            <a href="/adminpages/index.php?action=home" class="button secondary">Retour au Tableau de Bord</a>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Login</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($bdeUtilisateurs)): ?>
                        <?php foreach ($bdeUtilisateurs as $bdeUtilisateur): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($bdeUtilisateur['id']); ?></td>
                                <td><?php echo htmlspecialchars($bdeUtilisateur['email'] ?? ''); ?></td>
                                <td class="actions">
                                    <a href="/adminpages/index.php?action=afficher_formulaire_modification_bde_utilisateur&id=<?php echo htmlspecialchars($bdeUtilisateur['id']); ?>" class="button secondary small">Modifier</a>
                                    <a href="/adminpages/index.php?action=supprimer_bde_utilisateur&id=<?php echo htmlspecialchars($bdeUtilisateur['id']); ?>" class="button danger small" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur BDE ?');">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="3">Aucun utilisateur BDE trouvé.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>