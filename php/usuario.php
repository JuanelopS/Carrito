<?php
  session_start();
  include_once './connect.php';

  $usuario = $_GET['user_id'];
  // query listado de comprar según usuario
  $lista_compras_query = "SELECT * FROM compra WHERE id_usuario_compra = $usuario";

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
        
          // listado de compras del usuario
          echo "
          <div class='offset-4 col-4'>
            <h3 class='text-center mb-4'>Listado de compras</h3>
            <table class='table table-striped text-center'>
              <thead>
                <tr >
                  <th scope='col'>#</th>
                  <th scope='col'>Total Compra</th>
                  <th scope='col'>Fecha y hora</th>
                </tr>
              </thead>
              <tbody>";
            
              foreach ($resultados_lista_compras as $key => $value) {
                // para el formateo de fecha/hora 
                $date = new DateTime($value['fecha_compra']);
                echo
                "
                <tr class='align-middle'>
                  <th scope='row'>" . $key + 1 . "</th>
                  <td>" . number_format($value['total_compra'],2) . "</td> 
                  <td>" . date_format($date, 'd/m/Y G:i:s') . "</td>
                </tr>";
              }
          echo "
              </tbody> 
            </table>
          </div>
          ";
          
        } else echo "
            <div class='text-center mt-5 alert alert-danger' role='alert'>
              <h2>Acceso limitado al propio usuario.</h2>
            </div>";

      ?>
  </main>
</body>
</html>