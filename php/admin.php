<?php
  session_start();
  include_once './connect.php';

  // query listado de usuarios
  $lista_usuarios_query = 'SELECT * FROM usuarios';

  
  try {
    $lista_usuarios_connect = $pdoConnection->prepare($lista_usuarios_query);
    $lista_usuarios_connect->execute(array());
    $resultados_lista_usuarios = $lista_usuarios_connect->fetchAll(PDO::FETCH_ASSOC);

  } catch (Exception $err){
  print 'Error!: ' . $err->getMessage() . '<br>';
  die();
  }

  // query lista de productos
  $lista_productos_query = 'SELECT * FROM items';

  try {
    $lista_productos_connect = $pdoConnection->prepare($lista_productos_query);
    $lista_productos_connect->execute(array());
    $resultados_lista_productos = $lista_productos_connect->fetchAll(PDO::FETCH_ASSOC);

  } catch (Exception $err){
  print 'Error!: ' . $err->getMessage() . '<br>';
  die();
  }

?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Panel de Administración</title>
  <!-- bootstrap -->
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css'>
   <!-- fontawesome -->
   <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css' integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==' crossorigin='anonymous' referrerpolicy='no-referrer' />
  <link rel='stylesheet' href='../css/admin.css'>
</head>
<body>
  <header class='mb-5'>
      <nav class='navbar bg-light'>
        <div class='container-fluid'>
          <span class='navbar-brand mb-0 h1'><i class='fa-solid fa-seedling'></i> Carrito de la compra - Panel de administración</span>
          <span class='text-right'>
            <a href='../index.php'>Volver</a>
          </span>
        </div>
      </nav>
  </header>
  <main class='container-fluid col-11'>
      <div class='row'>
      <?php 
        // si el usuario es el admin, se muestran los datos
        if(isset($_SESSION['user']) && $_SESSION['user'] == 'admin'){
          echo "
        
          <div class='col-5'>
            <h3 class='text-center mb-4'>Lista de usuarios</h3>
            <table class='table table-striped'>
              <thead>
                <tr>
                  <th scope='col'>#</th>
                  <th scope='col'>Nombre</th>
                  <th scope='col'>Apellido</th>
                  <th scope='col'>Email</th>
                  <th scope='col'>Password</th>
                </tr>
              </thead>
              <tbody>";

              // listado de los usuarios
              // los botones son enlaces mediante los cuales llamaré a una función php (info, editar, borrar) pasándole como parámetro GET el id del usuario

              foreach ($resultados_lista_usuarios as $key => $value) {
                echo
                "
                <tr class='align-middle'>
                  <th scope='row'>" . $value['user_id'] . "</th>
                  <td>" . $value['user_name'] . "</td>
                  <td>" . $value['user_surname'] . "</td>
                  <td>" . $value['user_email'] . "</td>
                  <td>" . $value['user_pass'] . "</td>
                  <td class='text-end'>
                    <a id='btn-info' class='btn btn-info btn-sm disabled'>Info</a>
                    <a href='editarUsuario.php?user_id=" . $value['user_id'] . "'  class='btn btn-success btn-sm btn-edit'>Editar</a>
                    <a href='borrarUsuario.php?user_id=" . $value['user_id'] . "'  class='btn btn-danger btn-sm btn-delete'>Borrar</a>
                  </td>
                </tr>";
              }
          echo "
              </tbody> 
            </table>
          </div> ";
              
          // listado de productos a la venta
          echo "
          <div class='col-5'>
            <h3 class='text-center mb-4'>Lista de productos</h3>
            <table class='table table-striped'>
              <thead>
                <tr>
                  <th scope='col'>#</th>
                  <th scope='col'>&nbsp;</th>
                  <th scope='col'>Nombre</th>
                  <th scope='col'>Precio</th>
                  <th scope='col'>Unidad</th>
                  <th scope='col'></th>
                </tr>
              </thead>
              <tbody>";

              // listado de los usuarios
              // los botones son enlaces mediante los cuales llamaré a una función php (info, editar, borrar) pasándole como parámetro GET el id del usuario

              foreach ($resultados_lista_productos as $key => $value) {
                echo
                "
                <tr class='align-middle'>
                  <th scope='row'>" . $value['id'] . "</th>
                  <td><img src='../img/" . $value['imagen'] . "' class='items-img-min'></td>
                  <td>" . $value['nombre'] . "</td>
                  <td>" . $value['precio'] . "</td>
                  <td>" . $value['unidad'] . "</td>
                  <td class='text-end'>
                    <a id='btn-info' class='btn btn-success btn-sm disabled'>Editar</a>
                    <a id='btn-info' class='btn btn-danger btn-sm disabled'>Borrar</a>
                  </td>
                </tr>";
              }
          echo "
              </tbody> 
            </table>
          </div> 
          
          <div class='col-2 text-center'>
          <h3 class='mb-5'>Opciones</h3>
          <a href='./addProducto.php' class='btn btn-dark btn-lg'>Añadir producto</a>
          </div>";
           
        } else echo "
            <div class='text-center mt-5 alert alert-danger' role='alert'>
              <h2>Acceso limitado al administrador.</h2>
            </div>";

      ?>
        
    
  </main>
</body>
</html>