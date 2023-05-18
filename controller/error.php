<?php

class Errores extends Controller{

    public $mensaje;

    function __construct(){
        parent::__construct();
        $this->view->mensaje = "Hubo un error en la solicitud o no existe la página.";
        $this->view->render('error/index');
        //echo "<p>Error al cargar recurso</p>";
    }
}

?>