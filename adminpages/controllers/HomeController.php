<?php

require_once __DIR__ . '/../models/Account.php';
require_once __DIR__ . '/../models/User.php'; // Utilise ton modèle User existant

class HomeController
{
    private $accountModel;
    private $userModel; // Utilise ton modèle User existant

    public function __construct()
    {
        $this->accountModel = new Account();
        $this->userModel = new User(); // Instanciation de ton modèle User existant
    }

    public function index()
    {
        $comptes = $this->accountModel->getAllAccounts();
        $dernieresTransactions = $this->accountModel->getDernieresTransactions();
        require __DIR__ . '/../views/home.php';
    }

    public function afficherListeBdeUtilisateurs() // Garde le nom de l'action pour la cohérence
    {
        $bdeUtilisateurs = $this->userModel->getAllUsers(); // Utilise la méthode de ton modèle User
        require __DIR__ . '/../views/bde_users/liste.php';
    }

    public function afficherFormulaireModificationBdeUtilisateur($id) // Garde le nom de l'action
    {
        $bdeUtilisateur = $this->userModel->getUserById($id); // Utilise la méthode de ton modèle User
        if ($bdeUtilisateur) {
            require __DIR__ . '/../views/bde_users/modifier.php';
        } else {
            header('Location: /adminpages/index.php?action=gestion_bde_utilisateurs&error=utilisateur_introuvable');
            exit();
        }
    }

    public function modifierBdeUtilisateur($id) // Garde le nom de l'action
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'] ?? ''; // Le login sera l'email
            $nouveauMdp = $_POST['nouveau_mdp'] ?? '';
            $prenom = $_POST['prenom'] ?? ''; // Récupère le prénom pour la mise à jour

            if (!empty($login)) {
                $hashedNouveauMdp = !empty($nouveauMdp) ? password_hash($nouveauMdp, PASSWORD_DEFAULT) : null;
                if ($this->userModel->updateUser($id, null, $prenom, $login, $hashedNouveauMdp)) { // Inclut le prénom dans la mise à jour
                    header('Location: /adminpages/index.php?action=gestion_bde_utilisateurs&success=utilisateur_modifie');
                    exit();
                } else {
                    $error = "Erreur lors de la modification de l'utilisateur.";
                    $bdeUtilisateur = $this->userModel->getUserById($id);
                    require __DIR__ . '/../views/bde_users/modifier.php';
                }
            } else {
                $error = "L'email ne peut pas être vide.";
                $bdeUtilisateur = $this->userModel->getUserById($id);
                require __DIR__ . '/../views/bde_users/modifier.php';
            }
        } else {
            header('Location: /adminpages/index.php?action=gestion_bde_utilisateurs&error=methode_non_autorisee');
            exit();
        }
    }

    public function supprimerBdeUtilisateur($id) // Garde le nom de l'action
    {
        if ($this->userModel->deleteUser($id)) {
            header('Location: /adminpages/index.php?action=gestion_bde_utilisateurs&success=utilisateur_supprime');
            exit();
        } else {
            header('Location: /adminpages/index.php?action=gestion_bde_utilisateurs&error=erreur_suppression_utilisateur');
            exit();
        }
    }
    public function afficherFormulaireCreationUtilisateurAdmin()
    {
        require __DIR__ . '/../views/bde_users/creer.php';
    }

    public function creerUtilisateurAdmin()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $prenom = $_POST['prenom'] ?? '';
        $email = $_POST['email'] ?? '';
        $mdp = $_POST['mdp'] ?? '';

        error_log("Tentative de création d'utilisateur avec prenom: " . $prenom . ", email: " . $email);

        // Validation des données (à adapter selon tes besoins)
        if (!empty($prenom) && !empty($email) && !empty($mdp) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $hashedMdp = password_hash($mdp, PASSWORD_DEFAULT);
            if ($this->userModel->createUser($prenom, $email, $hashedMdp)) {
                header('Location: /adminpages/index.php?action=gestion_bde_utilisateurs&success=utilisateur_cree');
                exit();
            } else {
                $error = "Erreur lors de la création de l'utilisateur.";
                require __DIR__ . '/../views/bde_users/creer.php';
            }
        } else {
            $error = "Veuillez remplir tous les champs correctement.";
            require __DIR__ . '/../views/bde_users/creer.php';
        }
    } else {
        // Si la requête n'est pas POST, redirige ou affiche une erreur
        header('Location: /adminpages/index.php?action=gestion_bde_utilisateurs&error=methode_non_autorisee');
        exit();
    }
}
}