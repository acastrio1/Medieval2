<?php
require_once '../model/usuario.php';

// Inicio de sesión
session_start();

//Array de errores
$errors = array();

//connect to database

$usuario = new Usuario(); // Crea el objeto usuario que es el encargado de hacer la conexión

//Registrar nuevos usuarios***************************************************************************************************

if(isset($_POST['registrar'])) { //Si en la página registrar.php se activa el botón enviar, entonces se ingresa al sgte código

    //Recibir las variables del formulario y agregarlas al objeto $usuario
    $usuario->setNombre($_POST["nombre"]);
    $usuario->setApellidos($_POST["apellidos"]);
    $usuario->setEmail($_POST["email"]);
    $usuario->setPassword($_POST["password"]);
    $usuario->setFecha(date('y-m-d'));
    $usuario->setUserType(2);//Por default todos son usuarios normales (2) el administrador se cambia manualmente en la base a 1

    //validacion de errores, si hay alguno vacío, agregarlo al vector errores

    if(empty($usuario->getNombre())) {array_push($errors, "Falta nombre de usuario");}
    if(empty($usuario->getApellidos())) {array_push($errors, "Falta apellidos de usuario");}
    if(empty($usuario->getEmail())) {array_push($errors, "Falta email de usuario");}
    if(empty($usuario->getPassword())) {array_push($errors, "Falta contraseña de usuario");}

    //Chequear que en la BD no exista un email igual al ingresado

    $busqueda = $usuario->search();


    if($busqueda) { //Si el usuario existe y su email es el mismo
        if($busqueda["email"]===$usuario->getEmail()) {array_push($errors, "Email ya existe, por favor ingresar con su contraseña o recupere contraseña");}
    }

    //Si no hay errores, se procede al registro

    if(count($errors)==0) {

        $result = $usuario->save();

        if($result){
            $_SESSION['usuario']=$usuario->getNombre();
            $_SESSION['userType']=$usuario->getUserType();
            $_SESSION['carrito'] = 0;
            $_SESSION['success']="Estas logeado correctamente";

            $busqueda = $usuario->search();//Necesaio para tener el id de usuario generado
            $_SESSION['id_usuario'] = $busqueda['id'];
            header("Location: ../view/bienvenido.php"); //Regresa al home pero ya logeado
        }
    }else{
        $_SESSION['error'] = $errors;
        header("Location: ../view/registrar.php");
        exit();
    }
}

//Logear usuarios registrados*************************************************************************************************

if(isset($_POST['login_usuario'])) { //SI el botón login_usuario es clicked en Login.php se ejecuta el siguiente código

    $usuario->setEmail($_POST["email"]);
    $usuario->setPassword($_POST["password"]);

    if(empty($usuario->getEmail())) {
        array_push($errors, "Se requiere email");
    }
    if(empty($usuario->getPassword())){
        array_push($errors, "Se requiere contraseña");
    }
    if(count($errors)==0) {

        $login = $usuario->login();//Realice el query, llamando el método login
        
        if ($login->num_rows > 0) {//Si tiene al menos una entrada que coincida
            $row = $login->fetch_assoc();//fecth la fila, la vuelve array con la info de la tabla
            $_SESSION['usuario'] = $row['nombre'];
            $_SESSION['userType'] = $row['user_type'];
            $_SESSION['id_usuario'] = $row['id'];
            $_SESSION['carrito'] = 0;
            if($_SESSION['userType'] == 2){//Si el tipo de usuario es regular, lo dirige al Home
                header("Location: ../view/bienvenido.php");
            }else{
                $searchAll = $usuario->searchAll();//Realice el query y 
                $rows = array();
                while($row2 = $searchAll->fetch_assoc()){
                    $rows[] = $row2;
                }
                $_SESSION['DataBase'] = $rows;
                header("Location: ../view/bienvenido.php"); 
            }
            

        }else{
            array_push($errors, "Email y/o Contraseña equivocados");
            $_SESSION['error'] = $errors;
            header("Location: ../view/login.php");
            exit();
        }
    }else{
        $_SESSION['error'] = $errors;
        header("Location: ../view/login.php");
        exit();
    }
}

