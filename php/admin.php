<?php
  session_start();
  include_once './connect.php';

  $list_query = "SELECT * FROM users";

  // variable de listado de usuarios
  try {
    $list_connect = $pdoConnection->prepare($list_query);
    $list_connect->execute(array());
    $result_list = $list_connect->fetchAll(PDO::FETCH_ASSOC);

  } catch (Exception $err){
  print "Error!: " . $err->getMessage() . "<br>";
  die();
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Administración</title>
  <!-- bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
   <!-- fontawesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<header class="mb-5">
    <nav class="navbar bg-light">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h1"><i class="fa-solid fa-seedling"></i> Carrito de la compra - Panel de administración</span>
        <span class="text-right">
          <a href="../index.php">Volver</a>
        </span>
      </div>
    </nav>
  </header>
  <div class="container col-8">
    <?php 
    // si el usuario es el admin, se muestra la tabla de usuarios
    if(isset($_SESSION["user"]) && $_SESSION["user"] == "admin"){
    echo "
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
        // listado de todos los usuarios
        // los botones son enlaces mediante los cuales llamaré a una función php (info, editar, borrar) pasándole como parámetro GET el id del usuario

        foreach ($result_list as $key => $value) {
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
                <a href='editarUsuario.php?user_id=" . $value['user_id'] . "' id='btn-edit' class='btn btn-success btn-sm'>Editar</a>
                <a href='borrarUsuario.php?user_id=" . $value['user_id'] . "' id='btn-delete' class='btn btn-danger btn-sm'>Borrar</a>
              </td>
            </tr>
          ";
        }
          
      echo "</tbody> 
      </table>";
    } else echo "
                  <div class='text-center mt-5 alert alert-danger' role='alert'>
                    <h2>Acceso limitado al administrador.</h2>
                  </div>";
    ?>
  </div>
  </body>
  </html>