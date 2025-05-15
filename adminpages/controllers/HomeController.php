<?php

require_once __DIR__ . '/../models/Account.php';

class HomeController
{
    private $accountModel;

    public function __construct()
    {
        $this->accountModel = new Account();
    }

    public function index()
    {
        $comptes = $this->accountModel->getAllAccounts();
        $dernieresTransactions = $this->accountModel->getDernieresTransactions();
        require __DIR__ . '/../views/home.php';
        
    }
}