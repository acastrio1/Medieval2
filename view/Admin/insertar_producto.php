<div class="container mt-3">
    <h1 class="text-center">Insertar producto</h1>
    <form action="../controller/productoController.php" method="post" enctype="multipart/form-data">
        <!-- Nombre -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="nombre_producto" class="form-label">Nombre del Producto</label>
            <input type="text" name="nombre_producto" id="nombre_producto" class="form-control" placeholder="Ingrese nombre del producto" autocomplete="off" required>
        </div>
        <!-- Descripcion -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="descripcion_producto" class="form-label">Descripcion del Producto</label>
            <input type="text" name="descripcion_producto" id="descripcion_producto" class="form-control" placeholder="Ingrese la descripcion del producto" autocomplete="off" required>
        </div>
        <!-- Palabras clave -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="clave_producto" class="form-label">Palabras clave del Producto</label>
            <input type="text" name="clave_producto" id="clave_producto" class="form-control" placeholder="Ingrese las palabras clave del producto" autocomplete="off" required>
        </div>
        <!-- Categoría -->
        <div class="form-outline mb-4 w-50 m-auto">
           <select name="categoria_producto" id="categoria_producto">
                <option value="">Seleccione una categoria</option>
                <?php
                    include '../controller/categoriaController.php';
                    $searchAll = $categoria->searchAll();//Realice el query y 
                    while($rows = $searchAll->fetch_assoc()){
                        $cat=$rows['categoria'];
                        $cat_id=$rows['id'];
                        echo  "<option value='$cat_id'>$cat</option>";//En el vlue va el valor que quiero quede grabado en la base de datos que es el id
                    }
                ?>
           </select>
        </div>
        <!-- Imagen small-->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="imagen1_producto" class="form-label">Imagen pequeña del Producto</label>
            <input type="file" name="imagen1_producto" id="imagen1_producto" class="form-control" required>
        </div>
        <!-- Imagen big-->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="imagen2_producto" class="form-label">Imagen grande del Producto</label>
            <input type="file" name="imagen2_producto" id="imagen2_producto" class="form-control" required>
        </div>
        <!-- Precio -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="precio_producto" class="form-label">Precio del Producto</label>
            <input type="text" name="precio_producto" id="precio_producto" class="form-control" placeholder="Ingrese el precio del producto" autocomplete="off" required>
        </div>
        <!-- Mostrar en Main -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="mostrar_main" class="form-label">Mostrar en Home</label>
            <input type="checkbox" name="mostrar_main" id="mostrar_main" autocomplete="off">
        </div>
        <!-- submit -->
        <div class="form-outline mb-4 w-50 m-auto">
            <input type="submit" value="Guardar" name="registrar_producto" class="btn mr-md-2 mb-md-0 mb-2 btn-success bg-paleta3">
        </div>

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

    </form>
</div>  
 
