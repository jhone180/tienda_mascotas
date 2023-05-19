<?php
include_once 'controller/AccionesProductos.php';
$detallesProducto = new AccionesProductos();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Catálogo de productos</title>
  <link rel="stylesheet" href="public/default.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    /* Agrega estilos CSS personalizados aquí */

    .container {
      display: flex;
    }

    .carousel {
      flex: 1;
      max-width: 300px;
      margin-right: 20px;
    }

    .carousel img {
      max-width: 100%;
      height: auto;
    }

    .producto-details {
      flex: 1;
      background-color: #f5f5f5;
      padding: 20px;
      border-radius: 5px;
    }

    .producto-details h2 {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .producto-details p {
      font-size: 16px;
      margin-bottom: 10px;
    }

    .producto-details .precio-general {
      font-size: 24px;
      font-weight: bold;
      color: #d9534f;
      margin-bottom: 10px;
    }

    .producto-details .descuento {
      text-decoration: line-through;
      color: #999;
      margin-left: 10px;
    }

    .producto-details .precio-descuento {
      font-size: 18px;
      font-weight: bold;
      color: #d9534f;
      margin-bottom: 10px;
    }

    .producto-details .btn {
      margin-top: 10px;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }

      .carousel,
      .producto-details {
        margin-right: 0;
      }
    }
  </style>
</head>
<body>
  
  <main>
    <?php require 'views/header.php'; ?>
    <div class="container">
      <div class="carousel">
        <?php 
        $detallesProducto->procesarImagenes();
        ?>
      </div>

      <div class="producto-details">
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
    </div>

  </main>

  <?php require 'views/footer.php'; ?>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
  <script>
    $(document).ready(function(){
      $('.carousel').slick({
        dots: true,
        arrows: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1
      });
    });
  </script>
</body>
</html>
