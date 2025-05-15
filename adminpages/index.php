<?php
session_start();
$action = $_GET['action'] ?? 'home';

require_once __DIR__.'/controllers/UsersController.php';
require_once __DIR__.'/controllers/ComptabiliteController.php';
require_once __DIR__.'/controllers/HomeController.php';
require_once __DIR__.'/controllers/TransactionController.php'; // Inclure le nouveau contrôleur

$userController = new UsersController();
$comptabiliteController = new ComptabiliteController();
$homeController = new HomeController();
$transactionController = new TransactionController(); // Instancier le nouveau contrôleur

switch ($action) {
    case 'signup':
        $userController->signup();
        break;
    case 'signin':
        $userController->signin();
        break;
    case 'logout':
        session_unset();
        session_destroy();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        header('Location: /index.html');
        exit();
        break;
    case 'home':
        $homeController->index();
        break;
    case 'gerer_comptes':
        $comptabiliteController->gererComptes();
        break;
    case 'ajouter_compte':
        $comptabiliteController->ajouterCompte();
        break;
    case 'modifier_compte':
        $id = $_GET['id'] ?? null;
        $comptabiliteController->modifierCompte($id);
        break;
    case 'supprimer_compte':
        $id = $_GET['id'] ?? null;
        $comptabiliteController->supprimerCompte($id);
        break;
    case 'afficher_formulaire_credit':
        $transactionController->afficherFormulaireCredit(); // Utiliser le nouveau contrôleur
        break;
    case 'crediter_compte':
        $transactionController->crediterCompte(); // Utiliser le nouveau contrôleur
        break;
    case 'afficher_formulaire_debit': // Ajout de la nouvelle action
        $transactionController->afficherFormulaireDebit();
        break;
    case 'debiter_compte': // Nous créerons cette action dans le contrôleur
        $transactionController->debiterCompte();
        break;
    case 'afficher_formulaire_transfert':
        $transactionController->afficherFormulaireTransfert();
        break;
    case 'effectuer_transfert':
        $transactionController->effectuerTransfert();
        break;
    default:
        http_response_code(404);
        echo 'Page non trouvée';
        break;
}

if (!isset($_SESSION['user']) && $action !== 'signin' && $action !== 'signup') {
    header('Location: /adminpages/index.php?action=signin');
    exit();
}