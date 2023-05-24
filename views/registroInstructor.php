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
            <h2>REGISTRO INSTRUCTOR</h2>
            <form action="../controller/crearRegistro.php" method="post">
            <input type="text" class="form-control" id="tipoUsr" name="tipoUsr" value=4 hidden>
                <div class="form-row">
                    <div class="col form-group">
                        <label for="nombres">Nombres:</label>
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
                        <label for="tipodocumento">Tipo Documento:</label>
                        <select class="form-select" aria-label="Default select example" name="tipoDocumento">
                            <option selected>Selecciona tu tipo de documento</option>
                            <?php
                            $tipoDocumento = $base->query("SELECT * FROM tipo_documento")->fetchAll(PDO::FETCH_OBJ);
                            foreach ($tipoDocumento as $tipo) {
                                ?>
                                <option value="<?php echo $tipo->pk_id_tipo_doc  ?>"><?php echo $tipo->tipo_doc_descripcion  ?></option>
                               
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="documento">Documento:</label>
                        <input type="tel" class="form-control" id="documento"
                            placeholder="Introduce tu número de documento" name="documento" required>
                    </div>
                    <div class="colmd-2 form-group ">
                        <label for="rh">Rh:</label>
                        <select class="form-select" name="rh" id="rh" required>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
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
                    <a href="javascript:history.back(-1);"><button type="button" class="btn btn-danger">Regresar</button></a>
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
        if ($('#nombres').val() == '' || $('#apellidos').val() == '' || $('#documento').val() == '' || $('#correo').val() == '' || $('#rh').val() == '' || $('#telefono').val() == '' || $('#tipoDocumento').val() == '' ) {
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