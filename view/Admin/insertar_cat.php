
<div class="container px-2 px-lg-2 mt-5">  
    <div class="container px-3 my-5">
        <form action='../controller/categoriaController.php' method='POST'>
            <label>Ingrese una nueva categoría</label>
            <input type="text" name="categoria">
            <input type='submit' name='registrar' class='btn mr-md-2 mb-md-0 mb-2 btn-success bg-paleta2' value='Registrar'>
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

    <?php 

    //****************Inicia el mostrar todas las categorias***********************
    $_POST["actualizar"]=TRUE;
    include '../controller/categoriaController.php';


    $busquedaAll = $_SESSION['DataBaseCat'];

    if(isset($busquedaAll)){
        
        echo "<table>";
        echo "<tr><th>id</th><th>Categoria</th></tr>";
        foreach ($busquedaAll as $row) {
            echo "<form action='../controller/categoriaController.php' method='POST'>";
            echo "<tr><td><input type='hidden' name='id' value='".$row["id"]."'>".$row["id"]."</td>";
            echo "<td><input type='text' name='categoria' value='".$row["categoria"]."'></td>";
            echo "<td><input type='submit' class='btn mr-md-2 mb-md-0 mb-2 btn-success bg-paleta2' name='Save_changes' value='Guardar cambios'></td>";
            echo "<td><input type='submit' class='btn mr-md-2 mb-md-0 mb-2 btn-success bg-paleta2' name='delete' value='Eliminar'></td></tr>";
            echo "</form>";
        }
        echo "</table>";
        //Muestra el array de errores si hay algún problema
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
    <?php
    } ?>

    
</div>
