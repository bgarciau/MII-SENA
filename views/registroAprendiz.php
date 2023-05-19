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
    include('../controller/conexion.php');
    ?>
    <!-- HEADER -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <img src="../images/mii.png" alt="" height="70px">
        </div>
    </nav>
    <div style="min-height: 85vh;">
        <div class="container" style="padding-bottom: 2rem;">
            <br>
            <h2>REGISTRO APRENDIZ</h2>
            <!-- FORMULARIO PARA EL REGISTRO DEL APRENDIZ -->
            <form action="../controller/crearRegistro.php" method="post">
            <input type="text" class="form-control" id="tipoUsr" name="tipoUsr" value=1 hidden>
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
                    <div class="col form-group">
                        <label for="documento">Documento:</label>
                        <input type="tel" class="form-control" id="documento"
                            placeholder="Introduce tu número de documento" name="documento" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col form-group ">
                        <label for="rh">Rh:</label>
                        <input type="text" class="form-control" id="rh" name="rh" required>
                    </div>
                    <div class="col form-group">
                        <label for="ficha">Numero Ficha:</label>
                        <input type="text" class="form-control" id="ficha" name="ficha"
                            placeholder="Introduce tu número de ficha" required>
                        <h6 id="mensajeFicha" style="color:red" hidden><i class="bi bi-x-octagon-fill"></i> La ficha no existe <i class="bi bi-emoji-neutral"></i> <i class="bi bi-x-octagon-fill"></i></h6>
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
                    <h6 id="mensajeCampos" style="color:red" hidden><i class="bi bi-x-octagon-fill"></i> Todos los campos son obligatorios <i class="bi bi-x-octagon-fill"></i></h6>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <button type="button" class="btn btn-success" onclick="confirmarContraseña()">Enviar</button>
                    <button type="submit" class="btn btn-success" id="btnEnviar" hidden>Enviar</button>
                    <a href="../"><button type="button" class="btn btn-danger">Regresar</button></a>
                </div>
            </form>
        </div>
    </div>
    <?php
    require_once("footer.php");
    ?>
</body>
<script>
    // CONFIRMA QUE LAS CONTRASEÑAS SEAN IGUALES
    function confirmarContraseña() {
        clave1 = $('#contrasena').val()
        clave2 = $('#ConfirmarContrasena').val()
        if ($('#nombres').val() == '' || $('#apellidos').val() == '' || $('#documento').val() == '' || $('#correo').val() == '' || $('#telefono').val() == '' || $('#ficha').val() == '') {
            $('#mensajeCampos').prop("hidden", false);
        } else {
            ficha = "NO";
            <?php
            $fichas = $base->query("SELECT pk_id_ficha FROM fichas")->fetchAll(PDO::FETCH_OBJ);
            foreach ($fichas as $ficha) {
                ?>
                if ($('#ficha').val() == "<?php echo $ficha->pk_id_ficha ?>") {
                    console.log(<?php echo $ficha->pk_id_ficha ?>);
                    ficha = "SI";
                }
                <?php
            }
            ?>
            if (clave1 == clave2 && clave1 != "") {
                if (ficha == "SI") {
                    $('#btnEnviar').click()
                }
                else {
                    $('#mensajeFicha').prop("hidden", false);
                }
            } else {
                alert('Las contraseas no coinciden')
            }
        }

    }
</script>

</html>