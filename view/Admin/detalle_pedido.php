<!-- Busqueda *****************************************************************************-->

<div class='text-center'><a class='btn btn-success bg-paleta2 mt-5' href="adminpage.php?Admin/admin_pedidos">Regresar</a></div>";
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

            $DB_main = $_SESSION['DataBaseMuestraPedido'];
            $numero_pedido = $_SESSION['NumeroPedidoAdmin'];
            $total=0;
            $item=0;
            echo "<h5>Número de pedido: $numero_pedido</h5>";
        


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

</div>