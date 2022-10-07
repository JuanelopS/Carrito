<?php
  session_start();
  include_once './connect.php';

  if(isset($_GET['id']))
  {
    $item_id = $_GET['id'];

    // consulta para rellenar los campos del formulario con los valores anteriores

    $sql_verify_query = "SELECT * FROM items WHERE id=$item_id";
    try {

      $sql_verify = $pdoConnection->prepare($sql_verify_query);
      $sql_verify->execute();
      $result_verify = $sql_verify->fetch(PDO::FETCH_ASSOC);

      // foreach ($result_verify as $key => $value) {
      //   echo $value['nombre'];
      // }

    } catch (Exception $err){
      print 'Error!: ' . $err->getMessage() . '<br>';
      die();
      }
  }
    
  // si se ha enviado un formulario -> intento de edición de item...
  if ($_POST){

    $nombre = $_POST['nombre_producto'];
    $precio = $_POST['precio_producto'];
    $unidad = $_POST['unidad_producto'];
    $imagen = $_FILES['imagen_producto']['name'];
    
    try{

      $producto_insert = "UPDATE items SET nombre=?, precio=?, unidad=?, imagen=? WHERE id = $item_id";

      $edit_producto = $pdoConnection->prepare($producto_insert);
      $edit_producto->execute(array($nombre, $precio, $unidad, $imagen));

      header("location: ./admin.php");

    } catch (Exception $err){
      print "Error!: " . $err->getMessage() . "<br>";
      die();
    }

    // SUBIDA DE IMAGEN DE PRODUCTO AL SERVIDOR 

    $message = ''; 
      
    if (isset($_FILES['imagen_producto']) && $_FILES['imagen_producto']['error'] === UPLOAD_ERR_OK) {
      
      // detalles del archivo subido

      $fileTmpPath = $_FILES['imagen_producto']['tmp_name'];
      $fileName = $_FILES['imagen_producto']['name'];
      $fileSize = $_FILES['imagen_producto']['size'];
      $fileType = $_FILES['imagen_producto']['type'];
      $fileNameCmps = explode(".", $fileName);
      $fileExtension = strtolower(end($fileNameCmps));

      // depuración del nombre de archivo
      // reset() devuelve el primer valor de un array
      $newFileName = strtolower(reset($fileNameCmps)) . '.' . $fileExtension;

      // mirar si el archivo tiene una de estas extensiones
      $allowedfileExtensions = array('jpg', 'png', 'bmp', 'webp');

      if (in_array($fileExtension, $allowedfileExtensions))
      {
        // directorio al que la imagen del producto será movida (importante la '/' final por $dest_path)
        $uploadFileDir = $_SERVER['DOCUMENT_ROOT'] . '/img/';

        $dest_path = $uploadFileDir . $newFileName;

        // Si el archivo existe, borrarlo
        if(file_exists('$dest_path')) {
            unlink('$dest_path');
        }

        if(move_uploaded_file($fileTmpPath, $dest_path)) 
        {
          $message ='Imagen subida correctamente.';
        }else {
          $message = 'Hubo algún error moviendo la imagen al directorio destino. Asegúrese de que tiene permisos de escritura en el mismo.';
        }
      }
      else{
        $message = 'Tipo de archivo no permitido. La imagen debe tener una de las siguientes extensiones: ' . implode(',', $allowedfileExtensions);
      }
    }
    else{
    $message = 'Hubo un error en la subida de la imagen. Error: <br>';
    $message .= 'Error:' . $_FILES['uploadedFile']['error'];
    }

    $_SESSION['message'] = $message;
  }
        

    // cerrando conexión con la db
    $edit_producto = null;
    $pdoConnection = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Producto</title>
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
        <span class="navbar-brand mb-0 h1"><i class="fa-solid fa-seedling"></i> Carrito de la compra - Editar producto</span>
        <span class="text-right">
          <a href="./admin.php">Volver</a>
        </span>
      </div>
    </nav>
  </header>

  <?php 
    
    // testeo de subida de imagen al formulario
    // if (isset($_SESSION['message']) && $_SESSION['message'])
    // {
    //   printf('<b>%s</b>', $_SESSION['message']);
    //   printf('extension: ', $fileExtension);
    //   unset($_SESSION['message']);
    // }

    // si el usuario es el admin, se muestran los datos
    if(isset($_SESSION['user']) && $_SESSION['user'] == 'admin'){
      echo "
        <main class='container col-11 col-lg-4'>
        <!-- importante vh-100 para centrar verticalmente -->
        <div class='row justify-content-center align-items-center'>
          
          <form class='row col-m-7 col-10' action='./editarProducto.php?id=".$_GET['id']."' method='POST' enctype='multipart/form-data' id='editarProductoForm' >

            <div class='text-center mb-4'>
              <h2>Editar producto</h2>
            </div>

            <div class='mb-2'>
              <label for='nombre_producto' class='form-label'>
                <i class='fa-solid fa-hand-point-right'></i> Nombre
              </label>
              <input type='text' name='nombre_producto' class='form-control' id='nombre_producto' aria-describedby='nombreHelp' autofocus required value=". $result_verify['nombre'] .">
              <div id='nombreHelp' class='form-text'>Introduce nombre del producto</div>
            </div>

            <div class='mb-2'>
              <label for='precio_producto' class='form-label'>
              <i class='fa-solid fa-coins'></i> Precio
              </label>
              <input type='number' step='any' min='0' name='precio_producto' class='form-control' id='precio_producto' aria-describedby='precioHelp' required value=". number_format($result_verify['precio'], 2) .">
              <div id='precioHelp' class='form-text'>Introduce el precio del producto <em>formato(X.XX)</em></div>
            </div>

            <div class='mb-2'>
              <label for='unidad_producto' class='form-label'>
              <i class='fa-solid fa-infinity'></i> Unidad
              </label>
              <select name='unidad_producto' class='form-select' aria-label='Seleccionar tipo de unidad' required> ";
              
              // opción predeterminada en la opción "tipo de unidad" (selected html)
              if($result_verify['unidad'] == 'kilo'){
                echo "
                <option>Selecciona un tipo de unidad</option>
                <option selected value='kilo'>Kilo</option>
                <option value='unidad'>Unidad</option> 
                ";
              } else{
                echo "
                <option selected>Selecciona un tipo de unidad</option>
                <option value='kilo'>Kilo</option>
                <option selected value='unidad'>Unidad</option> 
                ";
              }
              
              echo "
              </select>
              <div id='unidadHelp' class='form-text'>Introduce el tipo de unidad del producto</div>
            </div>

            <div class='mb-3'>
              <label for='imagen_producto' class='form-label'>
                <i class='fa-solid fa-image'></i> Imagen
              </label>
              <input type='file' name='imagen_producto' class='form-control' id='imagen_producto' accept='image/png, image/jpeg' required>
              <div id='imagenHelp' class='form-text'>Introduce una imagen para el producto</div>
            </div>

            <div class='offset-2 col-8 offset-1 btn-group-lg btn-group mt-3' role='group' aria-label='Boton para editar un producto'>
              <button type='submit' class='btn btn-success' id='btnEditProducto'>Editar</button>
              <button type='reset' class='btn btn-danger' id='btnBorrarProducto'>Borrar</button>
            </div>

          </form>
        </div>
        </main>
        ";

    } else echo "
    <div class='col-6 offset-3'>
      <div class='text-center mt-5 alert alert-danger' role='alert'>
        <h2>Acceso limitado al administrador.</h2>
      </div>
    </div>";
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>