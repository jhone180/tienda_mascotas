<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Mascotas</title>
</head>
<body>
    <?php require 'views/header.php'; ?>
    <div id="main">
    <form method="GET">
          <label for="categorias"></label>
          <h3 class="productos">Filtrar por categorias</h3>
          <select name="categorias" id="categorias">
          <option value="">Todos los productos</option>
            <?php
              require_once 'controller/AccionesCatalogo.php';
              $catalogo = new AccionesCatalogo();
              $response = $catalogo->consultaCategorias();
              foreach($response as $item_cat){ 
            ?>
            <option value="<?php echo $item_cat['id'] ?>"><?php echo $item_cat['nombre_categoria'] ?></option>
            <?php
              }
            ?>
          </select>
          <button type="submit" id="filtrar-btn">Filtrar</button>
        </form>
        <ul id="productos-list">
        </ul>
        <div id="filtro-resultados">
        </div>
    </div>
    <?php require 'views/footer.php'; ?>
    <script>
          const botonFiltrar = document.getElementById("filtrar-btn");
  const datos = document.getElementById("detalles-producto");
  const urlParams = new URLSearchParams(window.location.search);
  const id = urlParams.get('id');

  botonFiltrar.addEventListener("click", (event) => {
    event.preventDefault();

    const selectCategorias = document.getElementById("categorias");
    const categoriaSeleccionada = selectCategorias.value;
    console.log(categoriaSeleccionada);

    const xhr = new XMLHttpRequest();
    let alertaMostrada = false;

    xhr.onreadystatechange = function () {
      if(this.status === 300  && !alertaMostrada){
        alert('Ha ocurrido un error -> ' + xhr.responseText);
        alertaMostrada = true;
        return;
      }

      if (this.readyState === 4 && this.status === 200) {
        document.getElementById("productos-list").innerHTML = this.responseText;
      }
    };

    xhr.open("GET", "<?php echo constant('URL') ?>" + "AccionesProductos/consultarProductosCategoria?categoria=" + categoriaSeleccionada, true);
    xhr.send();
  });

  document.addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('detalles-btn')) {
      const id = e.target.dataset.id;
      window.location.href = `<?php constant('URL') ?>detallesProductos?id=${id}`;
    }
  });
    </script>
</body>
</html>