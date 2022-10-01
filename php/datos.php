
<?php
  // Recogida de los datos del carrito por PHP 
  session_start();

  include_once './connect.php';

  $datos = file_get_contents("php://input");
  $total = json_decode($datos, true);

  // print_r($total);
  // print_r($_SESSION['user']);
  
  /* Inserción de compra en la base de datos */

  $sql_insert = "INSERT INTO compra(id_compra, id_usuario_compra, total_compra, fecha_compra) VALUES (default, ?, ?, default)";

  try {
      $add_compra = $pdoConnection->prepare($sql_insert);
      $add_compra->execute(array($_SESSION["user_id"], $total));
  } catch (Exception $err){
    print "Error!: " . $err->getMessage() . "<br>";
    die();
  }


  // cerrando conexión con la db
  $add_compra = null;
  $pdoConnection = null;

  // tras la compra volver a index.php
  // header("Location: ../index.php");

?>
