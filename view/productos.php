<?php
session_start();



if(isset($_SESSION['usuario'])==TRUE) {
    if( $_SESSION['last_activity'] < time()-$_SESSION['expire_time'] ) { //se ha acabado el tiempo?
        session_destroy();
        unset($_SESSION['usuario']);
        header("Location: Home.php");
    } else{ 
    $_SESSION['last_activity'] = time(); //renueve el tiempo
    }
}


//Si la sesión ha sido cerrada (linea 56), el atributo Logout de session será 1 o TRUE y entrará al código, el cual destruye la sesión, quita el valor de usuario y carga el home
if(isset($_GET['logout'])) {

    session_destroy();
    unset($_SESSION['usuario']);
    header("Location: Home.php");
}

include "layout/header.php";
?>

<div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

    <?php

        if(!isset($_GET['categoria'])){//Si el usuario ha dado click en todos los producto traigalos todos

            $_POST["actualizar"]=TRUE;
            include '../controller/productoController.php';
            $DB_main = $_SESSION['DataBasePro'];

        }else{//Si ha seleccionado una categoría específica, traiga solo los de la categoría

            $_POST["search_categoria"]=TRUE;
            $_POST["categoria_producto"] = $_GET['categoria'];
            include('../controller/productoController.php');
            $DB_main = $_SESSION['DataBaseCatMain'];
        }


        foreach ($DB_main as $row) {//Muestra los productos que en la base de datos se han seleccionado apra aparecer en el main page

            $imageSmall = $row['imagen1_producto'];
            $nombre_producto = $row['nombre_producto'];
            $precio_producto = $row['precio_producto'];
            $decimal_format = number_format($precio_producto);
            $id_producto = $row['id_producto'];

            echo "<div class='col mb-5'>";
                echo "<div class='card h-100'>";
                    echo "<img class='card-img-top' src='../assets/img/DB_images/".$imageSmall."' alt='".$nombre_producto."' />";
                    echo "<div class='card-body p-4'>";
                        echo "<div class='text-center'>";
                            echo "<h5 class='fw-bolder'>".$nombre_producto."</h5>";
                            echo $decimal_format;
                        echo "</div>";
                    echo "</div>";
                    echo "<div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>";
                        echo "<div class='text-center'><a class='btn btn-outline-dark mt-auto' href='product.php?producto=$id_producto'>Comprar</a></div>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        }

    ?>
    </div>
</div>

        <!-- Section-->
        
        <div class="clear" style='height: 60px'></div>
<?php include "layout/footer.php"; ?>