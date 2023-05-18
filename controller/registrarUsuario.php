<?php

require_once 'DAO/DAOUsuarios.php';

class RegistrarUsuario extends Controller{

    private $DAOUsuarios;

    function __construct(){
        parent::__construct();
        $this->DAOUsuarios = new DAOUsuarios();
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
            $this->view->render('registrarUsuario/index');
        }
    }

    function validarUsuario(){
        $this->validacionesCampos($_POST);
        $obj = $this->DAOUsuarios->mapeoDatosRegistro($_POST);
        $response = $this->DAOUsuarios->insertar($obj);
        $this->respuesta($response);
    }

    function validacionesCampos($form){
        if(empty($form)){
            $msg = "Debe llenar todos los campos.";
            $respuesta = Response::responseErrorGeneral($msg);
            $this->respuesta($respuesta);
            exit();
        } else {
            $this->validacionUsuarioExistente($form['nombreUsuario']);
            $this->validacionContrasenas($form['contrasena'], $form['contrasena2']);
        }
    }

    function validacionUsuarioExistente($usuario){
        $response = $this->DAOUsuarios->validarUsuario($usuario);
        if(!empty($response)){
            $this->respuesta($response);
            exit();
        }
    }

    function validacionContrasenas($contrasena, $contrasena2){
        if($contrasena != $contrasena2){
            $msg = "Las contraseñas no coinciden.";
            $response = Response::responseErrorGeneral($msg);
            $this->respuesta($response);
            exit();
        }
    }

    function respuesta($response){
        echo $response;
    }
    
}

?>