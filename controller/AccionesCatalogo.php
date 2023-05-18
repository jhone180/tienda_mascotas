<?php

require_once 'DAO/DAOCategorias.php';
require_once 'models/categorias.php';

class AccionesCatalogo{

    public $DAOCategorias;
    public $obj;

    public function __construct(){
        $this->DAOCategorias = new DAOCategorias();
        $this->obj = new Categorias();
    }

    public function consultaCategorias(){
        $tabla = $this->obj->getNomTabla();
        $response = $this->DAOCategorias->consultarAll($tabla);
        return $response;
    }
}

?>