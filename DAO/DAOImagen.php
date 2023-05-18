<?php

require_once 'DAOGeneral.php';
require_once 'models/imagen.php';
require_once 'controller/response.php';

class DAOImagen extends DAOGeneral{
    
    public function insertar(IModel $obj){
        if($obj instanceof Imagen){
            return parent::insertar($obj);
        } else{
            return Response::responseErrorInstancia($obj, $this->_obtenerInstanciaModelo());
        }
    }

    public function actualizar(IModel $obj) {
        if($obj instanceof Imagen){
            return parent::actualizar($obj);
        } else {
            return Response::responseErrorInstancia($obj, $this->_obtenerInstanciaModelo());
        }
    }

    public function consultar($id) {
        if(!empty($id)){
            return parent::consultar($id);
        } else {
            return Response::responseErrorLlave();
        }
    }

    public function eliminar($id) {
        if(!empty($id)){
            return parent::eliminar($id);
        } else {
            return Response::responseErrorLlave();
        }
    }

    public function mapeoDatos(array $data){
        $obj = $this->_obtenerInstanciaModelo();
        $obj->setId($data['id']);
        $obj->setNombreImagen($data['name']);
        $obj->setRutaImagen($data['marcaProducto']);
        $obj->setIdProducto($data['cantidad']);
        return $obj;
    }

    protected function _obtenerInstanciaModelo(){
        return new Imagen();
    }
}

?>