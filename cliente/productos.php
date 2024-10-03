<?php
include_once("../servidor/conexion.php");
if (!empty($_POST)) {
  if (empty($_POST['txt_nombre']) || empty($_POST['txt_precio']) || empty($_POST['txt_cantidad']) || empty($_FILES['txt_foto']) || empty($_POST['selectca']) || empty($_POST['selectco'])) {
    $alert = '<div class="alert alert-primary" role="aler"> Todos los datos son obligatorios</div>';
  } else {
    $c1 = $_POST['txt_nombre'];
    $c2 = $_POST['txt_precio'];
    $c3 = $_POST['txt_cantidad'];

    $c5 = $_POST['selectca'];
    $c6 = $_POST['selectco'];

    // Subir la imagen
    $foto = $_FILES['txt_foto'];
    $nombreFoto = $foto['name'];
    $tipoFoto = $foto['type'];
    $rutaTemporal = $foto['tmp_name'];

    // Subir la imagen
    $foto = $_FILES['txt_foto'];
    $nombreFoto = $foto['name'];
    $tipoFoto = $foto['type'];
    $rutaTemporal = $foto['tmp_name'];

    // Definir el directorio donde se guardarán las imágenes
    $carpetaDestino = "loadimg/";

    // Validar el tipo de archivo (solo imágenes permitidas)
    if ($tipoFoto == "image/jpg" || $tipoFoto == "image/jpeg" || $tipoFoto == "image/png") {
      // Mover el archivo al servidor
      $rutaFinal = $carpetaDestino . $nombreFoto;
      move_uploaded_file($rutaTemporal, $rutaFinal);
    } else {
      $alert = '<div class="alert alert-danger" role="alert">Solo se permiten archivos JPG, JPEG, PNG</div>';
    }

    // Guardar la ruta de la imagen en la base de datos
    $consulta = mysqli_query($conexion, "INSERT INTO productos(nombre, precio, cantidad, foto, id_categoria, id_componentes) values('$c1', '$c2', '$c3','$rutaFinal', '$c5', '$c6')");
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

  <div class="container">
    <div class="container" style="text-align: center;">
      <h2>Productos</h2>
      <!--Aqui empeza la fking programacion-->

      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Agregar nuevo producto
      </button>
    </div>
    <table class="table">
      <thead>
        <tr style="font-size: small;">
          <th scope="col">Nombre</th>
          <th scope="col">Precio</th>
          <th scope="col">Cantidad</th>
          <th scope="col">Foto</th>
          <th scope="col">Categoria</th>
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
        $con = mysqli_query($conexion, "SELECT * FROM productos INNER JOIN categoria ON productos.id_categoria = categoria.id_categoria INNER JOIN componentes ON productos.id_componentes = componentes.id_componentes;");
        $res = mysqli_num_rows($con);
        while ($datos = mysqli_fetch_assoc($con)) {
        ?>
          <tr style="font-size: small;">
            <td><?php echo $datos['nombre'] ?></td>
            <td><?php echo $datos['precio'] ?></td>
            <td><?php echo $datos['cantidad'] ?></td>
            <td><img src="<?php echo $datos['foto'] ?>" alt="Producto" width="100"></td>
            <td><?php echo $datos['categorias'] ?></td>
            <td><?php echo $datos['procesador'] ?></td>
            <td><?php echo $datos['grafica'] ?></td>
            <td><?php echo $datos['ram'] ?></td>
            <td><?php echo $datos['color'] ?></td>
            <td><?php echo $datos['disco'] ?></td>
            <td><?php echo $datos['frecuencia'] ?></td>
            <td><?php echo $datos['pulgadas'] ?></td>

            <td>
              <button type="button" class="btn btn-dark editBtn"
                data-id="<?php echo $datos['id_producto']; ?>"
                data-nombre="<?php echo $datos['nombre']; ?>"
                data-precio="<?php echo $datos['precio']; ?>"
                data-cantidad="<?php echo $datos['cantidad']; ?>"
                data-foto="<?php echo $datos['foto']; ?>"
                data-categoria="<?php echo $datos['id_categoria']; ?>"
                data-componentes="<?php echo $datos['id_componentes']; ?>"
                data-bs-toggle="modal" data-bs-target="#exampleModaledit">
                Editar
              </button>
            </td>

            <td>
              <a href="../servidor/borrar_producto.php?id=<?php echo $datos['id_producto'] ?>">
                <button type="button" class="btn btn-danger"><i class="fi fi-rr-trash"></i>
                  Borrar
                </button>
              </a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    <!--Aqui termina-->
  </div>


  <!-- inicia Modal registro-->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registros de productos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form style="padding: 30px;" method="POST" enctype="multipart/form-data">
            <div>
              <?php echo isset($alert) ? $alert : "" ?>
            </div>
            <div class="mb-3">
              <label for="nombres" class="form-label" style="color:black;">Nombre</label>
              <input type="name" class="form-control" id="txt_nombre" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_nombre">
              <label for="apellidos" class="form-label" style="color:black;">Precio</label>
              <input type="name" class="form-control" id="txt_precio" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_precio">
              <label for="mail" class="form-label" style="color:black;">Cantidad</label>
              <input type="name" class="form-control" id="txt_cantidad" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_cantidad">

              <label for="pass" class="form-label" style="color:black;">Foto</label>
              <input type="file" class="form-control" id="txt_foto" style="width:300px; margin-left:140px" name="txt_foto">

              <!-- Select categoria -->
              <select class="form-select" name="selectca" id="selectca" aria-label="Default select example">
                <option selected>Categoria</option>
                <?php
                include_once("../servidor/conexion.php");
                $cone = mysqli_query($conexion, "SELECT * FROM categoria ORDER BY categoria.categorias ASC");
                $resu = mysqli_num_rows($cone);
                while ($dat = mysqli_fetch_assoc($cone)) {
                ?>
                  <option value="<?php echo $dat['id_categoria'] ?>"><?php echo $dat['categorias'] ?></option>
                <?php
                }
                ?>
              </select>

              <!-- Componentes -->
              <select class="form-select" name="selectco" id="selectco" aria-label="Default select example">
                <option selected>Componentes</option>
                <?php
                include_once("../servidor/conexion.php");
                $cone = mysqli_query($conexion, "SELECT * FROM componentes ORDER BY componentes.id_componentes ASC");
                $resu = mysqli_num_rows($cone);
                while ($dat = mysqli_fetch_assoc($cone)) {
                ?>
                  <option value="<?php echo $dat['id_componentes'] ?>"><?php echo $dat['procesador'], $dat['grafica'], $dat['ram'], $dat['color'], $dat['disco'], $dat['frecuencia'], $dat['pulgadas'] ?></option>
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

  <!-- inicia Modal editar-->
  <div class="modal fade" id="exampleModaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar productos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form style="padding: 30px;" method="POST" enctype="multipart/form-data" action="../servidor/editar_producto.php">
            <div>
              <?php echo isset($alert) ? $alert : "" ?>
            </div>
            <div class="mb-3">
              <label for="nombres" class="form-label" style="color:black;">ID</label>
              <input type="text" class="form-control" id="txt_ide" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_ide">
              <label for="nombres" class="form-label" style="color:black;">Nombre</label>
              <input type="text" class="form-control" id="txt_nombree" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_nombree">
              <label for="apellidos" class="form-label" style="color:black;">Precio</label>
              <input type="text" class="form-control" id="txt_precioe" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_precioe">
              <label for="mail" class="form-label" style="color:black;">Cantidad</label>
              <input type="text" class="form-control" id="txt_cantidade" aria-describedby="addon_wrapping" style="width:300px; margin-left:140px;" name="txt_cantidade">

              <label for="pass" class="form-label" style="color:black;">Foto</label>
              <input type="file" class="form-control" id="txt_fotoe" style="width:300px; margin-left:140px" name="txt_fotoe">


              <!-- Select categoria -->
              <select class="form-select" name="selectcae" id="selectcae" aria-label="Default select example">
                <option selected>Categoria</option>
                <?php
                include_once("../servidor/conexion.php");
                $cone = mysqli_query($conexion, "SELECT * FROM categoria ORDER BY categoria.categorias ASC");
                $resu = mysqli_num_rows($cone);
                while ($dat = mysqli_fetch_assoc($cone)) {
                ?>
                  <option value="<?php echo $dat['id_categoria'] ?>"><?php echo $dat['categorias'] ?></option>
                <?php
                }
                ?>
              </select>

              <!-- Componentes -->
              <select class="form-select" name="selectcoe" id="selectcoe" aria-label="Default select example">
                <option selected>Componentes</option>
                <?php
                include_once("../servidor/conexion.php");
                $cone = mysqli_query($conexion, "SELECT * FROM componentes ORDER BY componentes.id_componentes ASC");
                $resu = mysqli_num_rows($cone);
                while ($dat = mysqli_fetch_assoc($cone)) {
                ?>
                  <option value="<?php echo $dat['id_componentes'] ?>"><?php echo $dat['procesador'], $dat['grafica'], $dat['ram'], $dat['color'], $dat['disco'], $dat['frecuencia'], $dat['pulgadas'] ?></option>
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
  <footer>
    <?php include_once("include/pie.php"); ?>
  </footer>


  <script>
    document.querySelectorAll('.editBtn').forEach(button => {
      button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const nombre = this.getAttribute('data-nombre');
        const precio = this.getAttribute('data-precio');
        const cantidad = this.getAttribute('data-cantidad');
        const foto = this.getAttribute('data-foto');
        const categoria = this.getAttribute('data-categoria');
        const componentes = this.getAttribute('data-componentes');

        document.getElementById('txt_ide').value = id;
        document.getElementById('txt_nombree').value = nombre;
        document.getElementById('txt_precioe').value = precio;
        document.getElementById('txt_cantidade').value = cantidad;
        document.getElementById('txt_fotoe').value = foto;
        document.getElementById('selectcae').value = categoria;
        document.getElementById('selectcoe').value = componentes;
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>