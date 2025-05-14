<?php 

abstract class BaseController
{
    protected $templatrDir = __DIR__ . '../views/';

    // Fonction de render pour 1 paramètre
    public function render($view, $data = array()) {
        
        extract($data);

        require_once($this->templatrDir . $view . '.php');
        require_once($this->templatrDir . 'template.php');
    }
}