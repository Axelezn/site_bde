<?php

require_once __DIR__ . '/../models/Account.php';
require_once __DIR__ . '/../models/Transaction.php';

class TransactionController
{
    private $accountModel;
    private $transactionModel;

    public function __construct()
    {
        $this->accountModel = new Account();
        $this->transactionModel = new Transaction();
    }

    public function afficherFormulaireCredit()
    {
        $comptes = $this->accountModel->getAllAccounts();
        require __DIR__ . '/../views/transactions/crediter.php';
    }

    public function crediterCompte()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $compteId = $_POST['compte_id'] ?? null;
            $montant = $_POST['montant'] ?? null;
            $description = $_POST['description'] ?? null;

            if ($compteId && is_numeric($montant) && $montant > 0) {
                $compte = $this->accountModel->getAccountById($compteId);
                if ($compte) {
                    $nouveauSolde = $compte['solde'] + $montant;
                    if ($this->accountModel->updateAccountBalance($compteId, $nouveauSolde)) {
                        $transactionData = [
                            'compte_id' => $compteId,
                            'montant' => $montant,
                            'type' => 'credit',
                            'description' => $description ?? 'Crédit'
                        ];
                        if ($this->transactionModel->addTransaction($transactionData)) {
                            header('Location: /adminpages/index.php?action=home&success=credit_effectue');
                            exit();
                        } else {
                            header('Location: /adminpages/index.php?action=home&error=erreur_transaction');
                            exit();
                        }
                    } else {
                        header('Location: /adminpages/index.php?action=home&error=erreur_solde');
                        exit();
                    }
                } else {
                    header('Location: /adminpages/index.php?action=home&error=compte_introuvable');
                    exit();
                }
            } else {
                header('Location: /adminpages/index.php?action=home&error=donnees_credit_invalides');
                exit();
            }
        } else {
            header('Location: /adminpages/index.php?action=home');
            exit();
        }
    }

    public function afficherFormulaireDebit()
    {
        $comptes = $this->accountModel->getAllAccounts();
        require __DIR__ . '/../views/transactions/debiter.php';
    }

    public function debiterCompte()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $compteId = $_POST['compte_id'] ?? null;
            $montant = $_POST['montant'] ?? null;
            $description = $_POST['description'] ?? null;

            if ($compteId && is_numeric($montant) && $montant > 0) {
                $compte = $this->accountModel->getAccountById($compteId);
                if ($compte) {
                    if ($compte['solde'] >= $montant) {
                        $nouveauSolde = $compte['solde'] - $montant;
                        if ($this->accountModel->updateAccountBalance($compteId, $nouveauSolde)) {
                            $transactionData = [
                                'compte_id' => $compteId,
                                'montant' => -$montant,
                                'type' => 'debit',
                                'description' => $description ?? 'Débit'
                            ];
                            if ($this->transactionModel->addTransaction($transactionData)) {
                                header('Location: /adminpages/index.php?action=home&success=debit_effectue');
                                exit();
                            } else {
                                header('Location: /adminpages/index.php?action=home&error=erreur_transaction');
                                exit();
                            }
                        } else {
                            header('Location: /adminpages/index.php?action=home&error=erreur_solde');
                            exit();
                        }
                    } else {
                        header('Location: /adminpages/index.php?action=home&error=solde_insuffisant');
                        exit();
                    }
                } else {
                    header('Location: /adminpages/index.php?action=home&error=compte_introuvable');
                    exit();
                }
            } else {
                header('Location: /adminpages/index.php?action=home&error=donnees_debit_invalides');
                exit();
            }
        } else {
            header('Location: /adminpages/index.php?action=home');
            exit();
        }
    }
    public function afficherFormulaireTransfert()
    {
        $comptes = $this->accountModel->getAllAccounts();
        require __DIR__ . '/../views/transactions/transfert.php';
    }

    public function effectuerTransfert()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $compteSourceId = $_POST['compte_source_id'] ?? null;
            $compteDestinationId = $_POST['compte_destination_id'] ?? null;
            $montant = $_POST['montant'] ?? null;
            $description = $_POST['description'] ?? null;

            if ($compteSourceId && $compteDestinationId && is_numeric($montant) && $montant > 0 && $compteSourceId !== $compteDestinationId) {
                $compteSource = $this->accountModel->getAccountById($compteSourceId);
                $compteDestination = $this->accountModel->getAccountById($compteDestinationId);

                if ($compteSource && $compteDestination) {
                    if ($compteSource['solde'] >= $montant) {
                        // Débiter le compte source
                        $nouveauSoldeSource = $compteSource['solde'] - $montant;
                        if ($this->accountModel->updateAccountBalance($compteSourceId, $nouveauSoldeSource)) {
                            // Créditer le compte destination
                            $nouveauSoldeDestination = $compteDestination['solde'] + $montant;
                            if ($this->accountModel->updateAccountBalance($compteDestinationId, $nouveauSoldeDestination)) {
                                // Enregistrer les transactions
                                $transactionSourceData = [
                                    'compte_id' => $compteSourceId,
                                    'montant' => -$montant,
                                    'type' => 'transfert',
                                    'description' => 'Transfert vers ' . $compteDestination['nom'] . ($description ? ' - ' . $description : '')
                                ];
                                $this->transactionModel->addTransaction($transactionSourceData);

                                $transactionDestinationData = [
                                    'compte_id' => $compteDestinationId,
                                    'montant' => $montant,
                                    'type' => 'transfert',
                                    'description' => 'Transfert depuis ' . $compteSource['nom'] . ($description ? ' - ' . $description : '')
                                ];
                                $this->transactionModel->addTransaction($transactionDestinationData);

                                header('Location: /adminpages/index.php?action=home&success=transfert_effectue');
                                exit();
                            } else {
                                header('Location: /adminpages/index.php?action=home&error=erreur_solde');
                                exit();
                            }
                        } else {
                            header('Location: /adminpages/index.php?action=home&error=erreur_solde');
                            exit();
                        }
                    } else {
                        header('Location: /adminpages/index.php?action=home&error=solde_insuffisant');
                        exit();
                    }
                } else {
                    header('Location: /adminpages/index.php?action=home&error=compte_introuvable');
                    exit();
                }
            } else {
                header('Location: /adminpages/index.php?action=home&error=donnees_transfert_invalides');
                exit();
            }
        } else {
            header('Location: /adminpages/index.php?action=home');
            exit();
        }
    }
}