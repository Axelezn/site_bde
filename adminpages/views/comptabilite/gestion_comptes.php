<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Comptes - BDE ADMIN</title>
    <link rel="stylesheet" href="/../adminpages/assets/styles/forms.css">
    <style>
        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            margin-bottom: 15px;
            cursor: pointer; /* Indique que le message est cliquable */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestion des Comptes</h1>

        <?php if (isset($_GET['success']) && $_GET['success'] === 'compte_modifie'): ?>
            <div class="success-message" onclick="this.style.display='none';">
                Le compte a été modifié avec succès. (Cliquez pour fermer)
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <h2>Liste des Comptes</h2>
        <?php if (!empty($comptes)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>RIB</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comptes as $compte): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($compte['nom']); ?></td>
                            <td><?php echo htmlspecialchars($compte['RIB']); ?></td>
                            <td><?php echo htmlspecialchars($compte['description'])?></td>
                            <td>
                                <a href="/adminpages/index.php?action=modifier_compte&id=<?php echo $compte['id']; ?>" class="button small">Modifier</a>
                                <a href="/adminpages/index.php?action=supprimer_compte&id=<?php echo $compte['id']; ?>" class="button small alert" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucun compte n'a été créé.</p>
        <?php endif; ?>

        <div class="button-group">
            <a href="/adminpages/index.php?action=ajouter_compte" class="button primary">Ajouter un Compte</a>
            <a href="/adminpages/index.php?action=home" class="button secondary">Retour au Tableau de Bord</a>
        </div>
    </div>
</body>
</html>