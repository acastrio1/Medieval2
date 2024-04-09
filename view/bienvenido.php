<?php
session_start();
$_SESSION['last_activity'] = time(); //tiempo de la última actividad
$_SESSION['expire_time'] = 10000; //Tiempo de espera antes de hacer logout de forma automática en segundos
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bienvenido</title>
    <!-- CSS propio-->
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body style="width:100%">
    <div class="bienvenido">Bienvenido</div>
    <?php 
    if($_SESSION['userType']==1){
        header("Refresh: 1;adminpage.php");
    }else{
        header("Refresh: 1;Home.php");
    }
     ?>
</body>
</html>