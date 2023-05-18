<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/default.css">
</head>
<body>
    <div id="header">
        <ul>
            <li><a href="<?php echo constant('URL'); ?>main">Inicio</a></li>
            <?php if(isset($_SESSION['user_id']) && isset($_SESSION['username'])){ ?>
            <li><a href="<?php echo constant('URL'); ?>registrarProducto">Registrar</a></li>
            <li><a href="<?php echo constant('URL'); ?>catalogo">Productos</a></li>
            <li><a href="<?php echo constant('URL'); ?>AccionesInicioSesion/cerrarSesion">Cerrar Sesión</a></li>
            <?php } else { ?>
            <li><a href="<?php echo constant('URL'); ?>inicioSesion">Iniciar Sesion</a></li>
            <?php } ?>
        </ul>
    </div>
</body>
</html>