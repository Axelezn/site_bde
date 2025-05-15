<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - BDE ADMIN</title>
    <link rel="stylesheet" href="/../adminpages/assets/styles/admin.css">
    <style>
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin-bottom: 15px;
            cursor: pointer;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            margin-bottom: 15px;
            cursor: pointer;
        }
    </style>
</head>
<body style="background-color: #f4f4f4; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; color: #333;">
    <div class="container">
        <h1 class="home-title">Tableau de Bord de l'Administration du BDE</h1>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'solde_insuffisant'): ?>
            <div class="error-message" onclick="this.style.display='none';">
                Solde insuffisant pour effectuer le débit. (Cliquez pour fermer)
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'erreur_transaction'): ?>
            <div class="error-message" onclick="this.style.display='none';">
                Erreur lors de l'enregistrement de la transaction. (Cliquez pour fermer)
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'erreur_solde'): ?>
            <div class="error-message" onclick="this.style.display='none';">
                Erreur lors de la mise à jour du solde du compte. (Cliquez pour fermer)
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'compte_introuvable'): ?>
            <div class="error-message" onclick="this.style.display='none';">
                Le compte sélectionné est introuvable. (Cliquez pour fermer)
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'donnees_credit_invalides'): ?>
            <div class="error-message" onclick="this.style.display='none';">
                Les données de crédit sont invalides. Veuillez vérifier le montant. (Cliquez pour fermer)
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'donnees_debit_invalides'): ?>
            <div class="error-message" onclick="this.style.display='none';">
                Les données de débit sont invalides. Veuillez vérifier le montant. (Cliquez pour fermer)
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'donnees_transfert_invalides'): ?>
            <div class="error-message" onclick="this.style.display='none';">
                Les données de transfert sont invalides. Veuillez vérifier les comptes et le montant. (Cliquez pour fermer)
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['success']) && $_GET['success'] === 'transfert_effectue'): ?>
            <div class="success-message" onclick="this.style.display='none';">
                Le transfert a été effectué avec succès. (Cliquez pour fermer)
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['success']) && $_GET['success'] === 'credit_effectue'): ?>
            <div class="success-message" onclick="this.style.display='none';">
                Le crédit a été effectué avec succès. (Cliquez pour fermer)
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['success']) && $_GET['success'] === 'debit_effectue'): ?>
            <div class="success-message" onclick="this.style.display='none';">
                Le débit a été effectué avec succès. (Cliquez pour fermer)
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['success']) && $_GET['success'] === 'compte_modifie'): ?>
            <div class="success-message" onclick="this.style.display='none';">
                Le compte a été modifié avec succès. (Cliquez pour fermer)
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
                                <td><?php echo htmlspecialchars($compte['nom']); ?></td>
                                <td><?php echo htmlspecialchars($compte['RIB']); ?></td>
                                <td><?php echo htmlspecialchars($compte['solde']);?></td>
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
                                <td><?php echo htmlspecialchars($transaction['date_transaction']); ?></td>
                                <td><?php echo htmlspecialchars($transaction['nom_compte']); ?></td>
                                <td style="color: <?php echo $transaction['montant'] >= 0 ? 'green' : 'red'; ?>">
                                    <?php echo htmlspecialchars($transaction['montant']); ?> €
                                </td>
                                <td><?php echo htmlspecialchars($transaction['type']); ?></td>
                                <td><?php echo htmlspecialchars($transaction['description']); ?></td>
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

        <div class="logout-button-container">
            <a href="/adminpages/index.php?action=logout" class="button secondary">Se Déconnecter</a>
        </div>
    </div>
</body>
</html>