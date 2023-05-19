<!DOCTYPE html>
<html lang="en">

    <head>
        <?php
        require_once("views/head.php");
        ?>
    </head>
    <style>
        body {
            background-image: url('images/fondo.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-color: #343a40;
        }
    </style>
    <?php
    if (isset($_GET['mensajeRegistro'])) {

    }
    ?>

    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <!-- <a class="navbar-brand" href="#">MII</a> -->
    <img src="images/mii.png" alt="" height="70px">
    </div>
</nav>
        <div style="min-height: 80vh;">
            <div class="container">
                <div class="row justify-content-end">
                <div class="col justify-content-start">
                <img src="images/mii2.png" alt="" height="300px">
            </div>
                    <div class="col-md-4">
                        <div class="card mt-5">
                            <div class="card-header bg-dark text-white text-center">
                                <h4>INICIO DE SESIÓN</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="controller/comprueba_login.php">
                                    <div class="form-group">
                                        <label for="usuario">Documento:</label>
                                        <input type="text" class="form-control" id="usuario" name="usuario" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Contraseña:</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            required>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block mt-4">Iniciar sesión</button>
                                    <a href="views/registroAprendiz"><button type="button"
                                            class="btn btn-primary btn-block mt-4">Registro Aprendiz</button></a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        require_once("views/footer.php");
        ?>
    </body>
    <script>
        // MENSAJE PARA CUANDO EL APRENDIZ COMPLETO EL REGISTRO
        $(document).ready(function () {
            console.log('<?php echo $_GET['mensajeRegistro'] ?>')
            if ('<?php echo $_GET['mensajeRegistro'] ?>' == 'si') {
                alert("<?php echo $_GET['usuario'] ?> su registro ha sido exitoso ahora puede iniciar sesion")
            }
        });
    </script>

</html>