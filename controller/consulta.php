<?php

class Consulta extends Controller{
    function __construct(){
        if(isset($_SESSION['user_id']) && isset($_SESSION['username'])){
            parent::__construct();
            $this->view->render('consulta/index');
        } else {
            $msg = "Debe iniciar  primero.";
            $this->respuestaInicio($msg);
        }
    }

    function respuestaInicio($msg) {
        echo '<script>';
        echo 'alert("' . $msg . '"); 
              window.location.replace("' . constant('URL') . 'inicioSesion")';
        echo '</script>';
    }
    
}

?>