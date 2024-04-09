<?php
session_start();



if(isset($_SESSION['usuario'])==TRUE) {
    if( $_SESSION['last_activity'] < time()-$_SESSION['expire_time'] ) { //se ha acabado el tiempo?
        session_destroy();
        unset($_SESSION['usuario']);
        header("Location: Home.php");
        
    } else{ 
    $_SESSION['last_activity'] = time(); //renueve el tiempo
    $_SESSION['carrito']=0;//Se resetea el carrito al llegar a esta página
    
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
    <div class="col-12 table-responsive">
        <table class="table table-striped">
            <thead>
                <tr class='text-center'>
                    <th>item</th>
                    <th>Producto</th>
                    <th>cantidad</th>
                    <th>valor producto</th>
                    <th>subtotal</th>
                </tr>
            </thead>
            <tbody>

            <!-- tabla con el resumen de los productos comprados-->

    <?php

            $_POST["search"]=TRUE;
            $_POST["numero_pedido"] = $_SESSION['numero_pedido'];
            include('../controller/pedidosController.php');
            $DB_main = $_SESSION['DataBasePedido'];
            $numero_pedido = $_SESSION['numero_pedido'];
            $total=0;
            $item=0;
            echo "<h5 class='text-center'>Pedido confirmado No: $numero_pedido</h5>";
            $_SESSION['numero_pedido']=NULL;//Se resetea el número de pedido después de mostrarlo
        


        foreach ($DB_main as $row) {//Muestra los productos que en la base de datos se han seleccionado apra aparecer en el main page
            $id_pedido = $row['id_pedido'];
            $id_usuario = $row['id_usuario'];
            $nombre_producto = $row['nombre_producto'];
            $cantidad_producto = $row['Qty_producto'];
            $valor_producto = $row['valor_producto'];
            $total_producto = $row['Total_producto'];
            $total = $total + $total_producto;
            $item++;
            $valor_producto_n = number_format($valor_producto);
            $total_producto_n = number_format($total_producto);

            
            
            echo "<tr class='text-center'>";
            echo   "<td>$item</td>";
            echo    "<td>$nombre_producto</td>";
            echo    "<td>$cantidad_producto</td>";
            echo    "<td>$valor_producto_n</td>";
            echo    "<td>$total_producto_n</td>";
            echo "</tr>";
            
        }

        $total_price = number_format($total);

    ?>
            </tbody>
        </table>
    </div>
    </div>
        <!-- Total de la compra-->
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <div class="col mt-5">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width:50%">Total:</th>
                                <?php
                                echo "<td>$total_price</td>";
                                ?>
                            </tr>
                        </tbody>    
                    </table>
                </div>
            </div>
        </div>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <div class="col mt-3">
                <p>Muchas gracias por su compra!!!, ya estamos preparando su pedido</p>
            </div> 
            <div class="col mt-3">
                <a href="productos.php" class="btn mr-md-2 mb-md-0 mb-2 btn-success bg-paleta3">Seguir comprando</a>
            </div>
            <div class="col mt-3">
                <a href="Home.php?logout='1'" class="btn mr-md-2 mb-md-0 mb-2 btn-success bg-paleta3">Cerrar Sesión</a>
            </div>
        </div>

</div>
        <!-- Section-->
        
        <div class="clear" style='height: 60px'></div>
<?php include "layout/footer.php"; ?>