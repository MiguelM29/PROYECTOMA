<?php
include_once("../servidor/conexion.php");
if (!empty($_POST)) {
  if (empty($_POST['txt_nombres']) || empty($_POST['txt_ap']) || empty($_POST['txt_am']) || empty($_POST['txt_correo']) || empty($_POST['txt_pass']) || empty($_POST['txt_tel']) || empty($_POST['select'])) {
    $alert = '<div class="alert alert-primary" role="aler"> Todos los datos son obligatorios</div>';
  } else {
    $c1 = $_POST['txt_nombres'];
    $c2 = $_POST['txt_ap'];
    $c3 = $_POST['txt_am'];
    $c4 = $_POST['txt_correo'];
    $c5 = $_POST['txt_pass'];
    $c6 = $_POST['txt_tel'];
    $c7 = $_POST['select'];
    $c8 = md5($_POST['txt_pass']);
    $query = mysqli_query($conexion, "SELECT * FROM usuarios where ucorreo = '$c4'");
    $result = mysqli_fetch_array($query);

    if ($result > 0) {
      $alert = '<div class="alert alert-danger" role="alert">El correo ya existe</div>';
    } else {
      $consulta = mysqli_query($conexion, "INSERT INTO usuarios(unombre, uap, uam, ucorreo, upassword, utelefono, ruta, id_usuario) values('$c1', '$c2', '$c3','$c4', '$c5',$c6,'$c8',$c7)");
      if ($consulta) {
        $alert = '<div class="alert alert-danger" role="alert">Datos registrados</div>';
      } else {
        $alert = '<div class="alert alert-danger" role="alert">Error al guardar la informacion</div>';
      }
    }
  }
}
?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>

