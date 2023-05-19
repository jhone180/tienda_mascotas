<?php

require_once 'DAO/DAOImagen.php';
require_once 'models/imagen.php';

class AccionesImagen{
    public $DAOImagen;
    public $obj;

    public function __construct() {
        $this->DAOImagen = new DAOImagen();
        $this->obj = new Imagen();
    }

    public function consultaImagenProducto($idProducto){
        $tabla = $this->obj->getNomTabla();
        $query = $this->DAOImagen->connect()->prepare("SELECT ruta_imagen FROM $tabla WHERE id_producto = ?");
        $query->execute([$idProducto]);
        $response = $query->fetch();
        return $response['ruta_imagen'];
    }

    public function consultaImagenesProducto($idProducto){
        $tabla = $this->obj->getNomTabla();
        $query = $this->DAOImagen->connect()->prepare("SELECT ruta_imagen FROM $tabla WHERE id_producto = ?");
        $query->execute([$idProducto]);
        $response = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($response as $res){
            $imagenes[] = $res['ruta_imagen'];

        }
        return $imagenes;
    }
}

?>