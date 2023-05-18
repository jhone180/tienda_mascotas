<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require 'views/header.php'; ?>
    <div id="main">
        <h1 class="center">Registrar un nuevo producto</h1>
        <form action="<?php echo constant('URL') ?>registrarProducto/registrar" method="POST" enctype="multipart/form-data">

            <p>
                <label for="nombreProducto">Nombre Producto</label> <br>
                <input type="text" name="nombreProducto" id="" require>
            </p>
            <p>
                <label for="marcaProducto">Marca del Producto</label> <br>
                <input type="text" name="marcaProducto" id="" require>
            </p>
            <p>
                <label for="precio">Precio</label> <br>
                <input type="number" name="precio"  require>
            </p>
            <p>
                <label for="descuento">Descuento</label> <br>
                <input type="number" name="descuento" pattern="[0-9]+([,\.][0-9]{1,2})?" step="0.01" require>
            </p>
            <p>
                <label for="cantidad">Cantidad</label> <br>
                <input type="text" name="cantidad" id="" require>
            </p>
            <p>
                <label for="categoria">Categoria</label> <br>
                <select name="categoria" id="categoria">
                    <?php 
                        require_once 'controller/AccionesCategorias.php';
                        $categorias = new AccionesCategorias();
                        $categorias->mostrarCategorias();
                    ?>
                </select>
            </p>
            <p>
            <label for="imagen">Imagen/Imagenes:</label>
			<input type="file" name="imagen[]" id="imagen" accept="image/*" multiple required>
            </p>
            <p>
                <input type="submit" value="Registrar Producto">
            </p>

        </form>
    </div>
    <?php require 'views/footer.php'; ?>
</body>
</html>