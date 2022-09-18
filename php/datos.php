<?php

$datos = file_get_contents("php://input");
$json = json_decode($datos, true);

print_r($json);

  foreach ($json as $key => $value) {
    print_r ($value['nombre'] . " - " . $value['cantidad'] . " - " . $value['precio'] . "\n");
  }

?>
