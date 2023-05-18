<?php

class detallesProductos extends Controller{

    public $idProducto;
    public $nombreProducto;
    public $precio;
    public $descripcion;
    public $porcentajeDescuento;
    public $descuento;

    public function __construct(){
        parent::__construct();
        $this->view->render('detalles/index');
    }

    function procesarImagenes($conectar){
        $this->idProducto = $_GET['id'];
        if($this->idProducto != null && $this->idProducto != ''){
            $html = $this->procesarSolicitud($this->idProducto, $conectar);
            echo $html;
        } else {
            $error = "No se especificó un ID de producto válido";
            http_response_code(400);
            echo $error;
            exit();
        }
    }
    
    function procesarSolicitud($idProducto, $conectar){
        try{
            $resultado = $this->consultarProducto($idProducto, $conectar);
            $this->informacionProducto($resultado);
            $html = $this->mostrarDatos($resultado, $conectar);
            return $html;
        } catch(Exception $e){
            throw "Ha ocurrido un error: " . $e->getMessage();
        }
    }
    
    function consultarProducto($idProducto, $conectar){
        $consulta = "SELECT id_producto, nombre_producto, descrip_prod, precio_prod, desc_prod, cantidad 
                     FROM productos 
                     WHERE id_producto = $idProducto";
        $respuesta = mysqli_query($conectar, $consulta);
        $resultado = mysqli_fetch_assoc($respuesta);
        return $resultado;
    }
    
    function mostrarDatos($resultado, $conectar){
        $idProducto = $resultado['id_producto'];
        $imagenes = $this->consultarImagenes($idProducto, $conectar);
        $html = $this->carruselImagenes($imagenes, $this->nombreProducto);
        return $html;
    }
    
    function consultarImagenes($idProducto, $conectar){
        $consulta = "SELECT des_imagen
                     FROM imagenes
                     WHERE id_producto = $idProducto";
        $respuesta = mysqli_query($conectar, $consulta);
        while($res = $respuesta->fetch_assoc()){
            $imagenes[] = $res['des_imagen'];
        }
        return $imagenes;
    }
    
    function carruselImagenes($imagenes, $nombreProducto){
        $html = '';
        foreach($imagenes as $img){
            $html .= '<div class="item">
                        <img src="img/' . $img . '" alt="' . $nombreProducto . '">
                      </div>';
        }
        return $html;
    }
    
    function informacionProducto($resultado){
        $this->nombreProducto = $resultado['nombre_producto'];
        $this->precio = $resultado['precio_prod'];
        $this->porcentajeDescuento = $resultado['desc_prod'];
        $this->descripcion = $resultado['descrip_prod'];
        $this->validarDescuento($this->precio, $this->porcentajeDescuento);
    }

    function validarDescuento($precio, $porcentajeDescuento){
        if($porcentajeDescuento != 0){
            $this->descuento = $precio * (1 - ($porcentajeDescuento / 100));
            print_r($this->descuento . "Es");
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