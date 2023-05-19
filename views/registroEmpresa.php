<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("head.php");
    ?>
</head>

<body>
    <?php
    session_start();
    require_once("header.php");
    include('../controller/conexion.php');
    ?>
    <div style="min-height: 85vh;">
        <div class="container" style="padding-bottom: 2rem;">
            <br>
            <h2>REGISTRO EMPRESA</h2>
            <form action="../controller/crearRegistro.php" method="post">
            <input type="text" class="form-control" id="tipoUsr" name="tipoUsr" value=3 hidden>
                <div class="form-row">
                    <div class="col form-group">
                        <label for="nombreEmpresa">Nombre Empresa:</label>
                        <input type="tel" class="form-control" id="nombreEmpresa" placeholder="Introduce tu número de nombre de la empresa"
                            name="nombreEmpresa" required>
                    </div>
                    <div class="col form-group">
                        <label for="nit">Nit:</label>
                        <input type="tel" class="form-control" id="nit" placeholder="Introduce tu número de nit"
                            name="nit" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col form-group">
                        <label for="nombres">Nombre encargado:</label>
                        <input type="text" class="form-control" id="nombres" name="nombres"
                            placeholder="Introduce tus nombres" required>
                    </div>
                    <div class="col form-group">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos"
                            placeholder="Introduce tus apellidos" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col form-group">
                        <label for="correo">Correo electrónico:</label>
                        <input type="email" class="form-control" id="correo"
                            placeholder="Introduce tu correo electrónico" name="correo" required>
                    </div>
                    <div class="col form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" class="form-control" id="telefono"
                            placeholder="Introduce tu número de teléfono" name="telefono" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col form-group">
                        <label for="contrasena">Contraseña:</label>
                        <input type="password" class="form-control" id="contrasena"
                            placeholder="Introduce tu contraseña" name="contrasena" required>
                    </div>
                    <div class="col form-group">
                        <label for="contrasena">Confirmar Contraseña:</label>
                        <input type="password" class="form-control" id="ConfirmarContrasena"
                            placeholder="Verifica tu contraseña" name="ConfirmarContrasena" required>
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <h6 id="mensajeCampos" style="color:red" hidden>*Todos los campos son obligatorios*</h6>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <button type="button" class="btn btn-success" onclick="confirmarContraseña()">Enviar</button>
                    <button type="submit" class="btn btn-success" id="btnEnviar" hidden>Enviar</button>
                    <a href="javascript:history.back(-1);"><button type="button"
                            class="btn btn-danger">Regresar</button></a>
                </div>
            </form>
        </div>
    </div>
    <?php
    require_once("footer.php");
    ?>
</body>
<script>
    function confirmarContraseña() {
        clave1 = $('#contrasena').val()
        clave2 = $('#ConfirmarContrasena').val()
        if ($('#nombreEmpresa').val() == '' || $('#nit').val() == '' || $('#nombres').val() == '' || $('#apellidos').val() == '' || $('#telefono').val() == '' || $('#correo').val() == '') {
            $('#mensajeCampos').prop("hidden", false);
        } else {
            if (clave1 == clave2 && clave1 != "") {
                $('#btnEnviar').click()
            } else {
                alert('Las contraseas no coinciden')
            }
        }

    }
</script>

</html>