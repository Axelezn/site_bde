<?php

require_once __DIR__ . '/../models/Account.php';
require_once __DIR__ . '/../models/Transaction.php';

class ComptabiliteController
{
    private $accountModel;
    private $transactionModel;

    public function __construct()
    {
        $this->accountModel = new Account();
        $this->transactionModel = new Transaction();
    }

    public function afficherListeComptes()
    {
        $comptes = $this->accountModel->getAllAccounts();
        require __DIR__ . '/../views/home.php';
    }

    public function gererComptes()
    {
        $comptes = $this->accountModel->getAllAccounts();
        require __DIR__ . '/../views/comptabilite/gestion_comptes.php';
    }

    public function ajouterCompte()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'] ?? null,
                'description' => $_POST['description'] ?? null,
                'RIB' => $_POST['RIB'] ?? null,
            ];

            if ($data['nom']) {
                if ($this->accountModel->addAccount($data)) {
                    header('Location: /adminpages/index.php?action=gerer_comptes&success=compte_ajoute');
                    exit();
                } else {
                    $error = "Erreur lors de l'ajout du compte.";
                    require __DIR__ . '/../views/comptabilite/ajouter_compte.php';
                }
            } else {
                $error = "Le nom du compte est obligatoire.";
                require __DIR__ . '/../views/comptabilite/ajouter_compte.php';
            }
        } else {
            require __DIR__ . '/../views/comptabilite/ajouter_compte.php';
        }
    }

    public function modifierCompte($id)
    {
        $compte = $this->accountModel->getAccountById($id);
        if (!$compte) {
            header('Location: ../index.php?action=gerer_comptes&error=compte_introuvable');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'] ?? null,
                'description' => $_POST['description'] ?? null,
                'RIB' => $_POST['RIB'] ?? null,
            ];

            if ($data['nom']) {
                if ($this->accountModel->updateAccount($id, $data)) {
                    header('Location: /adminpages/index.php?action=gerer_comptes&success=compte_modifie');
                    exit();
                } else {
                    $error = "Erreur lors de la modification du compte.";
                    require __DIR__ . '/../views/comptabilite/modifier_compte.php';
                }
            } else {
                $error = "Le nom du compte est obligatoire.";
                require __DIR__ . '/../views/comptabilite/modifier_compte.php';
            }
        } else {
            require __DIR__ . '/../views/comptabilite/modifier_compte.php';
        }
    }

    public function supprimerCompte($id)
    {
        if ($this->accountModel->deleteAccount($id)) {
            header('Location: /adminpages/index.php?action=gerer_comptes&success=compte_modifie');
            exit();
        } else {
            header('Location: /adminpages/index.php?action=gerer_comptes&error=erreur_suppression_compte');
            exit();
        }
    }

    // Autres méthodes pour gérer les transactions, les transferts, etc. pourront être ajoutées ici
}