<body>
  <header>
    <?php include_once("include/encabezado.php"); ?>
  </header>

  <div class="container" style="text-align: center;">
    <h2>Usuarios</h2>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Agregar Nuevo Usuario
    </button>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido Paterno</th>
          <th scope="col">Apellido Materno</th>
          <th scope="col">Correo</th>
          <th scope="col">Teléfono</th>
          <th scope="col">Tipo Usuario</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include_once("../servidor/conexion.php");
        $con = mysqli_query($conexion, "SELECT u.id_uusuario, u.unombre, u.uap, u.uam, u.ucorreo, u.utelefono, u.upassword, t.tusuario
    FROM usuarios u INNER JOIN tipusuarios t ON u.id_usuario= t.id_usuario;");
        $res = mysqli_num_rows($con);
        while ($datos = mysqli_fetch_assoc($con)) {
        ?>
          <tr>
            <td><?php echo $datos['id_uusuario'] ?></td>
            <td><?php echo $datos['unombre'] ?></td>
            <td><?php echo $datos['uap'] ?></td>
            <td><?php echo $datos['uam'] ?></td>
            <td><?php echo $datos['ucorreo'] ?></td>
            <td><?php echo $datos['utelefono'] ?></td>
            <td><?php echo $datos['tusuario'] ?></td>
            <td>
              <button
                type="button"
                class="btn btn-dark editBtn"
                data-id="<?php echo $datos['id_uusuario'] ?>"
                data-nombre="<?php echo $datos['unombre'] ?>"
                data-ap="<?php echo $datos['uap'] ?>"
                data-am="<?php echo $datos['uam'] ?>"
                data-correo="<?php echo $datos['ucorreo'] ?>"
                data-telefono="<?php echo $datos['utelefono'] ?>"
                data-contra="<?php echo $datos['upassword'] ?>"
                data-tusuario="<?php echo $datos['tusuario'] ?>"
                data-bs-toggle="modal"
                data-bs-target="#exampleModaledit">
                Editar
              </button>
            </td>
            <td><a href="../servidor/borrar_usuario.php?id=<?php echo $datos['id_uusuario'] ?>"><button type="button" class="btn btn-danger"><i class="fi fi-rr-trash"></i>Borrar</button></a></td>
          </tr>

        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
  <!-- inicia Modal registro-->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registros de usuarios</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form style="padding: 30px;" method="POST">
            <div>
              <?php echo isset($alert) ? $alert : "" ?>
            </div>
            <div class="mb-3">
              <label for="nombres" class="form-label" style="color:black;">Nombre(s)</label>
              <input type="name" class="form-control" id="txt_nombres" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_nombres">
              <label for="apellidos" class="form-label" style="color:black;">Apellido Paterno</label>
              <input type="name" class="form-control" id="txt_ap" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_ap">
              <label for="apellidos" class="form-label" style="color:black;">Apellido Materno</label>
              <input type="name" class="form-control" id="txt_am" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_am">
              <label for="mail" class="form-label" style="color:black;">Correo</label>
              <input type="email" class="form-control" id="txt_correo" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_correo">
              <label for="pass" class="form-label" style="color:black;">Contraseña</label>
              <input type="password" class="form-control" id="txt_pass" style="width:300px; margin-left:140px" name="txt_pass">
              <label for="tel" class="form-label" style="color:black;">Teléfono</label>
              <input type="tel" class="form-control" id="txt_tel" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_tel">
              <select class="form-select" name="select" id="select" aria-label="Default select example">
                <option selected>Tipo de Usuario</option>
                <?php
                include_once("../servidor/conexion.php");
                $cone = mysqli_query($conexion, "SELECT * FROM tipusuarios ORDER BY tipusuarios.tusuario ASC");
                $resu = mysqli_num_rows($cone);
                while ($dat = mysqli_fetch_assoc($cone)) {
                ?>
                  <option value="<?php echo $dat['id_usuario'] ?>"><?php echo $dat['tusuario'] ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Guardar Información</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--termina modal-->

  <!-- inicia Modal editar
  <div class="modal fade" id="exampleModaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registros de usuarios</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form style="padding: 30px;" method="UPDATE">
            <div>
              <?php echo isset($alert) ? $alert : "" ?>
            </div>
            <div class="mb-3">
              <label for="nombres" class="form-label" style="color:black;">ID</label>
              <input type="name" class="form-control" id="txt_ide" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_ide">
              <label for="nombres" class="form-label" style="color:black;">Nombre(s)</label>
              <input type="name" class="form-control" id="txt_nombrese" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_nombrese">
              <label for="apellidos" class="form-label" style="color:black;">Apellido Paterno</label>
              <input type="name" class="form-control" id="txt_ape" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_ape">
              <label for="apellidos" class="form-label" style="color:black;">Apellido Materno</label>
              <input type="name" class="form-control" id="txt_ame" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_ame">
              <label for="mail" class="form-label" style="color:black;">Correo</label>
              <input type="email" class="form-control" id="txt_correoe" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_correoe">
              <label for="pass" class="form-label" style="color:black;">Contraseña</label>
              <input type="password" class="form-control" id="txt_passe" style="width:300px; margin-left:140px" name="txt_passe">
              <label for="tel" class="form-label" style="color:black;">Teléfono</label>
              <input type="tel" class="form-control" id="txt_tele" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_tele">
              <select class="form-select" name="selecte" id="selecte" aria-label="Default select example">
                <option selected>Tipo de Usuario</option>
                <?php
                include_once("../servidor/conexion.php");
                $cone = mysqli_query($conexion, "SELECT * FROM tipusuarios ORDER BY tipusuarios.tusuario ASC");
                $resu = mysqli_num_rows($cone);
                while ($dat = mysqli_fetch_assoc($cone)) {
                ?>
                  <option value="<?php echo $dat['id_usuario'] ?>"><?php echo $dat['tusuario'] ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Guardar Información</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  termina modal-->

  <!-- Modal editar -->
  <div class="modal fade" id="exampleModaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form style="padding: 30px;" method="POST" action="../servidor/editar_usuario.php">
            <div>
              <?php echo isset($alert) ? $alert : "" ?>
            </div>
            <div class="mb-3">
              <!-- ID (Solo lectura) -->
              <label for="nombres" class="form-label" style="color:black;">ID</label>
              <input type="text" class="form-control" id="txt_ide" name="txt_ide" readonly style="width:300px; margin-left:140px;">

              <!-- Nombre -->
              <label for="nombres" class="form-label" style="color:black;">Nombre(s)</label>
              <input type="text" class="form-control" id="txt_nombrese" name="txt_nombrese" style="width:300px; margin-left:140px;">

              <!-- Apellido Paterno -->
              <label for="apellidos" class="form-label" style="color:black;">Apellido Paterno</label>
              <input type="text" class="form-control" id="txt_ape" name="txt_ape" style="width:300px; margin-left:140px;">

              <!-- Apellido Materno -->
              <label for="apellidos" class="form-label" style="color:black;">Apellido Materno</label>
              <input type="text" class="form-control" id="txt_ame" name="txt_ame" style="width:300px; margin-left:140px;">

              <!-- Correo (Solo lectura) -->
              <label for="mail" class="form-label" style="color:black;">Correo</label>
              <input type="email" class="form-control" id="txt_correoe" name="txt_correoe" readonly style="width:300px; margin-left:140px;">

              <!-- Contraseña -->
              <label for="pass" class="form-label" style="color:black;">Contraseña</label>
              <input type="password" class="form-control" id="txt_passe" name="txt_passe" style="width:300px; margin-left:140px;">

              <!-- Teléfono -->
              <label for="tel" class="form-label" style="color:black;">Teléfono</label>
              <input type="tel" class="form-control" id="txt_tele" name="txt_tele" style="width:300px; margin-left:140px;">

              <!-- Tipo de Usuario -->
              <select class="form-select" name="selecte" id="selecte" aria-label="Default select example">
                <option selected>Tipo de Usuario</option>
                <?php
                include_once("../servidor/conexion.php");
                $cone = mysqli_query($conexion, "SELECT * FROM tipusuarios ORDER BY tipusuarios.tusuario ASC");
                $resu = mysqli_num_rows($cone);
                while ($dat = mysqli_fetch_assoc($cone)) {
                ?>
                  <option value="<?php echo $dat['id_usuario'] ?>"><?php echo $dat['tusuario'] ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Guardar Información</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Termina modal -->




  <footer>
    <?php include_once("include/pie.php"); ?>
  </footer>

  <!--
  <script>
    document.querySelectorAll('.editBtn').forEach(button => {
      button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const nombre = this.getAttribute('data-nombre');
        const apaterno = this.getAttribute('data-apaterno');
        const amaterno = this.getAttribute('data-amaterno');
        const correo = this.getAttribute('data-correo');
        const telefono = this.getAttribute('data-telefono');
        const contra = this.getAttribute('data-contra');
        const tipo = this.getAttribute('data-idtipo');

        document.getElementById('txt_ide').value = id;
        document.getElementById('txt_nombrese').value = nombre;
        document.getElementById('txt_ape').value = apaterno;
        document.getElementById('txt_ame').value = amaterno;
        document.getElementById('txt_correoe').value = correo;
        document.getElementById('txt_tele').value = telefono;
        document.getElementById('txt_passe').value = contra;
        document.getElementById('selecte').value = tipo;


      });
    });
  </script>
-->

  <script>
    // Espera a que el DOM esté completamente cargado
    document.addEventListener("DOMContentLoaded", function() {
      // Selecciona todos los botones de edición
      const editButtons = document.querySelectorAll('.editBtn');

      // Recorre todos los botones y añade un listener de click
      editButtons.forEach(button => {
        button.addEventListener('click', function() {
          // Obtener los datos del usuario desde los atributos data
          const id = this.getAttribute('data-id');
          const nombre = this.getAttribute('data-nombre');
          const ap = this.getAttribute('data-ap');
          const am = this.getAttribute('data-am');
          const correo = this.getAttribute('data-correo');
          const telefono = this.getAttribute('data-telefono');
          const contra = this.getAttribute('data-contra');
          const tusuario = this.getAttribute('data-tusuario');

          // Llenar los campos del modal con los datos obtenidos
          document.getElementById('txt_ide').value = id;
          document.getElementById('txt_nombrese').value = nombre;
          document.getElementById('txt_ape').value = ap;
          document.getElementById('txt_ame').value = am;
          document.getElementById('txt_correoe').value = correo;
          document.getElementById('txt_tele').value = telefono;
          document.getElementById('txt_passe').value = contra;

          // Seleccionar el tipo de usuario correcto en el select
          const selectElement = document.getElementById('selecte');
          for (let i = 0; i < selectElement.options.length; i++) {
            if (selectElement.options[i].text === tusuario) {
              selectElement.selectedIndex = i;
              break;
            }
          }
        });
      });
    });
  </script>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>