<?php

require_once 'IModel.php';

class Productos implements IModel{
    public $id;

    public $nombre_producto;

    public $marca_producto;

    public $precio;

    public $descuento;

    public $cantidad;

    public $categoria;

    protected $_nomTabla = "productos";

    protected $_primaryKey = "id";

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNombreProducto(){
        return $this->nombre_producto;
    }

    public function setNombreProducto($nombreProducto){
        $this->nombre_producto = $nombreProducto;
    }

    public function getMarcaProducto(){
        return $this->marca_producto;
    }

    public function setMarcaProducto($marcaProducto){
        $this->marca_producto = $marcaProducto;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function setPrecio($precio){
        $this->precio = $precio;
    }

    public function getDescuento(){
        return $this->descuento;
    }

    public function setDescuento($descuento){
        $this->descuento = $descuento;
    }

    public function getCantidad(){
        return $this->cantidad;
    }

    public function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }

    public function getCategoria(){
        return $this->categoria;
    }

    public function setCategoria($categoria){
        $this->categoria = $categoria;
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