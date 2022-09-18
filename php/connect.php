<?php

$servername = "localhost";
$dbname = "carrito";
$usuario = "root";
$password = "";

try {
  $pdoConnection = new PDO("mysql:host=$servername;dbname=$dbname", $usuario, $password);

  // echo "Conectado!";

} catch (PDOException $e) {
  print "¡Error!: " . $e->getMessage() . "<br/>";
  die();
}


?>