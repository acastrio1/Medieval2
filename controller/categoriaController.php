<?php
require_once '../model/categoria.php';

// Inicio de sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


//Array de errores
$errors = array();

//connect to database

$categoria = new categoria(); // Crea el objeto usuario que es el encargado de hacer la conexión

//Registrar nuevos categorias***************************************************************************************************

if(isset($_POST['registrar'])) { //Si en la página  se activa el botón enviar, entonces se ingresa al sgte código

    $categoria->setCat($_POST["categoria"]);

    if(empty($categoria->getCat())) {array_push($errors, "Ingrese una nueva categoría y de click en guardar");}

    //Chequear que en la BD no exista un email igual al ingresado

    $busqueda = $categoria->search();
    

    if($busqueda) { //Si la categoría ya existe
        if($busqueda["categoria"]===$categoria->getCat()) {array_push($errors, "La categoría ya existe");}

    }
    

    //Si no hay errores, se procede al registro

    if(count($errors)==0) {

        $result = $categoria->save();
        

        if($result){
            
            array_push($errors, "Almacenado correctamente");
            $_SESSION['error1'] = $errors;
            header("Location: ../view/adminpage.php?Admin/insertar_cat");
        }

    }else{
        $_SESSION['error1'] = $errors;
        header("Location: ../view/adminpage.php?Admin/insertar_cat");
        exit();
    }
}

//Muestra todas las categorías almacenadas en la base de datos***************************************************************************************************

if(isset($_POST["actualizar"])){

    $searchAll = $categoria->searchAll();//Realice el query y 
    $rows = array();
    while($row2 = $searchAll->fetch_assoc()){
        $rows[] = $row2;
    }
    $_SESSION['DataBaseCat'] = $rows;
    //header("Location: ../view/adminpage.php?Admin/insertar_cat");
}

//Guarda los cambios de cada categoría***************************************************************************************************

if(isset($_POST['Save_changes'])) { 

    //Recibir las variables del formulario y agregarlas al objeto $categoria
    $categoria->setCat($_POST["categoria"]);
    $id = $_POST["id"];

    //validacion de errores, si hay alguno vacío, agregarlo al vector errores

    if(empty($categoria->getCat())) {array_push($errors, "Categoria no puede estar vacío");}

    //Si no hay errores, se procede al guardado

    if(count($errors)==0) {

        $result = $categoria->update($id);

        if($result){
            $_SESSION['success'] = "Actualizado correctamente";
            $searchAll = $categoria->searchAll();//Realice el query y 
            $rows = array();
            while($row2 = $searchAll->fetch_assoc()){
                $rows[] = $row2;
            }
            $_SESSION['DataBaseCat'] = $rows;
            header("Location: ../view/adminpage.php?Admin/insertar_cat"); 
        }
    }else{
        $_SESSION['error'] = $errors;
        header("Location: ../view/adminpage.php?Admin/insertar_cat");
        exit();
    }
}

if(isset($_POST['delete'])){
    $categoria->setCat($_POST["categoria"]);
    $id=$_POST["id"];
    $deleted = $categoria->delete($id);
    $searchAll = $categoria->searchAll();//Realice el query y 
    $rows = array();
    while($row2 = $searchAll->fetch_assoc()){
        $rows[] = $row2;
    }
    $_SESSION['DataBaseCat'] = $rows;
    header("Location: ../view/adminpage.php?Admin/insertar_cat");
}