//Guardar cambios administrador*************************************************************************************************

if(isset($_POST['Save_changes'])) { //Si en la página adminpage.php se activa el botón guardar cambios, entonces se ingresa al sgte código

    //Recibir las variables del formulario y agregarlas al objeto $usuario
    $usuario->setNombre($_POST["nombre"]);
    $usuario->setApellidos($_POST["apellidos"]);
    $usuario->setEmail($_POST["email"]);
    $usuario->setPassword($_POST["password"]);
    $usuario->setUserType($_POST["user_type"]);
    $id = $_POST["id"];

    //validacion de errores, si hay alguno vacío, agregarlo al vector errores

    if(empty($usuario->getNombre())) {array_push($errors, "Falta nombre de usuario");}
    if(empty($usuario->getApellidos())) {array_push($errors, "Falta apellidos de usuario");}
    if(empty($usuario->getEmail())) {array_push($errors, "Falta email de usuario");}
    if(empty($usuario->getPassword())) {array_push($errors, "Falta contraseña de usuario");}
    if(empty($usuario->getUserType())) {array_push($errors, "Falta el tipo de usuario");}


    
    //Si no hay errores, se procede al guardado

    if(count($errors)==0) {

        $result = $usuario->update($id);

        if($result){
            $_SESSION['success'] = "Actualizado correctamente";
            $searchAll = $usuario->searchAll();//Realice el query y 
            $rows = array();
            while($row2 = $searchAll->fetch_assoc()){
                $rows[] = $row2;
            }
            $_SESSION['DataBase'] = $rows;
            header("Location: ../view/adminpage.php?Admin/ver_usuarios"); 
        }
    }else{
        $_SESSION['error'] = $errors;
        header("Location: ../view/adminpage.php?Admin/ver_usuarios");
        exit();
    }
}

//Busqueda del administrador*************************************************************************************************
if(isset($_POST['search'])){
    $usuario->setNombre($_POST["nombre_busqueda"]);
    if(empty($usuario->getNombre())) {array_push($errors, "Ingrese un nombre para buscar");}

    if(count($errors)==0) {
        $search_name = $usuario->search_name();//Realice el query
        if($search_name->num_rows > 0){//Si encontró algún nombre coincidente
            $rows = array();
            while($row2 = $search_name->fetch_assoc()){
                $rows[] = $row2;
            }
            $_SESSION['DataBase'] = $rows;
            header("Location: ../view/adminpage.php?Admin/ver_usuarios");
        }else{
            array_push($errors, "No existe un usuario con ese nombre");
            $_SESSION['error1'] = $errors;
            header("Location: ../view/adminpage.php?Admin/ver_usuarios");
            exit();
        }
        
    
    }else{
        $_SESSION['error1'] = $errors;
        header("Location: ../view/adminpage.php?Admin/ver_usuarios");
        exit();
    }
}

if(isset($_POST['clean'])){
    $searchAll = $usuario->searchAll();//Realice el query y 
    $rows = array();
    while($row2 = $searchAll->fetch_assoc()){
        $rows[] = $row2;
    }
    $_SESSION['DataBase'] = $rows;
    header("Location: ../view/adminpage.php?Admin/ver_usuarios"); 
}

if(isset($_POST['delete'])){
    $id=$_POST["id"];
    $deleted = $usuario->delete($id);
    $searchAll = $usuario->searchAll();//Realice el query y 
    $rows = array();
    while($row2 = $searchAll->fetch_assoc()){
        $rows[] = $row2;
    }
    $_SESSION['DataBase'] = $rows;
    // $_SESSION['error1'] = "Usuario eliminado correctamente";
    header("Location: ../view/adminpage.php?Admin/ver_usuarios");
}

?>