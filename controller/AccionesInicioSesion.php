<?php

require_once 'DAO/DAOUsuarios.php';

class AccionesInicioSesion{

    protected $DAOUsuarios;

    public function __construct(){
        $this->DAOUsuarios = new DAOUsuarios();
    }

    function loadModel(){

    }

    function validarUsuario(){
        $obj = $this->DAOUsuarios->mapeoDatos($_POST);
        $response = $this->DAOUsuarios->consultarUsuario($obj);
        $this->respuesta($response);
    }

    function respuesta($response){
        echo $response;
    }

    function cerrarSesion(){
        session_destroy();
        setcookie(session_name(), '', time() - 3600, '/');
        $this->respuestaCerrarSesion();
    }

    function respuestaCerrarSesion(){
        echo '<script>';
        echo 'alert("Se ha cerrado la sesión correctamente.");
              window.location.replace("' . constant('URL') . 'main")';
        echo '</script>';
    }
}

?>