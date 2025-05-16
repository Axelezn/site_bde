<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - BDE ADMIN</title>
    <link rel="stylesheet" href="/../adminpages/assets/styles/admin.css">
</head>
<body>
    <div class="container">
        <h1 class="home-title">Tableau de Bord de l'Administration du BDE</h1>

        <?php
        $messages = [
            'solde_insuffisant' => 'Solde insuffisant pour effectuer le débit.',
            'erreur_transaction' => 'Erreur lors de l\'enregistrement de la transaction.',
            'erreur_solde' => 'Erreur lors de la mise à jour du solde du compte.',
            'compte_introuvable' => 'Le compte sélectionné est introuvable.',
            'donnees_credit_invalides' => 'Les données de crédit sont invalides. Veuillez vérifier le montant.',
            'donnees_debit_invalides' => 'Les données de débit sont invalides. Veuillez vérifier le montant.',
            'donnees_transfert_invalides' => 'Les données de transfert sont invalides. Veuillez vérifier les comptes et le montant.',
            'transfert_effectue' => 'Le transfert a été effectué avec succès.',
            'credit_effectue' => 'Le crédit a été effectué avec succès.',
            'debit_effectue' => 'Le débit a été effectué avec succès.',
            'compte_modifie' => 'Le compte a été modifié avec succès.',
            'utilisateur_cree' => 'L\'utilisateur a été créé avec succès.',
            'utilisateur_modifie' => 'L\'utilisateur a été modifié avec succès.',
            'utilisateur_supprime' => 'L\'utilisateur a été supprimé avec succès.',
            'erreur_creation_utilisateur' => 'Erreur lors de la création de l\'utilisateur.',
            'erreur_modification_utilisateur' => 'Erreur lors de la modification de l\'utilisateur.',
            'erreur_suppression_utilisateur' => 'Erreur lors de la suppression de l\'utilisateur.',
            'methode_non_autorisee' => 'Méthode non autorisée.',
        ];

        if (isset($_GET['error']) && isset($messages[$_GET['error']])): ?>
            <div class="error-message" onclick="this.style.display='none';">
                <?= htmlspecialchars($messages[$_GET['error']]) ?> (Cliquez pour fermer)
            </div>
        <?php elseif (isset($_GET['success']) && isset($messages[$_GET['success']])): ?>
            <div class="success-message" onclick="this.style.display='none';">
                <?= htmlspecialchars($messages[$_GET['success']]) ?> (Cliquez pour fermer)
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['user']['prenom'])): ?>
            <div class="welcome-message">
                Bonjour <?= htmlspecialchars($_SESSION['user']['prenom']); ?> !
            </div>
        <?php endif; ?>

        <div class="comptes-section">
            <h2>Liste des Comptes bancaires</h2>
            <?php if (!empty($comptes)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nom du Compte</th>
                            <th>RIB</th>
                            <th>Solde</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comptes as $compte): ?>
                            <tr>
                                <td><?= htmlspecialchars($compte['nom']); ?></td>
                                <td><?= htmlspecialchars($compte['RIB']); ?></td>
                                <td><?= htmlspecialchars($compte['solde']); ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun compte n'a été créé pour le moment.</p>
            <?php endif; ?>
            <a href="/adminpages/index.php?action=gerer_comptes" class="button primary">Gérer les Comptes</a>
        </div>

        <div class="transactions-section">
            <h2>Dernières Transactions</h2>
            <?php if (!empty($dernieresTransactions)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Compte</th>
                            <th>Montant</th>
                            <th>Type</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dernieresTransactions as $transaction): ?>
                            <tr>
                                <td><?= htmlspecialchars($transaction['date_transaction']); ?></td>
                                <td><?= htmlspecialchars($transaction['nom_compte']); ?></td>
                                <td class="<?= $transaction['montant'] >= 0 ? 'positive' : 'negative' ?>">
                                    <?= htmlspecialchars($transaction['montant']); ?> €
                                </td>
                                <td><?= htmlspecialchars($transaction['type']); ?></td>
                                <td><?= htmlspecialchars($transaction['description']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucune transaction récente.</p>
            <?php endif; ?>
        </div>

        <div class="gerer-transactions-section">
            <h2>Gérer les transactions</h2>
            <div class="buttons-container">
                <a href="/adminpages/index.php?action=afficher_formulaire_credit" class="button primary">Créditer un Compte</a>
                <a href="/adminpages/index.php?action=afficher_formulaire_debit" class="button secondary">Débiter un Compte</a>
                <a href="/adminpages/index.php?action=afficher_formulaire_transfert" class="button">Effectuer un Transfert</a>
            </div>
        </div>

        <div class="gestion-bde-utilisateurs-section">
            <h2>Gestion des Utilisateurs BDE</h2>
            <div class="button-container">
                <a href="/adminpages/index.php?action=gestion_bde_utilisateurs" class="button primary">Gérer les Utilisateurs BDE</a>
                <a href="/adminpages/index.php?action=afficher_formulaire_creation_utilisateur_admin" class="button primary">Ajouter un Utilisateur BDE</a>
            </div>
        </div>

        <div class="logout-button-container">
            <a href="/adminpages/index.php?action=logout" class="button secondary">Se Déconnecter</a>
        </div>
    </div>
</body>
</html>
