<?php 
include_once("conexion.php");
    if(!empty($_GET['id'])){
        $clave=$_GET['id'];
        $consulta=mysqli_query($conexion,"DELETE FROM productos WHERE id_producto = $clave");
        mysqli_close($conexion);
        header("Location:../cliente/productos.php");
    }
?>