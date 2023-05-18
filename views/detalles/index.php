<?php 
include_once 'controller/detallesProductos.php';

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Catálogo de productos</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>
  <body>
    <?php require 'views/header.php'; ?>
    <header>
      <nav>
        <ul>
          <li><a href="#">Inicio</a></li>
          <li><a href="catalogo.php">Catalogo</a></li>
          <li><a href="registrar.php">Registrar Producto</a></li>
        </ul>
      </nav>
      <div class="carrito">
          <a href="carrito.php" class="btn btn-primary">Carrito</a>
      </div>
    </header>
    <main>
        <div class="carousel">
            <?php 
            $detallesProducto->procesarImagenes($conectar); ?>
        </div>
        <div class="container">
  <div class="row">
    <div class="col-md-6">
      <h2><?php echo $detallesProducto->nombreProducto ?></h2>
      <p class="precio-general"><?php $detallesProducto->imprimirDescuento() ?><span class="descuento"><?php $detallesProducto->imprimirPrecioAntesDescuento() ?></span></p>
      <p class="precio-descuento"><?php if($detallesProducto->descuento != 0) { echo "Con un descuento del " . $detallesProducto->porcentajeDescuento . "%"; } else { echo ""; } ?></p>
      <p><?php echo $detallesProducto->descripcion ?></p>
      <button class="btn btn-primary" onclick="agregarRegistroCarrito(<?php echo $detallesProducto->idProducto ?>)">Agregar al carrito</button>
      <a href="#" class="btn btn-success">Comprar</a>
    </div>
  </div>
</div>
<?php require 'views/footer.php'; ?>

    </main>      
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script src="js/detalles.js"></script>
  </body>
</html>
