<?php
  session_start();
  include_once './connect.php';

  $user = $_GET['user_id'];

  $list_query = "DELETE FROM users WHERE user_id = $user";

  // variable de listado de usuarios
  try {
    $list_connect = $pdoConnection->prepare($list_query);
    $list_connect->execute(array());

    header("Location: admin.php");

  } catch (Exception $err){
  print "Error!: " . $err->getMessage() . "<br>";
  die();
  }

?>