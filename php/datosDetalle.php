
<?php
  
  session_start();
  include_once './connect.php';

  // Recogida de los detalles del carrito por PHP (fetch confirmacion.js)
  $datos = file_get_contents("php://input");
  $detalle = json_decode($datos, true);
  // print_r($detalle);
  
  // coger el valor del id de la ultima compra para insertarla en esta tabla de detalles de compra (*debo buscar otra manera menos cutre de hacer esto)
  
  $sql_id_ultima_compra = "SELECT id_compra FROM compra ORDER BY id_compra DESC LIMIT 1";

  try {
      $id_ultima_compra = $pdoConnection->prepare($sql_id_ultima_compra);
      $id_ultima_compra->execute(array());
      $resultado_id_ultima_compra = $id_ultima_compra->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $err){
    print "Error!: " . $err->getMessage() . "<br>";
    die();
  }

  foreach ($resultado_id_ultima_compra as $key => $value) {
    $id_compra = $value['id_compra'];
  }
  
  
  // inserción de datos en la base de datos (array for each que hace un insert por cada uno de los elementos en el carrito al confirmar la compra)

  // nombre_producto cantidad_producto	precio_producto	unidad_producto	precio_total_producto	id_compra	id_usuario_compra
  // $value['nombre_producto'] $value['cantidad_producto'] $value['precio_producto'] $value['precio_producto'] * $value['cantidad_producto'] * $_SESSION['user_id']
  
  foreach ($detalle as $key => $value) {
    
    $sql_insert_detalle = "INSERT INTO detalle_compra(nombre_producto, cantidad_producto, precio_producto, precio_total_producto, id_compra, id_usuario_compra) VALUES (?,?,?,?,?,?)";

    try {
        $add_detalle_compra = $pdoConnection->prepare($sql_insert_detalle);
        $add_detalle_compra->execute(array($value['nombre'], $value['cantidad'], number_format($value['precio'], 2), number_format($value['precio'] * $value['cantidad'], 2), $id_compra,$_SESSION['user_id']));
    } catch (Exception $err){
      print "Error!: " . $err->getMessage() . "<br>";
      die();
    }

  }


  // cerrando conexión con la db
  // $
  // $add_detalle_compra = null;
  // $pdoConnection = null;

  // tras la compra volver a index.php
  // header("Location: ../index.php");

?>
