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
        <h1 class="center">Registrar un nuevo usuario</h1>
        <form id="registroForm" method="POST" enctype="multipart/form-data">

            <p>
                <label for="nombreUsuario">Usuario</label> <br>
                <input type="text" name="nombreUsuario" id="" require>
            </p>
            <p>
                <label for="contrasena">Contraseña</label> <br>
                <input type="password" name="contrasena" id="" require>
            </p>
            <p>
                <label for="contrasena2">Confirmar Contraseña</label> <br>
                <input type="password" name="contrasena2" id="" require>
            </p>
            <p>
                <button type="submit" id="Registrar Usuario">Registar Usuario</button>
            </p>

        </form>
    </div>
    <?php require 'views/footer.php'; ?>
    <script>
    // Obtén el formulario y agrega un evento de escucha para el envío
    var formulario = document.getElementById('registroForm');
    formulario.addEventListener('submit', function(event) {
        event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

        // Obtén los datos del formulario
        var datos = new FormData(formulario);

        // Realiza una solicitud AJAX a tu archivo PHP
        var solicitud = new XMLHttpRequest();
        solicitud.open('POST', '<?php echo constant("URL") ?>registrarUsuario/validarUsuario', true);
        solicitud.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        solicitud.onreadystatechange = function() {
            if (solicitud.readyState === 4 && solicitud.status === 200) {
                // Obtén la respuesta JSON
                var respuesta = JSON.parse(solicitud.responseText);
                if(respuesta.success){
                    alert(respuesta.message);
                    window.location.href = '<?php echo constant("URL") ?>inicioSesion';
                } else {
                    alert(respuesta.message);
                }
                
            } 
        };
        solicitud.send(datos);
    });
</script>

</body>
</html>