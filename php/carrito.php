<?php
session_start();
include_once './connect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
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

  <div class="container col-11 col-lg-4 mt-5">
    <!-- importante vh-100 para centrar verticalmente -->
    <div class="row justify-content-center">
      <table class='table table-striped'>
          <thead>
            <tr>
              <th scope='col'>#</th>
              <th scope='col'>Fruta</th>
              <th scope='col'>Precio</th>
              <th scope='col'>Cantidad</th>
              <th scope='col'>Total</th>
            </tr>
          </thead>
          <tbody id="lista">
          </tbody> 
      </table>
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

  <script src="../js/confirmacion.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>