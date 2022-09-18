<?php
  session_start();
  include_once './connect.php';
  
  $name = $_POST['user_name'];
  $password = $_POST['user_pass'];

  $login_query = "SELECT * FROM users 
                  WHERE user_name='$name' AND user_pass='$password'";

  // consulta usuario/contraseña
  try {
    $login_user = $pdoConnection->prepare($login_query);
    $login_user->execute(array());

    if($login_user->rowCount() > 0){
      // echo "hola $name <a href='../index.php'>Volver</a>";
      // login ok -> asignamos la variable de sesión y redirección hacia welcome.php
      $_SESSION["user"] = $name;
      $_SESSION["login_error"] = 3;
      if($name == "admin"){
        header("location: admin.php");
      } else{
        header("location: welcome.php?user_name=$name");
      }
    } 
    else 
    {
      // creamos la variable de sesión si no existe, y en caso contrario le sumamos uno
      if(!isset($_SESSION["login_error"])){
          $_SESSION["login_error"] = 3;  // NÚMERO DE INTENTOS DE LOGIN
      } 
      else $_SESSION["login_error"]--;
      if($_SESSION["login_error"] > 0){
        header("location: ../index.php?error=1");
      }
      else{
        $_SESSION["login_error"] = 3;
        echo "<div class='text-center mt-5 alert alert-danger' role='alert'>
          <h2>Superado el número máximo de intentos de login. Volviendo a la página de inicio...</h2>
        </div>";
        echo "<script>
                  setTimeout(() => window.location = '../index.php',3000);
             </script>";
      } 
      /* debería incluir aquí un insert a un campo de la bd y marcar al usuario como bloqueado en lugar
         de volver a inicializar la variable de sesión */
    }

  } catch (Exception $err){
    print "Error!: " . $err->getMessage() . "<br>";
    die();
  }

?>