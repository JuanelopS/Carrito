<?php
  session_start();
  include_once './connect.php';

  $item_id = $_GET['id'];

  $list_query = "DELETE FROM items WHERE id = $item_id";

  // variable de listado de usuarios
  try {
    $list_connect = $pdoConnection->prepare($list_query);
    $list_connect->execute();

    // borrar archivo de imagen del directorio ?

    // $path = $_SERVER['DOCUMENT_ROOT'] . '\img\\';

    // $item_query = "SELECT * FROM items WHERE id = $item_id";

    // $item_connect = $pdoConnection->prepare($item_query);
    // $item_connect->execute();
    // $item_result = $item_connect->fetchAll(PDO::FETCH_ASSOC);
    
    // $nombre_item = $item_result['nombre'];

    // $dest_path = $path . $nombre_item;

    //   // Si el archivo existe, borrarlo
    //   if(file_exists('$dest_path')) {
    //       unlink('$dest_path');
    //   }

    //   // header("Location: admin.php");
    //   echo $dest_path;

  } catch (Exception $err){
  print "Error!: " . $err->getMessage() . "<br>";
  die();
  }

?>