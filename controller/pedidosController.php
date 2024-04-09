<?php

require_once '../model/pedidos.php';

// Inicio de sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();

}


//Array de errores
$errors = array();

//connect to database

$pedido = new pedido(); // Crea el objeto 

//Registrar nuevos pedidos***************************************************************************************************

if(isset($_POST['registrar_pedido'])) { //Si en la página  se activa el botón enviar, entonces se ingresa al sgte código

    //En este punto aún no conocemos la dirección de entrega, esta será actualzada para este pedido en otro botón final
    $pedido->setNumeroPedido($_POST["numero_pedido"]);
    $pedido->setIDUsuario($_POST["id_usuario"]);
    $pedido->setIDProducto($_POST["id_producto"]);
    $pedido->setQtyProducto($_POST["cantidad"]);
    $pedido->setValorProducto($_POST["precio_producto"]);
    $cantidad = $pedido->getQtyProducto();
    $valor = $pedido->getValorProducto();
    $total = $cantidad * $valor;
    $pedido->setTotalProducto($total);
    $id_producto = $_POST["id_producto"];
    $cantidad_carrito = $_SESSION['carrito'];


    $result = $pedido->save();//Las imagenes solo guardan su nombre
    if($result){
        $_SESSION['success']="Registrado exitosamente";
        $cantidad_carrito = $cantidad_carrito + $cantidad;
        $_SESSION['carrito'] = $cantidad_carrito;
    }else{
        $_SESSION['success']="Error al registrar pedido";
    }

    header("Location: ../view/product.php?producto=$id_producto");
    

}

//Busca si ya existe un número de pedido
if(isset($_POST['search'])){

    $pedido->setNumeroPedido($_POST["numero_pedido"]);
    $data = $pedido->search();

    if($data->num_rows > 0){//Si encontró algún nombre coincidente
            $rows = array();
            while($row2 = $data->fetch_assoc()){
                $rows[] = $row2;
            }
            $_SESSION['DataBasePedido'] = $rows;
    }else{
        $_SESSION['pedido_encontrado']=0;
    }
}

//Busca si ya existe un número de pedido
if(isset($_POST['search_pedido'])){

    $pedido->setNumeroPedido($_POST["numero_pedido"]);
    $data = $pedido->search();//busca por número de pedido

    $rows = array();//Array que guardará la información requerida de la tabla
    $cantidad_productos=0;
    $valor_total=0;

    while($row = $data->fetch_assoc()){//Almacena todos los productos por npumero de pedido

        $cantidad_productos = $cantidad_productos + $row['Qty_producto'];
        $valor_total = $valor_total + $row['Total_producto'];
        $direccion = $row['direccion'];

    }

    $row['cantidad_productos'] = $cantidad_productos;
    $row['Total_producto'] = $valor_total;
    $row['numero_pedido'] = $pedido->getNumeroPedido();
    $row['direccion'] = $direccion;
    $row['Pedido_entregado'] = 1;
    $rows[] = $row;

    $_SESSION['DataBasePedidos'] = $rows;
    header("Location: ../view/adminpage.php?Admin/admin_pedidos"); 

}

//Borra productos en un pedido
if(isset($_POST['delete'])){
    $id=$_POST["id_pedido"];
    $deleted = $pedido->delete($id);

    header("Location: ../view/carrito.php");
}

//Confirma la compra
if(isset($_POST['pedido_confirmado'])){

    $DB_main = $_SESSION['DataBasePedido'];
    $numero_pedido = $_SESSION['numero_pedido'];
    $pedido->setDireccion($_POST['direccion']);

    foreach ($DB_main as $row) {
        
        
        $pedido->update_direccion($row['id_pedido']);
    }
        
    header("Location: ../view/checkout.php");
}



if(isset($_POST['muestra_pedidos'])){
    $all_pedidos = $pedido->AllPedidos();//resultado de la consulta SQL con los números de pedido y direccion sin repetir

    $rows = array();//Array que guardará la información requerida de la tabla

    while($row2 = $all_pedidos->fetch_assoc()){//Almacena todos los numeros de pedidos confirmados sin repetir y las direcciones de entrega
        $pedido->setNumeroPedido($row2['numero_pedido']);//Para cada número de pedido sumamos los valores totales y la cantidad de productos
        $pedido->setDireccion($row2['direccion']);
        $pedido->setPedidoEntregado($row2['Pedido_entregado']);

        $pedido_num = $pedido->searchAll();//Por número de pedido busca todas las entradas que lo tenga
        $cantidad_productos=0;
        $valor_total=0;

        while($row3 = $pedido_num->fetch_assoc()){
            $cantidad_productos = $cantidad_productos + $row3['Qty_producto'];
            $valor_total = $valor_total + $row3['Total_producto'];
        }

        $row2['cantidad_productos'] = $cantidad_productos;
        $row2['Total_producto'] = $valor_total;

        $rows[] = $row2;
    }

    if(isset($_SESSION['DataBasePedidos'])){
        $_SESSION['DataBasePedidos'] = $rows;
        header("Location: ../view/adminpage.php?Admin/admin_pedidos"); 
    }else{
        $_SESSION['DataBasePedidos'] = $rows;
        
    }


    

}

//Confirma la entrega
if(isset($_POST['pedido_entregado'])){

    $pedido->setNumeroPedido($_POST['numero_pedido']);
    $pedido->update_entregado();
    $_SESSION['DataBasePedidos']=NULL;
    header("Location: ../view/adminpage.php?Admin/admin_pedidos");
}

//detalle del pedido
if(isset($_POST['ver_pedido'])){

    $pedido->setNumeroPedido($_POST['numero_pedido']);
    $data = $pedido->search();

    if($data->num_rows > 0){//Si encontró algún nombre coincidente
        $rows = array();
        while($row2 = $data->fetch_assoc()){
            $rows[] = $row2;
        }
        $_SESSION['DataBaseMuestraPedido'] = $rows;
        $_SESSION['NumeroPedidoAdmin'] = $pedido->getNumeroPedido();
    }

    header("Location: ../view/adminpage.php?Admin/detalle_pedido");
}




?>