<?php
// Incluir el archivo de conexión a la base de datos
include_once("conexion.php");

// Verificar si se enviaron los datos mediante POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $id = $_POST['txt_ide'];
    $procesador = $_POST['txt_procesadore'];
    $grafica = $_POST['txt_graficae'];
    $ram = $_POST['txt_rame'];
    $color = $_POST['txt_colore'];
    $disco = $_POST['txt_discoe'];
    $frecuencia = $_POST['txt_frecuenciae'];
    $pulgadas = $_POST['txt_pulgadase'];

    // Validar que no haya campos vacíos
    if (empty($procesador) || empty($grafica) || empty($ram) || empty($color) || empty($disco) || empty($frecuencia) || empty($pulgadas)) {
        $alert = "Todos los campos son obligatorios";
    } else {
        // Realizar el UPDATE en la base de datos
        $query = "UPDATE componentes SET 
            procesador = '$procesador', 
            grafica = '$grafica', 
            ram = '$ram', 
            color = '$color', 
            disco = '$disco', 
            frecuencia = '$frecuencia',
            pulgadas = '$pulgadas'
          WHERE id_componentes = '$id'";


        $resultado = mysqli_query($conexion, $query);

        // Verificar si la actualización fue exitosa
        if ($resultado) {
            header("Location: ../cliente/componentes.php?mensaje=Usuario actualizado correctamente");
        } else {
            $alert = "Error al actualizar el usuario";
        }
    }
}
?>