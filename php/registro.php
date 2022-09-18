<?php

  include_once './connect.php';

  $isRepeated = 0;
  if ($_POST){

    $name = $_POST['user_name'];
    $surname = $_POST['user_surname'];
    $email = $_POST['user_email'];
    $password = $_POST['user_pass'];
    
    // comprobar que no se repitan usuarios en la base de datos desde php
    $sql_verify_query = "SELECT * FROM users WHERE user_name='$name'";
    $sql_verify = $pdoConnection->prepare($sql_verify_query);
    $sql_verify->execute();
    // PDO::FETCH_ASSOC devuelve solamente el valor de la columna
    $result_verify = $sql_verify->fetch(PDO::FETCH_ASSOC);

    // ya existe un usuario en la bd
    if($result_verify > 0){
      // print_r($result_verify['user_name']);
      $isRepeated = 1;
    }
    
    // usuario no repetido en la bd....
    else 
    {
      $sql_insert = "INSERT INTO users(user_name, user_surname, user_email, user_pass) VALUES (?,?,?,?)";

      try {
        $add_user = $pdoConnection->prepare($sql_insert);
        $add_user->execute(array($name, $surname, $email, $password));

      } catch (Exception $err){
        print "Error!: " . $err->getMessage() . "<br>";
        die();
      }

      // cerrando conexión con la db
      $add_user = null;
      $pdoConnection = null;

      // para que se recargue la página
      header("location: ../index.php");
    }
  }
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear usuario</title>
  <!-- bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../css/estils.css">
</head>
<body>

  <header>
    <nav class="navbar bg-light">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h1"><i class="fa-solid fa-seedling"></i> Carrito de la compra - Registro</span>
        <span class="text-right">
          <a href="../index.php">Volver</a>
        </span>
      </div>
    </nav>
  </header>

  <div class="container col-11 col-lg-4">
    <!-- importante vh-100 para centrar verticalmente -->
    <div class="row vh-100 justify-content-center align-items-center">
      
      <form class="row col-m-7 col-10" action="./registro.php" method="POST" id="loginForm">

        <div class="text-center mb-4">
          <h2>Crear usuario</h2>
        </div>

        <!-- aviso de error en registro de usuario ya existente -->
        <?php
          if($isRepeated != 0){
            echo " <div class='alert alert-danger' role='alert'>
                  El usuario ". $result_verify['user_name'] . " ya existe!
              </div>";
          }
        ?>
       
        <div class="mb-2">
          <label for="user_name" class="form-label">
            <i class="fa-solid fa-user"></i> Nombre
          </label>
          <input type="text" name="user_name" class="form-control" id="user_name" aria-describedby="nameHelp" autofocus required>
          <div id="nameHelp" class="form-text">Introduce tu nombre de usuario</div>
        </div>

        <div class="mb-2">
          <label for="user_surname" class="form-label">
          <i class="fa-regular fa-user"></i> Apellidos
          </label>
          <input type="text" name="user_surname" class="form-control" id="user_surname" aria-describedby="surnameHelp" required>
          <div id="surnameHelp" class="form-text">Introduce tus apellidos</div>
        </div>

        <div class="mb-2">
          <label for="user_mail" class="form-label">
          <i class="fa-solid fa-envelope"></i> Correo Electrónico
          </label>
          <input type="email" name="user_email" class="form-control" id="user_email" aria-describedby="mailHelp" required>
          <div id="mailHelp" class="form-text">Introduce un correo electrónico</div>
        </div>

        <div class="mb-3">
          <label for="user_pass" class="form-label">
            <i class="fa-solid fa-lock"></i> Password
          </label>
          <input type="password" name="user_pass" class="form-control" id="user_pass" required>
          <div id="passwordHelp" class="form-text">Introduce una contraseña</div>
        </div>

        <div class="mb-4 form-check offset-1">
          <input type="checkbox" class="form-check-input" id="checkRemember">
          <label class="form-check-label" for="checkRemember">
            Acepto las <a href="https://youtu.be/dQw4w9WgXcQ?t=14" target="_blank" title="<3">condiciones</a>
          </label>
        </div>

        <div class="offset-2 col-8 offset-1 btn-group-lg btn-group mt-3" role="group" aria-label="Boton para crear un nuevo usuario">
          <button type="submit" class="btn btn-success" id="btnAddUser">Crear Usuario</button>
        </div>

      </form>
    </div>
  </div>
  <script src="../js/validacion_formulario.js"></script>  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    console.log(window.location.pathname)
  </script>
</body>
</html>