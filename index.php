<?php
    $alert = "";
    session_start();
    if (!empty($_SESSION['activa'])) {
        header('location:.php');
    } else {
        if (!empty($_POST)) {
            if (empty($_POST['correo']) || empty($_POST['contra'])) {
                $alert = '<div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                Correo y contraseña son obligatorios
                            </div>
                        </div>';
            } else {
                require_once('Servidor/conexion.php');
                $usuario = mysqli_real_escape_string($conexion, $_POST['correo']);
                $pass = mysqli_real_escape_string($conexion, $_POST['contra']);
                $query = mysqli_query($conexion, "select * from usuarios where ucorreo='$usuario' AND upassword='$pass'");
                mysqli_close($conexion);
                $resultado = mysqli_num_rows($query);
                if ($resultado > 0) {
                    $dato = mysqli_fetch_array($query);
                    $_SESSION['activa'] = true;
                    $_SESSION['nombre'] = $dato['unombre'];
                    $_SESSION['paterno'] = $dato['uap'];
                    $_SESSION['materno'] = $dato['uam'];
                    $_SESSION['rol'] = $dato['id_usuario'];
                    header('location: cliente/inicio.php');
                }
                else{
                    $alert = '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                     Usuario y/o contraseña incorrecta!!!
                </div>
            </div>';
                session_destroy();
                }
            }
        } else {
        }
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body style="background-color: rgb(99,99,99)">
    <!-- <div class="container" style="background-color: orange; border:solid 5px color black;">
        <h1>Bienvenidos</h1>
    </div> -->

    <div class="container" style="background-color: rgb(78, 156, 229 ); border:solid 5px color black; margin-top:100px">
        <h3 style="text-align: center;">Tu tienda de confianza</h3>
        <h3 style="text-align: center;">Ahora o nunca para comprar un buen dispositivo</h3>
        <div class="row" style="background-color: rgb(78, 156, 229 );">
            <div class="col" style="background-color: rgb(99,99,99);">
                <img style="margin-left: 150px; margin-top: 20px;" src="cliente/img/logo.png" height="350px" width="350px" />
            </div>
            <div class="col">
                <div class="row">
                    <h2 style="margin-left: 35px; margin-top: 20px;">Autentificacion de Luz Belen</h2>
                    <h2 style="margin-left: 35px; margin-top: 20px;">ya bañate</h2>
                </div>
                <div class="row" style="padding:15px; padding-right: 300px; margin-left:10px;">
                    <form method="POST">
                        <div>
                            <?php echo isset($alert) ? $alert : "" ?>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="correo" aria-describedby="emailHelp" name="correo">
                            <div id="emailHelp" class="form-text">Ingresa tu correo</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="contra" name="contra">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>