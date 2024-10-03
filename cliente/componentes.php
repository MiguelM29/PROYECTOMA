<?php
include_once("../servidor/conexion.php");
if (!empty($_POST)) {
  if (empty($_POST['txt_procesador']) || empty($_POST['txt_grafica']) || empty($_POST['txt_ram']) || empty($_POST['txt_color']) || empty($_POST['txt_disco']) || empty($_POST['txt_frecuencia']) || empty($_POST['txt_pulgadas'])) {
    $alert = '<div class="alert alert-primary" role="aler"> Todos los datos son obligatorios</div>';
  } else {
    $c1 = $_POST['txt_procesador'];
    $c2 = $_POST['txt_grafica'];
    $c3 = $_POST['txt_ram'];
    $c4 = $_POST['txt_color'];
    $c5 = $_POST['txt_disco'];
    $c6 = $_POST['txt_frecuencia'];
    $c7 = $_POST['txt_pulgadas'];

    $consulta = mysqli_query($conexion, "INSERT INTO componentes(procesador, grafica, ram, color, disco, frecuencia, pulgadas) values('$c1', '$c2', '$c3','$c4', '$c5',$c6,$c7)");
    if ($consulta) {
      $alert = '<div class="alert alert-danger" role="alert">Datos registrados</div>';
    } else {
      $alert = '<div class="alert alert-danger" role="alert">Error al guardar la informacion</div>';
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
    <h2>Componentes</h2>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Agregar nuevos componentes
    </button>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Procesador</th>
          <th scope="col">Grafica</th>
          <th scope="col">Ram</th>
          <th scope="col">Color</th>
          <th scope="col">Disco</th>
          <th scope="col">Frecuencia</th>
          <th scope="col">Pulgadas</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include_once("../servidor/conexion.php");
        $con = mysqli_query($conexion, "SELECT * FROM componentes");
        $res = mysqli_num_rows($con);
        while ($datos = mysqli_fetch_assoc($con)) {
        ?>
          <tr>
            <td><?php echo $datos['id_componentes'] ?></td>
            <td><?php echo $datos['procesador'] ?></td>
            <td><?php echo $datos['grafica'] ?></td>
            <td><?php echo $datos['ram'] ?></td>
            <td><?php echo $datos['color'] ?></td>
            <td><?php echo $datos['disco'] ?></td>
            <td><?php echo $datos['frecuencia'] ?></td>
            <td><?php echo $datos['pulgadas'] ?></td>
            <td>
              <button
                type="button"
                class="btn btn-dark editBtn"
                data-id="<?php echo $datos['id_componentes'] ?>"
                data-procesador="<?php echo $datos['procesador'] ?>"
                data-grafica="<?php echo $datos['grafica'] ?>"
                data-ram="<?php echo $datos['ram'] ?>"
                data-color="<?php echo $datos['color'] ?>"
                data-disco="<?php echo $datos['disco'] ?>"
                data-frecuencia="<?php echo $datos['frecuencia'] ?>"
                data-pulgadas="<?php echo $datos['pulgadas'] ?>"
                data-bs-toggle="modal"
                data-bs-target="#exampleModaledit">
                Editar
              </button>
            </td>
            <td><a href="../servidor/borrar_componente.php?id=<?php echo $datos['id_componentes'] ?>"><button type="button" class="btn btn-danger"><i class="fi fi-rr-trash"></i>Borrar</button></a></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Aqui empieza la facking maquina de programacion -->
  <!-- inicia Modal registro-->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registros de componentes</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form style="padding: 30px;" method="POST">
            <div>
              <?php echo isset($alert) ? $alert : "" ?>
            </div>
            <div class="mb-3">
              <label for="procesador" class="form-label" style="color:black;">Procesador</label>
              <input type="text" class="form-control" id="txt_procesador" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_procesador">
              <label for="grafica" class="form-label" style="color:black;">Grafica</label>
              <input type="text" class="form-control" id="txt_grafica" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_grafica">
              <label for="ram" class="form-label" style="color:black;">RAM</label>
              <input type="text" class="form-control" id="txt_ram" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_ram">
              <label for="color" class="form-label" style="color:black;">Color</label>
              <input type="text" class="form-control" id="txt_color" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_color">
              <label for="disco" class="form-label" style="color:black;">Disco</label>
              <input type="text" class="form-control" id="txt_disco" style="width:300px; margin-left:140px" name="txt_disco">
              <label for="frecuencia" class="form-label" style="color:black;">Frecuencia</label>
              <input type="text" class="form-control" id="txt_frecuencia" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_frecuencia">
              <label for="pulgadas" class="form-label" style="color:black;">Pulgadas</label>
              <input type="text" class="form-control" id="txt_pulgadas" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_pulgadas">

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

  <!-- Modal editar -->
  <div class="modal fade" id="exampleModaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar componentes</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form style="padding: 30px;" method="POST" action="../servidor/editar_componentes.php">
            <div>
              <?php echo isset($alert) ? $alert : "" ?>
            </div>
            <div class="mb-3">

              <label for="id" class="form-label" style="color:black;">ID</label>
              <input type="text" class="form-control" id="txt_ide" name="txt_ide" readonly style="width:300px; margin-left:140px;">


              <label for="procesador" class="form-label" style="color:black;">Procesador</label>
              <input type="text" class="form-control" id="txt_procesadore" name="txt_procesadore" style="width:300px; margin-left:140px;">


              <label for="grafica" class="form-label" style="color:black;">Grafica</label>
              <input type="text" class="form-control" id="txt_graficae" name="txt_graficae" style="width:300px; margin-left:140px;">


              <label for="ram" class="form-label" style="color:black;">Ram</label>
              <input type="text" class="form-control" id="txt_rame" name="txt_rame" style="width:300px; margin-left:140px;">


              <label for="color" class="form-label" style="color:black;">Color</label>
              <input type="text" class="form-control" id="txt_colore" name="txt_colore" style="width:300px; margin-left:140px;">


              <label for="disco" class="form-label" style="color:black;">Disco</label>
              <input type="text" class="form-control" id="txt_discoe" name="txt_discoe" style="width:300px; margin-left:140px;">


              <label for="frecuencia" class="form-label" style="color:black;">Frecuencia</label>
              <input type="text" class="form-control" id="txt_frecuenciae" name="txt_frecuenciae" style="width:300px; margin-left:140px;">


              <label for="pulgadas" class="form-label" style="color:black;">Pulgadas</label>
              <input type="text" class="form-control" id="txt_pulgadase" name="txt_pulgadase" style="width:300px; margin-left:140px;">


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
          const procesador = this.getAttribute('data-procesador');
          const grafica = this.getAttribute('data-grafica');
          const ram = this.getAttribute('data-ram');
          const color = this.getAttribute('data-color');
          const disco = this.getAttribute('data-disco');
          const frecuencia = this.getAttribute('data-frecuencia');
          const pulgadas = this.getAttribute('data-pulgadas');

          // Llenar los campos del modal con los datos obtenidos
          document.getElementById('txt_ide').value = id;
          document.getElementById('txt_procesadore').value = procesador;
          document.getElementById('txt_graficae').value = grafica;
          document.getElementById('txt_rame').value = ram;
          document.getElementById('txt_colore').value = color;
          document.getElementById('txt_discoe').value = disco;
          document.getElementById('txt_frecuenciae').value = frecuencia;
          document.getElementById('txt_pulgadase').value = pulgadas;
        });
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>