<?php

require_once 'DAO/DAOCategorias.php';
require_once 'models/categorias.php';

class AccionesCategorias{

    public $DAOCategorias;

    public $obj;

    public function __construct() {
        $this->DAOCategorias = new DAOCategorias();
        $this->obj = new Categorias();
    }

    public function mostrarCategorias(){
        $tabla = $this->obj->getNomTabla();
        $response = $this->DAOCategorias->consultarAll($tabla);
        $this->imprimirCategorias($response);
    }

    public function imprimirCategorias($response){
        foreach($response as $array => $categoria){
            if($categoria['categoria_activa'] == 1){
                echo '<option value="' . $categoria['id'] . '">' . $categoria['nombre_categoria'] . '</option>';
            }
        }
    }
}

?>