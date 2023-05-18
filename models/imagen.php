<?php

require_once 'IModel.php';

class Imagen implements IModel{
    public $id;

    public $nombre_imagen;

    public $ruta_imagen;

    public $id_producto;

    protected $_nomTabla = "imagen";

    protected $_primaryKey = "id";

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNOmbreImagen(){
        return $this->nombre_imagen;
    }

    public function setNombreImagen($nombreImagen){
        $this->nombre_imagen = $nombreImagen;
    }

    public function getRutaImagen(){
        return $this->ruta_imagen;
    }

    public function setRutaImagen($rutaImagen){
        $this->ruta_imagen = $rutaImagen;
    }

    public function getIdProducto(){
        return $this->id_producto;
    }

    public function setIdProducto($idProducto){
        $this->id_producto = $idProducto;
    }

    public function getModel(){
        return new Productos();
    }

    public function getNomTabla() {
        return $this->_nomTabla;
    }

    public function getPrimaryKey(){
        return $this->_primaryKey;
    }

}

?>