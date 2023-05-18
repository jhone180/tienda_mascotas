<?php

require_once 'DAOGeneral.php';
require_once 'models/productos.php';
require_once 'controller/response.php';
require_once 'DAOImagen.php';
require_once 'models/imagen.php';

class DAOProductos extends DAOGeneral{
    
    public function insertar(IModel $obj){
        if($obj instanceof Productos){
            $response = parent::insertar($obj);
            $this->insertarImagenes($obj);
            return $response;
        } else{
            return Response::responseErrorInstancia($obj, $this->_obtenerInstanciaModelo());
        }
    }

    public function actualizar(IModel $obj) {
        if($obj instanceof Productos){
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

    public function insertarImagenes(Productos $obj){
        
        if(isset($_FILES)){
            $imagenes = $_FILES['imagen'];
            for($i = 0; $i < count($imagenes['name']); $i++){
                $nombre = $imagenes['name'][$i];
                $tmp =  $imagenes['tmp_name'][$i];
                $error = $imagenes['error'][$i];
                
                if ($error === UPLOAD_ERR_OK) {
                    $DAOImagenes = new DAOImagen();
                    $objImagen = new Imagen();
                    $destino = 'img/' . $nombre;
                    move_uploaded_file($tmp, $destino);
                    $objImagen->setNombreImagen($nombre);
                    $objImagen->setRutaImagen($destino);
                    $objImagen->setIdProducto($obj->getId());
                    $DAOImagenes->insertar($objImagen);
                }
                
            }
        }
    }


    public function mapeoDatos(array $data){
        $obj = $this->_obtenerInstanciaModelo();
        $id = $this->obtenerIdMax();
        $obj->setId($id);
        if(isset($data['id'])){
            $obj->setId($data['id']);
        }
        $obj->setNombreProducto($data['nombreProducto']);
        $obj->setMarcaProducto($data['marcaProducto']);
        $obj->setPrecio($data['precio']);
        $obj->setDescuento($data['descuento']);
        $obj->setCantidad($data['cantidad']);
        $obj->setCategoria($data['categoria']);
        return $obj;
    }

    public function obtenerIdMax(){
        $query = $this->connect()->prepare('SELECT (MAX(id) + 1) as id FROM productos');
        $query->execute();
        $id = $query->fetch();
        return $id['id'];
    }

    protected function _obtenerInstanciaModelo(){
        return new Productos();
    }
}

?>