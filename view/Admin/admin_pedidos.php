<!-- Busqueda *****************************************************************************-->
<div class="container px-2 px-lg-2 mt-5">    
    <div class="container px-3 my-5">
        <form action='../controller/pedidosController.php' method='POST'>
            <label>Número pedido</label>
            <input type="text" name="numero_pedido">
            <input type='submit' name='search_pedido' class='btn mr-md-2 mb-md-0 mb-2 btn-success bg-paleta2' value='Buscar'>
            <input type='submit' name='muestra_pedidos' class='btn mr-md-2 mb-md-0 mb-2 btn-success bg-paleta2' value='Limpiar busqueda'>
        </form>
    </div> 
<!-- Muestra la tabla de pedidos    ********************************************************************  -->
    <div class="container my-5 text-center">
        <?php 
        $busquedaAll = $_SESSION['DataBasePedidos'];
        
        echo "<table class='text-center ml-2'>";
        echo "<tr><th>Número Pedido</th><th>Dirección</th><th>Cantidad Productos</th><th>Total Pedido</th><th>Despachado?</th><th>Detalle</th><th>Guardar</th></tr>";
        foreach ($busquedaAll as $row) {
            echo "<form action='../controller/pedidosController.php' method='POST'>";
            echo "<tr><td><input type='text' name='numero_pedido' value='".$row["numero_pedido"]."' readonly></td>";
            echo "<td><input type='text' name='direccion' value='".$row["direccion"]."' readonly></td>";
            echo "<td><input type='text' name='cantidad_productos' value='".$row["cantidad_productos"]."' readonly></td>";
            echo "<td><input type='text' name='Total_producto' value='".$row["Total_producto"]."' readonly></td>";
            $checkbox = $row["Pedido_entregado"] == 1 ? 'checked' : '';//Si de la base de datos llega un 1 a variable vale "checked" sino se deja vacía
            echo "<td><input type='checkbox' name='pedido_entregado'".$checkbox."></td>";
            echo "<td><input type='submit' class='btn btn-success bg-paleta2' name='ver_pedido' value='Detalle'></td>";
            echo "<td><input type='submit' class='btn btn-success bg-paleta2' name='pedido_entregado' value='Guardar'></td></tr>";
            echo "</form>";
        }
        echo "</table>";
        ?>
    </div>
</div>