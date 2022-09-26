<?php
session_start();

include_once './connect.php';
// consulta bd para mostrar nº de usuarios
$count_query = "SELECT * FROM users";

try {
  $count_user = $pdoConnection->prepare($count_query);
  $count_user->execute(array());

  // rowCount indica el nº de filas de la consulta
  $total_user_count = $count_user->rowCount();
} catch (Exception $err) {
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
  <title>Login</title>
  <!-- bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../css/styles.css">
</head>

  <body>
    <header>
      <nav class="navbar bg-light">
        <div class="container-fluid">
          <span class="navbar-brand mb-0 h1"><i class="fa-solid fa-seedling"></i> Carrito de la compra - Entrar</span>
          <span class="text-right">

            <!-- Indicación en el header del usuario actualmente logueado y opción de logout -->
            <?php
              // echo session_id();
              if(isset($_SESSION["user"])){
                echo "Bienvenido " . $_SESSION["user"] . " <small><a href='./logout.php'>Cerrar sesión</a></small>";
              } else {
                echo "<a href='../index.php'>Volver</a>";
              }
            ?>

          </span>
        </div>
      </nav>
    </header>
              
    <div class="container col-11 col-lg-4">
      <!-- importante vh-100 para centrar verticalmente -->
      <div class="row vh-100 justify-content-center align-items-center">
        <form class="row col-m-7 col-10" action="./login.php" method="POST" id="loginForm">
          <div class="row text-center mb-4">
            <h2>Acceso de usuario</h2>
          </div>

          <!-- muestro mensaje de error si usuario/password incorrectos -->
          <?php
            if(isset($_GET['error']) && $_GET['error'] == 1){
              echo " <div class='alert alert-danger' role='alert'>
                    Usuario y/o contraseña incorrectos! <br> Intentos restantes: ". $_SESSION["login_error"] .
                "</div>";
            }
          ?>

          <div class="mb-1">
            <label for="user_name" class="form-label"><i class="fa-solid fa-user"></i> Usuario</label>
            <input type="text" name="user_name" class="form-control" id="user_name" aria-describedby="nameHelp" autofocus required>
            <div id="nameHelp" class="form-text">
              <p>Introduce tu nombre de usuario</p>
            </div>
          </div>

          <div class="mb-5">
            <label for="user_pass" class="form-label"><i class="fa-solid fa-lock"></i> Password</label>
            <input type="password" name="user_pass" class="form-control" id="user_pass" required>
            <div id="passwordHelp" class="form-text">
              <p>Introduce tu contraseña</p>
            </div>
          </div>
    
          <div class="col-10 offset-1 btn-group-lg btn-group mb-4" role="group" aria-label="Botones para enviar o borrar formulario">
            <button type="submit" class="btn btn-success" id="btnLogin">Enviar</button>
            <button type="reset" class="btn btn-light" id="btnClear">Borrar</button>
          </div>

          <div class="text-center">
            <p><a href="./registro.php">¿Aún no tienes una cuenta?</a></p>
            <p>Ya somos <?php echo $total_user_count ?> usuarios!</p>
          </div>

        </form>
      </div>
    </div>

    <footer class="bg-light text-center text-lg-start mt-5">
      <!-- Copyright -->
      <div class="text-center p-3"> 
          © 2022
          <a href="#">Carrito</a>
      </div>
      <!-- Copyright -->
    </footer>

    <script src="../js/validacion_formulario.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  </body>

  </html>