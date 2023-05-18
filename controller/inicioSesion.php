<?php

class InicioSesion extends Controller{

    function __construct(){
        if(isset($_SESSION['user_id']) && isset($_SESSION['username'])){
            header('Location: ' . constant('URL') . 'main');
        } else {
            parent::__construct();
            $this->view->render('inicioSesion/index');
        }
    }
}

?>