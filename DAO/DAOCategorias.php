<?php

require_once 'DAOGeneral.php';
require_once 'models/categorias.php';
require_once 'controller/response.php';

class DAOCategorias extends DAOGeneral{
    
    public function insertar(IModel $obj){
        if($obj instanceof Categorias){
            return parent::insertar($obj);
        } else{
            return Response::responseErrorInstancia($obj, $this->_obtenerInstanciaModelo());
        }
    }

    public function actualizar(IModel $obj) {
        if($obj instanceof Categorias){
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

    public function consultarAll($tabla){
        $response = parent::consultarAll($tabla);
        return $response;
    }

    public function mapeoDatos(array $data){
        $obj = $this->_obtenerInstanciaModelo();
        $obj->setId($data['id']);
        $obj->setNombreCategoria($data['nombre_categoria']);
        $obj->setCategoriaActiva($data['categoria_activa']);
        return $obj;
    }

    protected function _obtenerInstanciaModelo(){
        return new Categorias();
    }
}

?>