<!-- Busqueda *****************************************************************************-->
<div class="container px-2 px-lg-2 mt-5">    
    <div class="container px-3 my-5">
        <form action='../controller/login_register.php' method='POST'>
            <label>Nombre</label>
            <input type="text" name="nombre_busqueda">
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
<!-- Muestra la tabla de usuarios    ********************************************************************  -->
    <?php 
    $busquedaAll = $_SESSION['DataBase'];
    echo "<table>";
    echo "<tr><th>id</th><th>nombre</th><th>apellidos</th><th>email</th><th>password</th><th>tipo usuario</th></tr>";
    foreach ($busquedaAll as $row) {
        echo "<form action='../controller/login_register.php' method='POST'>";
        echo "<tr><td><input type='hidden' name='id' value='".$row["id"]."'>".$row["id"]."</td>";
        echo "<td><input type='text' name='nombre' value='".$row["nombre"]."'></td>";
        echo "<td><input type='text' name='apellidos' value='".$row["apellidos"]."'></td>";
        echo "<td><input type='email' name='email' value='".$row["email"]."'></td>";
        echo "<td><input type='text' name='password' value='".$row["password"]."'></td>";
        echo "<td><input type='text' name='user_type' value='".$row["user_type"]."'></td>";
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