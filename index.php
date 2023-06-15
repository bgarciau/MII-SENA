<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("views/head.php");
    ?>
    <link rel="icon" type="image/png" href="images/miifav.png" />
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
            <img src="images/sena.png" alt="" height="70px">
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
                                    <label for="usuario">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5ZM9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8Zm1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5Zm-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96c.026-.163.04-.33.04-.5ZM7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0Z" />
                                        </svg>Documento:</label>
                                    <input type="number" class="form-control" id="usuario" name="usuario" required>
                                </div>
                                <div class="form-group">
                                    <label for="password"><i class="bi bi-key-fill"></i>Contraseña:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <a href="views/recuperarPass.php">Olvido su contraseña?</a>
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
            Swal.fire({
                title: '<?php echo $_GET['usuario'] ?> su registro ha sido exitoso ahora puede iniciar sesion',
                color: '#ffffff',
                icon: 'success',
                iconColor: 'green',
            })
        }
    });
</script>

</html>