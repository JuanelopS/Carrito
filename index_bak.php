<?php
session_start();
include_once './php/connect.php';

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
    <header>
        <nav class="navbar bg-light">
            <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><i class="fa-solid fa-seedling"></i> Carrito de la compra</span>
            <span class="text-right">

                <!-- Indicación en el header del usuario actualmente logueado y opción de logout -->
                <?php
                // echo session_id();
                if(isset($_SESSION["user"])){
                    echo "Bienvenido " . $_SESSION["user"] . " <small><a href='./php/logout.php'>Cerrar sesión</a></small>";
                } else{
                    echo "<a href='./php/entrar.php'>Entrar</a> / <a href='./php/registro.php'>Crear usuario</a>";
                }
                ?>

            </span>
            </div>
        </nav>
    </header>
    <div class="container">
        <section class="text-center mb-5">
            <div id="presentacio">
                <h2 id="logo"><span id="logo-texto">CARRITO  </span><lord-icon src="https://cdn.lordicon.com/waqyacxh.json" trigger="hover"style="width:250px;height:250px" class="img-fluid"></lord-icon></h2>
                <p>Elige la fruta que deseas haciendo click sobre su imagen.</p>
            </div>
        </section>
        <section id="productos mb-5">
            <div class="row fruites text-center">
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-3 productos">
                    <a href="#compra" nombre="Manzana Royal Gala" precio="2.50" unidad="kilo">
                        <img class="imatges" src="img/manzana-royal-gala.jpg" alt="Manzana Royal Gala a 2.50€ el kilo">
                        <p class="producto-nombre">Manzana Royal Gala</p>
                        <p><span class="producto-precio">2.50</span>€/kilo</p>
                    </a>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-3 productos">
                    <a href="#compra" nombre="Manzana Golden" precio="1.30" unidad="kilo">
                        <img class="imatges" src="img/manzana-golden-800g.jpg" alt="Manzana Golden a 1.30€ el kilo">
                        <p class="producto-nombre">Manzana Golden</p>
                        <p><span class="producto-precio">2.50</span>€/kilo</p>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-3 productos">
                    <a href="#compra" nombre="Higos" precio="8.80" unidad="kilo">
                        <img class="imatges" src="img/higos-500g.jpg" alt="Higos a 8.90€ el kilo">
                        <p class="producto-nombre" nombre="Higos" precio="8.80">Higos</p>
                        <span class="producto-precio">8.80 €/kilo</span>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-3 productos">
                    <a href="#compra" nombre="Pera Ercolini" precio="3.20" unidad="kilo">
                        <img class="imatges" src="img/pera-ercollini-800gr.jpg" alt="Pera a 3.20€ el kilo">
                        <p class="producto-nombre">Pera Ercolini</p>
                        <p><span class="producto-precio">3.20</span>€/kilo</p>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-3 productos">
                    <a href="#compra" nombre="Plátano" precio="3.45" unidad="kilo">
                        <img class="imatges" src="img/platanos-800g.jpg" alt="Platano a 3.45€ el kilo">
                        <p class="producto-nombre">Plátano</p>
                        <p><span class="producto-precio">3.45</span>€/unidad</p>
                    </a>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-3 productos">
                    <a href="#compra" nombre="Melocotón" precio="5.25" unidad="kilo">
                        <img class="imatges" src="img/melocoton-amarillo-1kg.jpg"
                            alt="Melocotón amarillo a 5.25€ el kilo">
                        <p class="producto-nombre">Melocotón</p>
                        <p><span class="producto-precio">5.25</span>€/kilo</p>
                    </a>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-3 productos">
                    <a href="#compra" nombre="Aguacates" precio="7.55" unidad="kilo">
                        <img class="imatges" src="img/aguacates-1kg.jpg" alt="Aguacates a 2.50€ el kilo">
                        <p class="producto-nombre">Aguacates</p>
                        <p><span class="producto-precio">7.55</span>€/unidad</p>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-3 productos">
                    <a href="#compra" nombre="Ciruela roja" precio="2.50" unidad="kilo">
                        <img class="imatges" src="img/ciruela-roja-800g.jpg" alt="Ciruela roja a 2.45€ el kilo">
                        <p class="producto-nombre">Ciruela roja</p>
                        <p><span class="producto-precio">2.50</span>€/kilo</p>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-3 productos">
                    <a href="#compra" nombre="Pomelo" precio="2.80" unidad="kilo">
                        <img class="imatges" src="img/pomelo-1kg.jpg" alt="Pomelo a 2.80€ el kilo">
                        <p class="producto-nombre" nombre="Pomelo" precio="2.80">Pomelo</p>
                        <span class="producto-precio">2.80 €/kilo</span>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-3 productos">
                    <a href="#compra" nombre="Piña" precio="8.75" unidad="unidad">
                        <img class="imatges" src="img/pina-1ud.jpg" alt="Piña a 8.75€ la unidad">
                        <p class="producto-nombre">Piña</p>
                        <p><span class="producto-precio">8.75</span>€/unidad</p>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-3 productos">
                    <a href="#compra" nombre="Coco" precio="6.45" unidad="unidad">
                        <img class="imatges" src="img/coco-1ud.jpg" alt="Coco a 6.45€ la unidad">
                        <p class="producto-nombre">Coco</p>
                        <p><span class="producto-precio">6.45</span>€/unidad</p>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-3 productos">
                    <a href="#compra" nombre="Kiwi" precio="5.25" unidad="kilo">
                        <img class="imatges" src="img/kiwi-verde-800g.jpg" alt="Kiwi verde a 5.25€ el kilo">
                        <p class="producto-nombre">Kiwi</p>
                        <p><span class="producto-precio">5.25</span>€/kilo</p>
                    </a>
                </div>
            </div>
        </section>

        <br><br>  <!-- CHAPUZA TEMPORAL -->

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
            <button type="submit" class="btn btn-success mb-4">
                Subscríbete
            </button>
            </div>

        </div>

        </form>
    </div>

    <!-- Copyright -->
    <div class="text-center p-3"> 
        © 2022
        <a href=" #">Carrito</a>
    </div>
    <!-- Copyright -->
    </footer>

    <script src="./js/carrito.js" type="module"></script>
    <!-- lordicon.com (icon logo) -->
    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
</body>
</html>