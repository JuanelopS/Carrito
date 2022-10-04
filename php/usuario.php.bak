<?php
  session_start();
  include_once './connect.php';

  $usuario = $_GET['user_id'];
  // query listado de compras según usuario
  $lista_compras_query = "SELECT * FROM compra WHERE id_usuario_compra = $usuario ORDER BY fecha_compra DESC";

  try {
    $lista_compras_connect = $pdoConnection->prepare($lista_compras_query);
    $lista_compras_connect->execute(array());
    $resultados_lista_compras = $lista_compras_connect->fetchAll(PDO::FETCH_ASSOC);

  } catch (Exception $err){
  print 'Error!: ' . $err->getMessage() . '<br>';
  die();
  }

?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Usuario <?php echo $_SESSION['user']; ?></title>
  <!-- bootstrap -->
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css'>
   <!-- fontawesome -->
   <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css' integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==' crossorigin='anonymous' referrerpolicy='no-referrer' />
  <link rel='stylesheet' href='../css/admin.css'>
</head>
<body>
  <header class='mb-5'>
      <nav class='navbar bg-light'>
        <div class='container-fluid'>
          <span class='navbar-brand mb-0 h1'><i class='fa-solid fa-seedling'></i>Carrito - <?php echo $_SESSION['user']; ?></span>
          <span class='text-right'>
            <a href='../index.php'>Volver</a>
          </span>
        </div>
      </nav>
  </header>
  <main class='container col-10'>
      <div class='row'>
      <?php 
        // si intenta entrar el propio usuario o el administrador, mostrar los datos
        if(isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $_GET['user_id'] || $_SESSION['user'] == 'admin')){
        
          // query nombre_usuario
          $sql_nombre_usuario = "SELECT * FROM usuarios WHERE user_id = $usuario";

          try {
            $nombre_usuario_connect = $pdoConnection->prepare($sql_nombre_usuario);
            $nombre_usuario_connect->execute(array());
            $resultado_nombre_usuario = $nombre_usuario_connect->fetchAll(PDO::FETCH_ASSOC);

          } catch (Exception $err){
          print 'Error!: ' . $err->getMessage() . '<br>';
          die();
          }

          foreach ($resultado_nombre_usuario as $key => $value) {
            $nombre_usuario = $value['user_name'];
          }

          // listado de compras del usuario
          echo "
          <div class='offset-3 col-6'>
            <h3 class='text-center mb-4'>Listado de compras de $nombre_usuario</h3>
            <table class='table table-hover text-center align-middle'>
              <thead>
                <tr>
                  <th scope='col'>#</th>
                  <th scope='col'>Fecha y hora</th>
                  <th scope='col'>Total Compra</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>";
            
              foreach ($resultados_lista_compras as $key => $value) {
                $id_compra = $value['id_compra'];

                $sql_detalles_compra = "SELECT * FROM detalle_compra WHERE id_compra = $id_compra";

                try {
                  $detalles_compras_connect = $pdoConnection->prepare($sql_detalles_compra);
                  $detalles_compras_connect->execute(array());
                  $resultados_detalles_compras = $detalles_compras_connect->fetchAll(PDO::FETCH_ASSOC);
                  
                } catch (Exception $err){
                print 'Error!: ' . $err->getMessage() . '<br>';
                die();
                }

                


                // para el formateo de fecha/hora 
                $date = new DateTime($value['fecha_compra']);
                echo
                "
                    <tr data-bs-toggle='collapse' data-bs-target='#r$key'>
                      <th scope='row'>" . $key + 1 . "</th>
                      <td>" . date_format($date, 'd/m/Y G:i:s') . "</td>
                      <td>" . number_format($value['total_compra'], 2) . " €</td> 
                      <td>
                        <button class='btn btn-success btn-sm' type='button' data-bs-toggle='collapse' data-bs-target='#r$key' aria-expanded='false'>
                          Detalle compra
                        </button>
                      </td>
                    </tr>";

                    foreach ($resultados_detalles_compras as $index => $value_detalle) {
                        
                      $nombre = $value_detalle['nombre_producto'];
                      $precio = $value_detalle['precio_producto'];
                      $cantidad = $value_detalle['cantidad_producto'];
                      $total = $value_detalle['precio_total_producto'];
                      
                      echo "
                        <tr class='collapse table-success' id='r". $key ."'>
                          <td>". $index + 1 ."</td>
                          <td>$nombre ( $cantidad )</td>
                          <td>".number_format($precio,2)." €</td>
                          <td>".number_format($total,2)." €</td>
                        </tr>";  
                    } 
                
              }

            echo "
                </div>
                </tbody>
              </table>
            </div>";
          
        } else echo "
            <div class='text-center mt-5 alert alert-danger' role='alert'>
              <h2>Acceso limitado al propio usuario.</h2>
            </div>";

      ?>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>