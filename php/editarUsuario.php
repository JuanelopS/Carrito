<?php
  session_start();
  include_once './connect.php';

  $user_id = $_GET['user_id'];

  // consulta para rellenar los placeholder del formulario

  $sql_verify_query = "SELECT * FROM usuarios WHERE user_id='$user_id'";
  
  $sql_verify = $pdoConnection->prepare($sql_verify_query);
  $sql_verify->execute();
  // PDO::FETCH_ASSOC devuelve solamente el valor de la columna
  $result_verify = $sql_verify->fetch(PDO::FETCH_ASSOC);

  // si se envia el formulario, update a base de datos según el parámetro get enviado desde admin.php
  if ($_POST){

    $name = $_POST['user_name'];
    $surname = $_POST['user_surname'];
    $email = $_POST['user_email'];
    $password = $_POST['user_pass'];

    $sql_update = "UPDATE users 
                   SET user_name = '$name', user_surname = '$surname', user_email = '$email', user_pass = '$password'
                   WHERE user_id = $user_id";

      try {
        $edit_user = $pdoConnection->prepare($sql_update);
        $edit_user->execute();

        // cerrando conexión con la db
        $edit_user = null;
        $pdoConnection = null;

        // para volver
        header("location: admin.php");

      } catch (Exception $err){
        print "Error!: " . $err->getMessage() . "<br>";
        die();
      } 
  }

  $sql_verify = null;
  $pdoConnection = null;

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
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

  <header>
    <nav class="navbar bg-light">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h1"><i class="fa-solid fa-seedling"></i> Carrito de la compra - Editar usuario</span>
        <span class="text-right">
          <a href="./admin.php">Volver</a>
        </span>
      </div>
    </nav>
  </header>

  <div class="container col-11 col-lg-4">
    <!-- importante vh-100 para centrar verticalmente -->
    <div class="row vh-100 justify-content-center align-items-center">
      
      <!-- placeholder de cada input del formulario el valor consultado en la base de datos: $result_verify -->

      <form class="row col-m-7 col-10" action="./editarUsuario.php?user_id=<?php echo $user_id ?>" method="POST" id="loginForm">

        <div class="text-center mb-4">
          <h2>Editar usuario <?php echo $result_verify['user_name'] ?></h2>
        </div>

        <div class="mb-2">
          <label for="user_name" class="form-label">
            <i class="fa-solid fa-user"></i> Nombre
          </label>
          <input type="text" name="user_name" class="form-control" id="user_name" placeholder="<?php echo $result_verify['user_name'] ?>" autofocus required>
        </div>

        <div class="mb-2">
          <label for="user_surname" class="form-label">
          <i class="fa-regular fa-user"></i> Apellidos
          </label>
          <input type="text" name="user_surname" class="form-control" id="user_surname" placeholder="<?php echo $result_verify['user_surname'] ?>" required>
        </div>

        <div class="mb-2">
          <label for="user_mail" class="form-label">
          <i class="fa-solid fa-envelope"></i> Correo Electrónico
          </label>
          <input type="email" name="user_email" class="form-control" id="user_email" placeholder="<?php echo $result_verify['user_email'] ?>" required>
        </div>

        <div class="mb-3">
          <label for="user_pass" class="form-label">
            <i class="fa-solid fa-lock"></i> Password
          </label>
          <input type="text" name="user_pass" class="form-control" id="user_pass" placeholder="<?php echo $result_verify['user_pass'] ?>" required>
        </div>

        <div class="text-center btn-group-lg mt-3" role="group" aria-label="Boton para editar usuario">
          <button type="submit" class="btn btn-info" id="editUser">Editar Usuario</button>
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
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>