<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Medieval - Home</title>
        
        <!-- Boostrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- Favicon-->
        <link rel="icon" type="image/png" href="../assets/img/icons8-medieval-32.png">
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- CSS propio-->
        <link rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body>
        <!-- Menu navegacion-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="Home.php"><img src="../assets/img/icons8-medieval-62.png" alt="Logo" ></a><!-- Logo Medieval -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle tc-paleta5" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorías</a>
                        <ul class="bg-paleta2 dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="productos.php">Todos los productos</a></li>
                            <li><hr class="dropdown-divider" /></li>

                            <?php
                            include '../controller/categoriaController.php';
                            $searchAll = $categoria->searchAll();//Realice el query y 
                            while($rows = $searchAll->fetch_assoc()){
                                $cat=$rows['categoria'];
                                $cat_id=$rows['id'];
                                echo  "<li><a class='dropdown-item' href='productos.php?categoria=$cat_id'>$cat</a></li>";
                            }
                            ?>
                            

                        </ul>
                    </li>
                </ul>
                <!-- En esta sección, si hay un usuario logeado muestra su nombre, de lo contrario muestra el logo que lo dirige a login.php -->
                <?php if(isset($_SESSION['usuario'])) { ?>
                    <ul class="navbar-nav me-2 mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION['usuario']; ?></a><!--Nombre del usuario -->
                            <ul class="bg-paleta2 dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="Home.php?logout='1'">Cerrar sesión</a></li><!-- Si cierra sesión, al dar click el atributo $_SESSION['logout'] se vuelve 1 y carga de nuevo la página-->
                            </ul>
                        </li>
                    </ul>
                    
                        <a href="carrito.php">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1 tc-paleta5"></i>
                            <?php
                            $cantidad_carrito = $_SESSION['carrito'];
                            echo "<span class='badge bg-paleta5 text-white ms-1 rounded-pill'>".$cantidad_carrito."</span>";
                            ?>
                        </button>
                        </a>
                    
                <?php } else { ?> <!--Si no está logeado, Muestra el logo que lo dirige a login.php -->
                    <a class="nav-link tc-paleta5" href="login.php">Iniciar Sesión  <img src="../assets/img/icons8-male-user-24.png" alt="Logo" ></a>
                <?php } ?>
                    <!-- *********************************************************************************************************************** -->
                </div>
            </div>
        </nav>
