<?php

require_once '../model/producto.php';

// Inicio de sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();

}


//Array de errores
$errors = array();

//connect to database

$producto = new producto(); // Crea el objeto 

//Registrar nuevos productos***************************************************************************************************

if(isset($_POST['registrar_producto'])) { //Si en la página  se activa el botón enviar, entonces se ingresa al sgte código

    $producto->setNombre($_POST["nombre_producto"]);
    $producto->setDescripcion($_POST["descripcion_producto"]);
    $producto->setClave($_POST["clave_producto"]);
    $producto->setCategoria($_POST["categoria_producto"]);
    $producto->setPrecio($_POST["precio_producto"]);
    $checkbox=isset($_POST["mostrar_main"]) ? 1 : 0;//Es un if, si hay algo en mostrar_main pone 1 (significa que a sido chequeada), si se ha dejado vacía ponga cero
    $producto->setMostrarMain($checkbox);
    //Accesar imagenes nombres
    $producto->setImagenSmall($_FILES["imagen1_producto"]['name']);//Es el nombre de la imagen lo que se guarda en la base de datos
    $producto->setImagenBig($_FILES["imagen2_producto"]['name']);
    //accesar nombres temporales
    $producto_temp_img_1=$_FILES["imagen1_producto"]['tmp_name'];
    $producto_temp_img_2=$_FILES["imagen2_producto"]['tmp_name'];

    if(empty($producto->getNombre()) || empty($producto->getDescripcion()) || empty($producto->getClave()) || empty($producto->getCategoria()) || empty($producto->getImagenSmall()) || empty($producto->getImagenBig()) || empty($producto->getPrecio())) {array_push($errors, "Ingrese todos los valores requeridos y de click en guardar");}

    //Chequear que en la BD no exista un nombre de producto igual al ingresado

    $busqueda = $producto->search();


    if($busqueda) { //Si la categoría ya existe
        if($busqueda["nombre_producto"]===$producto->getNombre()) {array_push($errors, "El nombre del producto ya existe");}

    }
    

    //Si no hay errores, se procede al registro

    if(count($errors)==0) {

        //Mover el archivo de la imagen de los temporales al lugar donde se almacenará
        $image1=$producto->getImagenSmall();
        $image2=$producto->getImagenBig();

        move_uploaded_file($producto_temp_img_1,"../assets/img/DB_images/$image1");
        move_uploaded_file($producto_temp_img_2,"../assets/img/DB_images/$image2");

        $result = $producto->save();//Las imagenes solo guardan su nombre
        

        if($result){
            
            array_push($errors, "Almacenado correctamente");
            $_SESSION['error'] = $errors;
            header("Location: ../view/adminpage.php?Admin/insertar_producto");
        }

    }else{
        $_SESSION['error'] = $errors;
        header("Location: ../view/adminpage.php?Admin/insertar_producto");
        exit();
    }
}

//Muestra todos los productos almacenados en la base de datos***************************************************************************************************

if(isset($_POST["actualizar"])){

    $searchAll = $producto->searchAll();//Realice el query y 
    $rows = array();
    while($row2 = $searchAll->fetch_assoc()){
        $rows[] = $row2;
    }
    $_SESSION['DataBasePro'] = $rows;
}

//Guarda los cambios de cada categoría***************************************************************************************************

if(isset($_POST['Save_changes'])) { 

    //Recibir las variables del formulario y agregarlas al objeto $usuario
    $producto->setPrecio($_POST["precio_producto"]);
    $checkbox=isset($_POST["mostrar_main"]) ? 1 : 0;//Es un if, si hay algo en mostrar_main pone 1 (significa que a sido chequeada), si se ha dejado vacía ponga cero
    $producto->setMostrarMain($checkbox);
    $id = $_POST["id_producto"];

    //validacion de errores, si hay alguno vacío, agregarlo al vector errores

    if(empty($producto->getPrecio())) {array_push($errors, "No puede dejar el precio vacío");}

    //Si no hay errores, se procede al guardado

    if(count($errors)==0) {

        $result = $producto->update($id);

        if($result){
            $_SESSION['success'] = "Actualizado correctamente";
            $searchAll = $producto->searchAll();//Realice el query y 
            $rows = array();
            while($row2 = $searchAll->fetch_assoc()){
                $rows[] = $row2;
            }
            $_SESSION['DataBasePro'] = $rows;
            header("Location: ../view/adminpage.php?Admin/editar_producto"); 
        }
    }else{
        $_SESSION['error'] = $errors;
        header("Location: ../view/adminpage.php?Admin/editar_producto");
        exit();
    }
}

//Busqueda del administrador*************************************************************************************************
if(isset($_POST['search'])){
    $producto->setCategoria($_POST["categoria_producto"]);
    if(empty($producto->getCategoria())) {array_push($errors, "Ingrese una categoria para buscar");}

    if(count($errors)==0) {
        $search_cat = $producto->search_cat();//Realice el query
        if($search_cat->num_rows > 0){//Si encontró algún nombre coincidente
            $rows = array();
            while($row2 = $search_cat->fetch_assoc()){
                $rows[] = $row2;
            }
            $_SESSION['DataBasePro'] = $rows;
            header("Location: ../view/adminpage.php?Admin/editar_producto");
        }else{
            array_push($errors, "No existen productos en la categoria");
            $_SESSION['error1'] = $errors;
            header("Location: ../view/adminpage.php?Admin/editar_producto");
            exit();
        }
        
    
    }else{
        $_SESSION['error1'] = $errors;
        header("Location: ../view/adminpage.php?Admin/editar_producto");
        exit();
    }
}

if(isset($_POST['clean'])){
    $searchAll = $producto->searchAll();//Realice el query y 
    $rows = array();
    while($row2 = $searchAll->fetch_assoc()){
        $rows[] = $row2;
    }
    $_SESSION['DataBasePro'] = $rows;
    header("Location: ../view/adminpage.php?Admin/editar_producto"); 
}

if(isset($_POST['delete'])){
    $id=$_POST["id_producto"];
    $deleted = $producto->delete($id);
    $searchAll = $producto->searchAll();//Realice el query y 
    $rows = array();
    while($row2 = $searchAll->fetch_assoc()){
        $rows[] = $row2;
    }
    $_SESSION['DataBasePro'] = $rows;
    // $_SESSION['error1'] = "Usuario eliminado correctamente";
    header("Location: ../view/adminpage.php?Admin/editar_producto");
}

//***********Me prepara los archivos del main*************************** */

if(isset($_POST['search_main'])){
    $search_main = $producto->search_main();//Realice el query
    if($search_main->num_rows > 0){//Si encontró algún nombre coincidente
        $rows = array();
        while($row2 = $search_main->fetch_assoc()){
            $rows[] = $row2;
        }
        $_SESSION['DataBaseMain'] = $rows;

    }
}

//***********busca el producto por id para mostrarlo en la página de product.php*************************** */

if(isset($_POST['search_id'])){
    
    $producto->setIDProducto($_POST["id_producto"]);
    $search_id = $producto->search_id();//Realice el query

    $_SESSION['producto_actual'] = $search_id;

}

if(isset($_POST['search_categoria'])){
    $producto->setCategoria($_POST["categoria_producto"]);

        $search_cat = $producto->search_cat();//Realice el query
        if($search_cat->num_rows > 0){//Si encontró algún nombre coincidente
            $rows = array();
            while($row2 = $search_cat->fetch_assoc()){
                $rows[] = $row2;
            }
            $_SESSION['DataBaseCatMain'] = $rows;
        }
}




?>