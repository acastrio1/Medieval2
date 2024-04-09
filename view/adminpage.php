<?php

session_start();



if($_SESSION['userType'] != 1){//Si el tipo de usuario es regular, no el admin, lo lleva a login.php
    header("location:login.php");
}

if(isset($_SESSION['usuario'])==TRUE) {
    if( $_SESSION['last_activity'] < time()-$_SESSION['expire_time'] ) { //se ha acabado el tiempo?
        session_destroy();
        unset($_SESSION['usuario']);
        header("Location: Home.php");
    } else{ 
    $_SESSION['last_activity'] = time(); //renueve el tiempo
    }
}
include "layout/header.php";

?>


<div class="button text-center mt-5">
    <a href="adminpage.php?Admin/insertar_cat" class="btn mr-md-2 mb-md-0 mb-2 btn-success bg-paleta3">Editar categorias</a>
    <a href="adminpage.php?Admin/ver_usuarios" class="btn mr-md-2 mb-md-0 mb-2 btn-success bg-paleta3">Editar usuarios</a>
    <a href="adminpage.php?Admin/insertar_producto" class="btn mr-md-2 mb-md-0 mb-2 btn-success bg-paleta3">Insertar productos</a>
    <a href="adminpage.php?Admin/editar_producto" class="btn mr-md-2 mb-md-0 mb-2 btn-success bg-paleta3">Editar productos</a>
    <a href="adminpage.php?Admin/admin_pedidos" class="btn mr-md-2 mb-md-0 mb-2 btn-success bg-paleta3">Administrar pedidos</a>
</div>

<div class="container">
    <?php
    if(isset($_GET['Admin/ver_usuarios'])){
        include('Admin/ver_usuarios.php');
    }
    if(isset($_GET['Admin/insertar_cat'])){
        include('Admin/insertar_cat.php');
    }
    if(isset($_GET['Admin/insertar_producto'])){
        include('Admin/insertar_producto.php');
    }
    if(isset($_GET['Admin/editar_producto'])){
        if(!isset($_SESSION['DataBasePro'])){//Si la variable que almacena los productos no ha sido diligenciada, diligenciela
            $_POST["actualizar"]=TRUE;
            include('../controller/productoController.php');
        }
        include('Admin/editar_producto.php');
    }
    if(isset($_GET['Admin/admin_pedidos'])){
        if(!isset($_SESSION['DataBasePedidos'])){//Si la variable que almacena los productos no ha sido diligenciada, diligenciela
            $_POST["muestra_pedidos"]=TRUE;
            include('../controller/pedidosController.php');
        }
        include('Admin/admin_pedidos.php');
    }
    if(isset($_GET['Admin/detalle_pedido'])){
        include('Admin/detalle_pedido.php');
    }
    ?>
</div>
<div class="clear" style='height: 60px'></div>

<?php include "layout/footer.php"; ?>