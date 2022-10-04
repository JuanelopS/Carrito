<?php
    session_start();
    include_once './php/connect.php';

    // CONSULTA DE PRODUCTOS A MOSTRAR
    $lista_productos_query = 'SELECT * FROM items';

    try {
        $lista_productos_connect = $pdoConnection->prepare($lista_productos_query);
        $lista_productos_connect->execute(array());
        $resultados_lista_productos = $lista_productos_connect->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $err){
    print 'Error!: ' . $err->getMessage() . '<br>';
    die();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1e7e74a174.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header class='sticky-top'>
        <nav class="navbar bg-light">
            <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><i class="fa-solid fa-seedling"></i> Carrito de la compra</span>
            <span class="text-right header-links">

                <!-- Indicación en el header del usuario actualmente logueado y opción de logout -->
                <?php
                    // echo session_id();
                    if(isset($_SESSION["user"])){
                        if($_SESSION["user"] == 'admin'){
                            echo " <a href='./php/admin.php'>Panel de administración</a> ";
                        }else {
                        echo "Bienvenido<a href='./php/usuario.php?user_id=" . $_SESSION['user_id'] . "'>" . $_SESSION['user'] . "</a>";
                        }
                        echo "<small><a href='./php/logout.php'>Cerrar sesión</a></small>";
                    } else{
                        echo "<a href='./php/entrar.php'>Entrar</a>  <a href='./php/registro.php'>Crear usuario</a>";
                    }
                ?>

            </span>
            </div>
        </nav>
    </header>
    <div class="container position-static">
        <section class="text-center mb-5">
            <div id="presentacion">
                <h2 id="logo"><span id="logo-texto">CARRITO  </span><lord-icon src="https://cdn.lordicon.com/waqyacxh.json" trigger="hover"style="width:250px;height:250px" class="img-fluid"></lord-icon></h2>
            </div>
        </section>
        <section id="productos mb-5">
            <div class="row items text-center">
                
                    
                    <?php
                        /* MOSTRAR LOS ITEMS PARA COMPRAR EN PANTALLA */

                        foreach ($resultados_lista_productos as $key => $value) {
                            echo
                            "
                            <div class='card producto'>
                                <a href='#compra' nombre='" . $value['nombre'] . "' precio='" . $value['precio']. "' unidad='" . $value['unidad']. "'>
                                    <img class='imagen_producto' src='./img/" . $value['imagen'] . "' alt='" . $value['nombre'] . "'>
                                    <div class='card-body'>
                                        <p class='producto-nombre card-title'>" . $value['nombre'] . "</p>
                                        <p class='card-text'><span class='producto-precio'>" . number_format($value['precio'], 2) . "</span>€/" . $value['unidad'] . "</p>
                                    </div>
                                </a>
                            </div>
                            ";
                          }
  
                    ?>
                    
            </div>
        </section>

        <section id="compra mb-5">
            <div>
                <div style="border-bottom: 4px solid green">
                    <h2>Su compra:</h2>
                </div>
                <p id="barra"></p>
                <p id="carrito">Aún no ha comprado nada</p>
            </div>
        </section>

    </div>
    <footer class="bg-light text-center text-lg-start mt-5">
    <div class="container p-4 pb-0">
        <form action="" onsubmit="return false">
        <div class="row justify-content-center">
            <div class="col-auto mb-4 mb-md-0">
            <p class="pt-2">
                <strong>¿Quieres recibir las últimas novedades en tu correo electrónico?</strong>
            </p>
            </div>

            <div class="col-md-5 col-12 mb-4 mb-md-0">
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" id="form5Example25" class="form-control" placeholder="En desarrollo..."/>
            </div>
            </div>

            <div class="col-auto mb-4 mb-md-0">
            <!-- Submit button -->
            <button type="submit" class="btn btn-success mb-4 disabled">
                Subscríbete
            </button>
            </div>

        </div>

        </form>
    </div>

    <!-- Copyright -->
    <div class="text-center p-3"> 
        &copy; <?php echo date('Y') ?>
        <a href=" #">Carrito</a>
    </div>
    <!-- Copyright -->
    </footer>

    <script src="./js/carrito.js" type="module"></script>
    <!-- lordicon.com (icon logo) -->
    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
</body>
</html>