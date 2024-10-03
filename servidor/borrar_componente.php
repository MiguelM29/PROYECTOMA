<?php 
include_once("conexion.php");
    if(!empty($_GET['id'])){
        $clave=$_GET['id'];
        $consulta=mysqli_query($conexion,"DELETE FROM componentes WHERE id_componentes = $clave");
        mysqli_close($conexion);
        header("Location:../cliente/componentes.php");
    }
?>