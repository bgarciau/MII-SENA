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
        <div class="container font-weight-bold" style="padding-bottom: 2rem;">
            <br>
            <h2>REGISTRO INSTRUCTOR</h2>
            <form action="../controller/crearRegistro.php" method="post">
            <button type="submit" disabled hidden aria-hidden="true"></button>
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
                        <input type="number" class="form-control" id="documento"
                            placeholder="Introduce tu número de documento" name="documento" max="9999999999" required>
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
                        <input type="number" class="form-control" id="telefono"
                            placeholder="Introduce tu número de teléfono" name="telefono" max="9999999999" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col form-group">
                        <label for="contrasena">Contraseña:</label>
                        <input type="password" class="form-control" id="contrasena"
                            placeholder="Introduce tu contraseña" name="contrasena" required>
                            <h6 id="mensajeLetra" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al menos una minuscula<i
                                class="bi bi-x-octagon-fill"></i></h6>
                        <h6 id="mensajeMayuscula" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al menos una
                            MAYUSCULA<i class="bi bi-x-octagon-fill"></i></h6>
                        <h6 id="mensajeNumero" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al menos un
                            numero<i class="bi bi-x-octagon-fill"></i></h6>
                        <h6 id="mensajeCaracteres" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al menos 7
                            caracteres<i class="bi bi-x-octagon-fill"></i></h6>
                        <h6 id="mensajeCohinciden" style="color:red"><i class="bi bi-x-octagon-fill"></i>Las contraseñas
                            deben coincidir<i class="bi bi-x-octagon-fill"></i></h6>
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
                    <a href="javascript:history.back(-1);"><button type="button" class="btn btn-danger">REGRESAR</button></a>
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
            enviar = 'no';
            if (clave1 == clave2 && clave1 != "") {
                $("#mensajeCohinciden").css("color", "green");
                enviar = 'si';
                // Longitud de la contraseña
                if (clave1.length <= 6) {
                    $("#mensajeCaracteres").css("color", "red");
                    enviar = 'no';
                }
                else {
                    $("#mensajeCaracteres").css("color", "green");
                }
                // Que conenga una letra la contraseña
                if (clave1.match(/[a-z]/)) {
                    $("#mensajeLetra").css("color", "green");
                }
                else {
                    $("#mensajeLetra").css("color", "red");
                    enviar = 'no';
                }

                //validar letra mayúscula
                if (clave1.match(/[A-Z]/)) {
                    $("#mensajeMayuscula").css("color", "green");
                } else {
                    $("#mensajeMayuscula").css("color", "red");
                    enviar = 'no';
                }

                //validar numero
                if (clave1.match(/\d/)) {
                    $("#mensajeNumero").css("color", "green");
                } else {
                    $("#mensajeNumero").css("color", "red");
                    enviar = 'no';
                }

                if (enviar == 'si') {
                    $('#btnEnviar').click()
                }

            } else {
                $("#mensajeCohinciden").css("color", "red");
            }
        }

    }
</script>

</html>