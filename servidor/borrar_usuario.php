<?php 
include_once("conexion.php");
    if(!empty($_GET['id'])){
        $clave=$_GET['id'];
        $consulta=mysqli_query($conexion,"DELETE FROM usuarios WHERE id_uusuario = $clave");
        mysqli_close($conexion);
        header("Location:../cliente/usuarios.php");
    }
?>