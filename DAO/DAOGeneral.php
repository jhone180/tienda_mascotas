<?php

require_once 'IDataBase.php';
require_once 'libs/database.php';
require_once 'controller/response.php';

abstract class DAOGeneral extends DataBase implements IDataBase{


    protected $_columnas;

    protected $_valores;

    /**
     * 
     */
    public function insertar(IModel $obj){
        $this->validarObjeto($obj);
        $respuesta = $this->insertarValores($obj);
        return $respuesta;
    }

    /**
     * 
     */
    public function actualizar(IModel $obj){
        $this->validarObjeto($obj);
        $respuesta = $this->actualizarValores($obj);
        return $respuesta;
    }

    /**
     * 
     */
    public function consultar($id){
        $respuesta = $this->validarParametroConsulta($id);
        return $respuesta;
    }

    /**
     * 
     */
    public function eliminar($id){
        $respuesta = $this->validarParametroEliminar($id);
        return $respuesta;
    }

    /**
     * 
     */
    public function consultarAll($tabla){
        $query = $this->connect()->prepare("SELECT * FROM $tabla");
        $query->execute();
        $response = $query->fetchAll();
        return $response;
    }

    /**
     * 
     */
    public function validarObjeto(IModel $obj){
        foreach($obj as $key => $valor){
            if(!empty($valor)){
                $this->_columnas[] = $key;
                $this->_valores[] = $valor;
            }
        }
    }

    /**
     * 
     */
    public function insertarValores(IModel $obj) {
        $tabla = $obj->getNomTabla();
        $columnasString = implode(', ', $this->_columnas);
        $valoresString = implode(', ', array_fill(0, count($this->_valores), '?'));
        $query = $this->connect()->prepare("INSERT INTO $tabla ($columnasString) VALUES ($valoresString)");
        if ($query->execute($this->_valores)) {
            $respuesta = Response::responseRegistrar();
        }
        return $respuesta;
    }
    

    /**
     * 
     */
    public function actualizarValores(IModel $obj) {
        $tabla = $obj->getNomTabla();
        $id = $obj->getId();
        $primaryKey = $obj->getPrimaryKey();
        $columnasString = implode(' = ?, ', $this->_columnas) . ' = ?';
    
        $query = $this->connect()->prepare("UPDATE $tabla SET $columnasString WHERE $primaryKey = ?");
        $valores = array_merge($this->_valores, [$id]);
    
        if($query->execute($valores)){
            $respuesta = Response::responseActulizar();
        }
        return $respuesta;
    }

    /**
     * 
     */
    public function validarParametroConsulta($id){
        if(!empty($id)){
            $respuesta = $this->consultarValores($id);
        }
        return $respuesta;
    }

    /**
     * 
     */
    public function consultarValores($id){
        $obj = $this->_obtenerInstanciaModelo();
        $tabla = $obj->getNomTabla();
        $primaryKey = $obj->getPrimaryKey();
        $query = $this->connect()->prepare("SELECT * FROM $tabla WHERE $primaryKey = ?");
        $query->execute([$id]);
        $resultado = $query->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    /**
     * 
     */
    public function validarParametroEliminar($id){
        if(!empty($id)){
            $respuesta = $this->eliminarRegistro($id);
        } else {
            $respuesta = Response::responseErrorLlave();
        }
        return $respuesta;
    }

    /**
     * 
     */
    public function eliminarRegistro($id){
        $obj = $this->_obtenerInstanciaModelo();
        $tabla = $obj->getNomTabla();
        $primaryKey = $obj->getPrimaryKey();
        $query = $this->connect()->prepare("DELETE FROM $tabla WHERE $primaryKey = ?");
        if($query->execute([$id])){
            $respuesta = Response::responseEliminar();
        }
        return $respuesta;
    }

    /**
     * 
     */
    abstract protected function _obtenerInstanciaModelo();
    
    
}

?>