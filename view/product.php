<?php

session_start();

if(isset($_SESSION['usuario'])) {
    
  if( $_SESSION['last_activity'] < time()-$_SESSION['expire_time'] ) { //se ha acabado el tiempo?
      session_destroy();
      unset($_SESSION['usuario']);
      header("Location: Home.php");
  } else{ 
    $_SESSION['last_activity'] = time(); //renueve el tiempo
  }
  
  if(!isset($_SESSION['numero_pedido'])){//Si no se ha generado un número de pedido, se debe generar
    $salir=0;
    while($salir<1){
        $numero_pedido=rand(100000,999999);//Genera número de pedido aleatorio
        $_POST['search']=TRUE;//Permite ingresar al código en pedidoController que tiene la lógica de buscar
        $_POST['numero_pedido']=$numero_pedido;//Guarda el número de pedido generado
        include('../controller/pedidosController.php');//Analiza si el número de pedido generado ya se encuentra en la base de datos
        $_POST['search']=NULL;
        if($_SESSION['pedido_encontrado']==0){//Si el pedido no se encuentra en la base de datos, ya puede salir y fue generado
            $_SESSION['numero_pedido']=$numero_pedido;
            $salir=1;
        }
    }
  }


}else{
    header("location:login.php");//Si no es un usuario registrado, no puede llegar a esta seccion
}

//Si la sesión ha sido cerrada (linea 56), el atributo Logout de session será 1 o TRUE y entrará al código, el cual destruye la sesión, quita el valor de usuario y carga el home
if(isset($_GET['logout'])) {

    session_destroy();
    unset($_SESSION['usuario']);
    header("Location: Home.php");
}


include "layout/header.php";
?>




       <!-- Product section-->
       <section class='py-5'>
            <div class='container px-4 px-lg-5 my-5'>
                <div class='row gx-5 gx-lg-5 align-items-center'>

                
                
         <?php   
            $_POST["search_id"]=TRUE;
            $_POST["id_producto"] = $_GET['producto'];//Toma el valor de la url que ya contiene el id del producto
            include('../controller/productoController.php');
            $producto_actual = $_SESSION['producto_actual'];
            $id_usuario = $_SESSION['id_usuario'];

            
                $imageBig = $producto_actual["imagen2_producto"];
                $nombre_producto = $producto_actual['nombre_producto'];
                $precio_producto = $producto_actual['precio_producto'];
                $id_producto = $producto_actual['id_producto'];
                $numero_pedido=$_SESSION['numero_pedido'];
                $decimal_format = number_format($precio_producto);
                
                
               

                echo    "<div class='col-md-5'><img class='card-img-top mb-5 mb-md-0' src='../assets/img/DB_images/".$imageBig."' alt='".$nombre_producto."' /></div>";
                echo     "<div class='col-md-7'>";
                echo         "<div class='small mb-1'>Número de pedido: ".$numero_pedido."</div>";
                echo         "<h1 class='display-5 fw-bolder'>".$nombre_producto."</h1>";
                echo         "<div class='fs-5 mb-5'>";
                echo             "<span>COP $".$decimal_format."</span>";
                echo        "</div>";
                echo        "<p class='lead mb-5'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam minima ea iste laborum vero</p>";
                echo        "<div class='d-flex'>";
                echo        "<form action='../controller/pedidosController.php' method='POST'>";
                echo            "<input type='hidden' name='numero_pedido' value='$numero_pedido'>";
                echo            "<input type='hidden' name='id_usuario' value='$id_usuario'>";
                echo            "<input type='hidden' name='id_producto' value='$id_producto'>";
                echo            "<input type='hidden' name='precio_producto' value='$precio_producto'>";
                echo             "<div class='input-group'>";
                echo                "<input class='form-control text-center mx-5' type='number' name='cantidad' min='1' max='10' value='1' />";
                echo                "<div class='input-group-append'>";
                echo                    "<button class='btn btn-outline-dark flex-shrink-0' type='submit' name='registrar_pedido'>";
                echo                        "<i class='bi-cart-fill me-1'></i>";
                echo                        "Agregar al carrito";
                echo                    "</button>";
                echo                 "</div>";
                echo            "</div>";
                echo        "</form>";
                echo        "</div>";
                if(isset($_SESSION['success'])){
                    $success = $_SESSION['success'];
                    echo "<div class='small mt-3'>$success</div>";
                    $_SESSION['success']="";
                }
                echo     "</div>";
                echo "<i class='fas fa-angle-left fa-lg'></i>";
                
                echo "</div>";
            echo "</div>";
        echo "</section>";
        ?>

        <!-- Related items section-->

        <section class="py-2 bg-light">
            <div class="container text-center my-3">
                <h2 class="fw-bolder mb-4">Productos que te podrían interesar</h2>
                <div class="row mx-auto my-auto justify-content-center">
                    <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                        

                            <?php
                            $_POST['search_main']=TRUE;
                            include('../controller/productoController.php');
                            $DB_main = $_SESSION['DataBaseMain'];
                            $count=1;
                            foreach ($DB_main as $row) {//Muestra los productos que en la base de datos se han seleccionado apra aparecer en el main page

                                $imageSmall = $row['imagen1_producto'];
                                $nombre_producto_2 = $row['nombre_producto'];
                                $precio_producto_2 = $row['precio_producto'];
                                $decimal_format_2 = number_format($precio_producto);
                                $id_producto_2 = $row['id_producto'];
                                if($count==1){
                                    echo "<div class='carousel-item active'>";
                                    $count++;
                                }else{
                                    echo "<div class='carousel-item'>";
                                    $count++;
                                }
                            
                                    echo "<div class='card h-100 m-2'>";
                                        echo "<img class='card-img-top' src='../assets/img/DB_images/".$imageSmall."' alt='".$nombre_producto_2."' />";
                                        echo "<div class='card-body p-4'>";
                                            echo "<div class='text-center'>";
                                                echo "<h5 class='fw-bolder'>".$nombre_producto_2."</h5>";
                                                echo $decimal_format_2;
                                            echo "</div>";
                                        echo "</div>";
                                        echo "<div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>";
                                            echo "<div class='text-center'><a class='btn btn-outline-dark mt-auto' href='product.php?producto=$id_producto_2'>Comprar</a></div>";
                                        echo "</div>";
                                    echo "</div>";
                            echo "</div>";
                            }
                            ?>
                        </div>
                        <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </a>
                        <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <div class="clear" style='height: 60px'></div>
<?php include "layout/footer.php"; ?>
