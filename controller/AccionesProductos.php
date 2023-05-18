<?php

require_once 'models/productos.php';
require_once 'DAO/DAOProductos.php';
require_once 'controller/AccionesImagen.php';

class AccionesProductos{
    public $DAOProductos;
    public $obj;

    public function __construct() {
        $this->DAOProductos = new DAOProductos();
        $this->obj = new Productos();
    }

    public function loadModel(){

    }

    public function consultarProductosCategoria(){
        $idCategoria = $_GET['categoria'];
        $tabla = $this->obj->getNomTabla();
        $query = $this->DAOProductos->connect()->prepare("SELECT * FROM $tabla WHERE categoria = ?");
        $query->execute([$idCategoria]);
        $this->generarTabla($query);
    }

    public function generarTabla($response){
        $imagen = new AccionesImagen();
        $htmlResultados = "";

        while ($result = $response->fetch(PDO::FETCH_ASSOC)) {  
            $id = $result['id'];
            $nombre_producto = $result['nombre_producto'];
            $descripcion_prod = $result['marca_producto'];
            $precio = $result['precio'];
            $img = $imagen->consultaImagenProducto($id);
          if (!file_exists($img)) {
              $img = "img/nodisponible.jpg";
          }
          
            $htmlResultados .= "<li>
                                  <img src='$img' alt='Producto 1'>
                                  <h2>$nombre_producto</h2>
                                  <p>$descripcion_prod</p>
                                  <span class='precio'>$" . number_format($precio, 2, ',', '.') . "</span>
                                  <a href='#' class='comprar'>Comprar</a>
                                  <button id='detalles-btn' class='detalles-btn' data-id='$id'>Detalles</button>
                                </li>";
          }

          echo $htmlResultados;
    }

}

?>