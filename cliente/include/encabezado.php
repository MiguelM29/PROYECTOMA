<?php 
    session_start();/*
    if (!isset($_SESSION['tiempo'])) {
        $_SESSION['tiempo']=time();
    }
    else if (time() - $_SESSION['tiempo'] > 100) {
        
        session_destroy();
        header('location:../');
        die();  
    }
    $_SESSION['tiempo']=time();*/
?>

<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    </head>

    <body>
        <div class="container" style="border:solid 5px black">
            <div class="row">
                <div class="col-3">
                    <img src="img/logo.png" width="150px">
                </div>
                <div class="col" style="margin-top: 50px;">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <?php if($_SESSION['rol']== 1){ ?>
                        <a href="inicio.php"><button type="button" class="btn btn-primary">Inicio</button></a>
                        <a href="usuarios.php"><button type="button" class="btn btn-primary">Usuarios</button></a>
                        <a href="componentes.php"><button type="button" class="btn btn-primary">Componentes</button></a>
                        <a href="productos.php"><button type="button" class="btn btn-primary">Productos</button></a>
                        <a href="promociones.php"><button type="button" class="btn btn-primary">Promociones</button></a>
                        <a href="reportes.php"><button type="button" class="btn btn-primary">Reportes</button></a>
                        <a href="salir.php"><button type="button" class="btn btn-primary">Salir</button></a>

                        <?php } ?>

                        <?php
                            if($_SESSION['rol']== 2){
                        ?>
                        <a href="inicio.php"><button type="button" class="btn btn-primary">Inicio</button></a>
                        <a href="productos.php"><button type="button" class="btn btn-primary">Productos</button></a>
                        <a href="promociones.php"><button type="button" class="btn btn-primary">Promociones</button></a>
                        <a href="salir.php"><button type="button" class="btn btn-primary">Salir</button></a>

                        <?php 
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>


        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        -->
    </body>

</html>