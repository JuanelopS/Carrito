<?php

  $servername = "localhost";
  $dbname = "carrito";
  $usuario = "root";
  $password = "";

  try {
    $pdoConnection = new PDO("mysql:host=$servername;dbname=$dbname",
                              $usuario,
                              $password,
                              array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); //evita problemas con ñ / tildes);

    // echo "Conectado!";

  } catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
  }

?>