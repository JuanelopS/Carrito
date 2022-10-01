<?php

  include_once './connect.php';

  if ($_POST){

    $nombre = $_POST['nombre_producto'];
    $precio = $_POST['precio_producto'];
    $unidad = $_POST['unidad_producto'];
    $imagen = $_POST['imagen_producto'];
    
    // comprobacion de que el producto no existe en la base de datos
    $add_producto_query = "SELECT * FROM items WHERE nombre = '$nombre'";

    try{

      $verificar_producto = $pdoConnection->prepare($add_producto_query);
      $verificar_producto->execute(array());

    if($verificar_producto->rowCount() > 0){ 
      $isRepeated = true; 

    } else{

      $isRepeated = false;
      $producto_insert = "INSERT INTO items(nombre, precio, unidad, imagen) VALUES (?,?,?,?)";

      $add_producto = $pdoConnection->prepare($producto_insert);
      $add_producto->execute(array($nombre, $precio, $unidad, $imagen));

      // para que se recargue la página
      header("location: ./admin.php");
    }

    } catch (Exception $err){
      print "Error!: " . $err->getMessage() . "<br>";
      die();
    }

    // cerrando conexión con la db
    $add_producto = null;
    $pdoConnection = null;

  }
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Añadir Producto</title>
  <!-- bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

  <header class="mb-5">
    <nav class="navbar bg-light">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h1"><i class="fa-solid fa-seedling"></i> Carrito de la compra - Añadir producto</span>
        <span class="text-right">
          <a href="./admin.php">Volver</a>
        </span>
      </div>
    </nav>
  </header>

  <main class="container col-11 col-lg-4">
    <!-- importante vh-100 para centrar verticalmente -->
    <div class="row justify-content-center align-items-center">
      
      <form class="row col-m-7 col-10" action="./addProducto.php" method="POST" id="addProductoForm">

        <div class="text-center mb-4">
          <h2>Añadir producto</h2>
        </div>

        <!-- aviso de error en registro de producto ya existente -->
        <?php
          if(isset($isRepeated) && $isRepeated == true){
            echo " <div class='alert alert-danger' role='alert'>
                  El producto ". $nombre . " ya existe en la base de datos!
              </div>";
          }
        ?>
       
        <div class="mb-2">
          <label for="nombre_producto" class="form-label">
            <i class="fa-solid fa-hand-point-right"></i> Nombre
          </label>
          <input type="text" name="nombre_producto" class="form-control" id="nombre_producto" aria-describedby="nombreHelp" autofocus required>
          <div id="nombreHelp" class="form-text">Introduce nombre del producto</div>
        </div>

        <div class="mb-2">
          <label for="precio_producto" class="form-label">
          <i class="fa-solid fa-coins"></i> Precio
          </label>
          <input type="number" step="any" min="0" name="precio_producto" class="form-control" id="precio_producto" aria-describedby="precioHelp" required>
          <div id="precioHelp" class="form-text">Introduce el precio del producto <em>formato(X.XX)</em></div>
        </div>

        <div class="mb-2">
          <label for="unidad_producto" class="form-label">
          <i class="fa-solid fa-infinity"></i> Unidad
          </label>
          <select name="unidad_producto" class="form-select" aria-label="Seleccionar tipo de unidad" required>
            <option selected>Selecciona un tipo de unidad</option>
            <option value="kilo">Kilo</option>
            <option value="unidad">Unidad</option>
          </select>
          <div id="unidadHelp" class="form-text">Introduce el tipo de unidad del producto</div>
        </div>

        <div class="mb-3">
          <label for="imagen_producto" class="form-label">
            <i class="fa-solid fa-image"></i> Imagen
          </label>
          <input type="file" name="imagen_producto" class="form-control" id="imagen_producto" accept="image/png, image/jpeg" required>
          <div id="imagenHelp" class="form-text">Introduce una imagen para el producto</div>
        </div>

        <div class="offset-2 col-8 offset-1 btn-group-lg btn-group mt-3" role="group" aria-label="Boton para crear un nuevo usuario">
          <button type="submit" class="btn btn-success" id="btnAddProducto">Aceptar</button>
          <button type="reset" class="btn btn-danger" id="btnBorrarProducto">Borrar</button>
        </div>

      </form>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>