<?php

require_once 'DAO/DAOProductos.php';

class RegistrarProducto extends Controller{

    private $DAOProductos;

    function __construct(){
        parent::__construct();
        $this->view->render('nuevo/index');
        $this->DAOProductos = new DAOProductos();
    }

    function registrar(){
        $obj = $this->DAOProductos->mapeoDatos($_POST);
        $response = $this->DAOProductos->insertar($obj);
        $this->respuesta($response);
        $this->encabezado();
    }

    function respuesta($response){
        echo '<script>';
        echo "
        var objeto = JSON.parse('" . $response . "');
        var mensaje = objeto.message;
        alert(mensaje);";
        echo '</script>';
    }

    function encabezado(){
        header('Location: ' . constant('URL') . 'registrarProducto');
    }
}

?>