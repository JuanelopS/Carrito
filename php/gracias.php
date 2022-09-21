<?php
  session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gracias!</title>
  <!-- bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <div class="container">
      <div class="row vh-100 justify-content-center align-items-center">
        <div class="col-auto text-center">
          <?php
            
              echo "<h1 class='mb-3'>Muchas gracias por tu compra " . $_SESSION['user'] . "</h1> <p class='mb-5'>Volverás a la pantalla de inicio en 3 segundos...</p><i class='fa-solid fa-sync fa-spin fa-5x'></i>";

              // 3 segundos de delay para volver a index.php
              echo "<script>
                      setTimeout(() => window.location = '../index.php',3000);
                  </script>"
            
          ?>
      </div>  
    </div>
  </div>
</body>
</html>