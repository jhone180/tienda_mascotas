<?php

require_once 'IModel.php';

class Categorias implements IModel{
    public $id;

    public $nombre_categoria;

    public $categoria_activa;

    protected $_nomTabla = "categorias";

    protected $_primaryKey = "id";

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNombreCategoria(){
        return $this->nombre_categoria;
    }

    public function setNombreCategoria($nombreCategoria){
        $this->nombre_categoria = $nombreCategoria;
    }

    public function getCategoriaActiva(){
        return $this->categoria_activa;
    }

    public function setCategoriaActiva($categoriaActiva){
        $this->categoria_activa = $categoriaActiva;
    }

    public function getModel(){
        return new Categorias();
    }

    public function getNomTabla() {
        return $this->_nomTabla;
    }

    public function getPrimaryKey(){
        return $this->_primaryKey;
    }

}

?>