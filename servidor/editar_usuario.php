<?php
// Incluir el archivo de conexión a la base de datos
include_once("conexion.php");

// Verificar si se enviaron los datos mediante POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $id = $_POST['txt_ide'];
    $nombre = $_POST['txt_nombrese'];
    $ap = $_POST['txt_ape'];
    $am = $_POST['txt_ame'];
    $telefono = $_POST['txt_tele'];
    $password = $_POST['txt_passe'];
    $tusuario = $_POST['selecte'];

    // Validar que no haya campos vacíos
    if (empty($nombre) || empty($ap) || empty($am) || empty($telefono) || empty($password) || empty($tusuario)) {
        $alert = "Todos los campos son obligatorios";
    } else {
        // Realizar el UPDATE en la base de datos
        $query = "UPDATE usuarios SET 
            unombre = '$nombre', 
            uap = '$ap', 
            uam = '$am', 
            utelefono = '$telefono', 
            upassword = '$password', 
            id_usuario = '$tusuario'
          WHERE id_uusuario = '$id'";


        $resultado = mysqli_query($conexion, $query);

        // Verificar si la actualización fue exitosa
        if ($resultado) {
            header("Location: ../cliente/usuarios.php?mensaje=Usuario actualizado correctamente");
        } else {
            $alert = "Error al actualizar el usuario";
        }
    }
}
?>
