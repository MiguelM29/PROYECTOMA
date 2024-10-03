<?php
include_once("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['txt_ide'];
    $c1 = $_POST['txt_nombree'];
    $c2 = $_POST['txt_precioe'];
    $c3 = $_POST['txt_cantidade'];
    $c5 = $_POST['selectcae'];
    $c6 = $_POST['selectcoe'];

    // Subir la imagen si hay una nueva
    $foto = $_FILES['txt_fotoe'];
    $nombreFoto = $foto['name'];
    $tipoFoto = $foto['type'];
    $rutaTemporal = $foto['tmp_name'];
    $carpetaDestino = "../cliente/loadimg/";

    // Verificar que id_categoria e id_componentes existan
    $checkCategoria = mysqli_query($conexion, "SELECT * FROM categoria WHERE id_categoria = '$c5'");
    $checkComponentes = mysqli_query($conexion, "SELECT * FROM componentes WHERE id_componentes = '$c6'");

    if (mysqli_num_rows($checkCategoria) == 0 || mysqli_num_rows($checkComponentes) == 0) {
        echo "Error: Categoria o Componente no válido.";
        exit();
    }

    // Si se seleccionó una nueva imagen
    if (!empty($nombreFoto)) {
        if ($tipoFoto == "image/jpg" || $tipoFoto == "image/jpeg" || $tipoFoto == "image/png") {
            $rutaFinal = $carpetaDestino . $nombreFoto;

            // Intentar mover la imagen
            if (move_uploaded_file($rutaTemporal, $rutaFinal)) {
                // Actualizar el campo foto si la imagen se subió correctamente
                $query = "UPDATE productos SET nombre='$c1', precio='$c2', cantidad='$c3', foto='$rutaFinal', id_categoria='$c5', id_componentes='$c6' WHERE id_producto = '$id'";
            } else {
                echo "Error al subir la imagen.";
                exit();
            }
        } else {
            echo "Formato de imagen no válido. Solo JPG, JPEG y PNG son permitidos.";
            exit();
        }
    } else {
        // Si no se sube una nueva imagen, no actualices la columna foto
        $query = "UPDATE productos SET nombre='$c1', precio='$c2', cantidad='$c3', id_categoria='$c5', id_componentes='$c6' WHERE id_producto = '$id'";
    }

    // Ejecutar la consulta de actualización
    $result = mysqli_query($conexion, $query);

    if ($result) {
        header("location:../cliente/productos.php");
    } else {
        echo "Error al actualizar producto: " . mysqli_error($conexion);
    }
}
