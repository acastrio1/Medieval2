<!-- Busqueda *****************************************************************************-->

<div class="container px-2 px-lg-2 mt-5">    
    <div class="container px-3 my-5">
        <form action='../controller/productoController.php' method='POST'>
            <label>Buscar: </label>
            <select name="categoria_producto" id="categoria_producto">
                <option value="">Seleccione una categoria</option>
                <?php
                    include '../controller/categoriaController.php';
                    $searchAll = $categoria->searchAll();//Realice el query y 
                    while($rows = $searchAll->fetch_assoc()){
                        $cat=$rows['categoria'];
                        $cat_id=$rows['id'];
                        echo  "<option value='$cat_id'>$cat</option>";//En el value va el valor que quiero quede grabado en la base de datos que es el id
                    }
                ?>
           </select>
            <input type='submit' name='search' class='btn mr-md-2 mb-md-0 mb-2 btn-success bg-paleta2' value='Buscar'>
            <input type='submit' name='clean' class='btn mr-md-2 mb-md-0 mb-2 btn-success bg-paleta2' value='Limpiar busqueda'>
        </form>
        <?php 
        if (isset($_SESSION['error1'])): ?>
        <div class="errores">
            <?php foreach($_SESSION['error1'] as $error) : ?>
                <p><?php echo $error ?></p>
            <?php endforeach ?>
        </div>
        <?php 
            $_SESSION['error1'] = array(); //Limpia el vector de errores después de mostrarlos
        endif ?>  
    </div> 
<!-- Muestra la tabla de productos    ********************************************************************  -->
    <?php 
    $busquedaAll = $_SESSION['DataBasePro'];
    echo "<table class='text-center'>";
    echo "<tr><th>id</th><th>nombre</th><th>id_categoria</th><th>Precio</th><th>Mostrar Main</th></tr>";
    foreach ($busquedaAll as $row) {
        echo "<form action='../controller/productoController.php' method='POST'>";
        echo "<tr><td><input type='hidden' name='id_producto' value='".$row["id_producto"]."'>".$row["id_producto"]."</td>";
        echo "<td><input type='text' name='nombre_producto' value='".$row["nombre_producto"]."' readonly></td>";
        echo "<td><input type='text' name='id_categoria' value='".$row["id_categoria"]."' readonly></td>";
        echo "<td><input type='text' name='precio_producto' value='".$row["precio_producto"]."'></td>";
        $checkbox = $row["mostrar_main"] == 1 ? 'checked' : '';//Si de la base de datos llega un 1 a variable vale "checked" sino se deja vacía
        echo "<td><input type='checkbox' name='mostrar_main'".$checkbox."></td>";
        echo "<td><input type='submit' class='btn md-2 mb-md-0 mb-2 btn-success bg-paleta2' name='Save_changes' value='Guardar cambios'></td>";
        echo "<td><input type='submit' class='btn btn-success bg-paleta2' name='delete' value='Eliminar'></td></tr>";
        echo "</form>";
    }
    echo "</table>";?>
    <!-- Muestra el array de errores si hay algún problema -->
    <?php 
        if (isset($_SESSION['error'])): ?>
        <div class="errores">
            <?php foreach($_SESSION['error'] as $error) : ?>
                <p><?php echo $error ?></p>
            <?php endforeach ?>
        </div>
    <?php 
    $_SESSION['error'] = array(); //Limpia el vector de errores después de mostrarlos
    endif ?>
    <div class="errores">
        <?php
            if (isset($_SESSION['success'])) {
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            }
        ?>
    </div>
    <!--************************************************* -->  
</div>