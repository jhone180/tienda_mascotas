<?php

require_once 'models/productos.php';
require_once 'DAO/DAOProductos.php';
require_once 'controller/AccionesImagen.php';

class AccionesProductos{
    public $DAOProductos;
    public $AccionesImagen;
    public $obj;
    public $idProducto;
    public $nombreProducto;
    public $precio;
    public $descripcion;
    public $porcentajeDescuento;
    public $descuento;

    public function __construct() {
        $this->DAOProductos = new DAOProductos();
        $this->AccionesImagen = new AccionesImagen();
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

    //Funciones para la pagina de detalles
    function procesarImagenes(){
        $this->idProducto = $_GET['id'];
        if($this->idProducto != null && $this->idProducto != ''){
            $html = $this->procesarSolicitud($this->idProducto);
            echo $html;
        } else {
            $error = "No se especificó un ID de producto válido";
            http_response_code(400);
            echo $error;
            exit();
        }
    }
    
    function procesarSolicitud($idProducto){
        try{
            $resultado = $this->DAOProductos->consultar($idProducto);
            $this->informacionProducto($resultado);
            $html = $this->mostrarDatos($resultado);
            return $html;
        } catch(Exception $e){
            echo "Ha ocurrido un error: " . $e->getMessage();
        }
    }
    
    function consultarProducto($idProducto, $conectar){
        $consulta = "SELECT id, nombre_producto, marca_producto, precio, descuento, cantidad 
                     FROM productos 
                     WHERE id = $idProducto";
        $respuesta = mysqli_query($conectar, $consulta);
        $resultado = mysqli_fetch_assoc($respuesta);
        return $resultado;
    }
    
    function mostrarDatos($resultado){
        $idProducto = $resultado['id'];
        $imagenes = $this->consultarImagenes($idProducto);
        $html = $this->carruselImagenes($imagenes, $this->nombreProducto);
        return $html;
    }
    
    function consultarImagenes($idProducto){
        $imagenes = $this->AccionesImagen->consultaImagenesProducto($idProducto);
        return $imagenes;
    }
    
    function carruselImagenes($imagenes, $nombreProducto){
        $html = '';
        foreach($imagenes as $img){
            $html .= '<div class="carousel-item active">
                        <img src="' . $img . '" alt="' . $nombreProducto . '">
                      </div>';
        }
        return $html;
    }
    
    function informacionProducto($resultado){
        $this->nombreProducto = $resultado['nombre_producto'];
        $this->precio = $resultado['precio'];
        $this->porcentajeDescuento = $resultado['descuento'];
        $this->descripcion = $resultado['marca_producto'];
        $this->validarDescuento($this->precio, $this->porcentajeDescuento);
    }

    function validarDescuento($precio, $porcentajeDescuento){
        if($porcentajeDescuento != 0){
            $this->descuento = $precio * (1 - ($porcentajeDescuento / 100));
        }
    }

    function imprimirDescuento(){
        if($this->porcentajeDescuento != 0){
            echo "$" . number_format($this->descuento, 2 , ',', '.');
        } else {
            echo "$" . number_format($this->precio, 2 , ',', '.');
        }
    }

    function imprimirPrecioAntesDescuento(){
        if($this->porcentajeDescuento != 0){
            echo "$" . number_format($this->precio, 2 , ',', '.');
        } else {
            echo "";
        }
    }

}

?>