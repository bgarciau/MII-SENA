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
    $usuario = $_SESSION['usuario'];
    // ACTUALIZA LOS DATOS BASICOS DEL USUARIO
    if (isset($_POST['guardarCambios'])) {
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        try {
            $query = "UPDATE usuarios SET usr_email=?, usr_telefono=? WHERE pk_id_usr=$usuario;";
            $sentencia = $base->prepare($query);
            $resultado = $sentencia->execute([$correo, $telefono]);
        } catch (Exception $e) {
            echo $e;
        }
    }
    $contrasena = 'no';
    if (isset($_GET['contrasena'])) {
        $contrasena = $_GET['contrasena'];
    }
    ?>
    <div style="min-height: 85vh;">
        <div class="container font-weight-bold mt-4">
            <div class="row">
                <div class="col-md-4 mx-auto">
                    <!-- MUESTRA LOS DATOS BASICOS DE LA EMPRESA -->
                    <h2 class="text-center mb-4">DATOS DE EMPRESA</h2>
                    <?php
                    $usuario = $base->query("SELECT * FROM usuarios WHERE pk_id_usr=$usuario")->fetchAll(PDO::FETCH_OBJ);
                    foreach ($usuario as $datos) {
                        ?>
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                value="<?php echo $datos->usr_nombre ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nit">NIT:</label>
                            <input type="number" class="form-control" id="nit" name="nit"
                                value="<?php echo $datos->pk_id_usr ?>" readonly>
                        </div>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="form-group">
                                <label for="correo">Correo electrónico:</label>
                                <input type="email" class="form-control" id="correo" name="correo"
                                    value="<?php echo $datos->usr_email ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono:</label>
                                <input type="numberber" class="form-control" id="telefono" name="telefono"
                                    value="<?php echo $datos->usr_telefono ?>" required>
                            </div>
                            <input type="submit" class="btn btn-success btn-block mt-2" name="guardarCambios"
                                value="GUARDAR CAMBIOS">
                        </form>
                        <div class="d-grid gap-2 d-md-flex">
                            <button type="button" class="btn btn-warning btn-block mt-2" id="btnActualizarContraseña">
                                ACTUALIZAR CONTRASEÑA</button>
                        </div>
                        <dialog id="dialogActualizarContraseña" style="min-width: 50%;">
                            <form action="../controller/actualizarContrasena.php" method="post">
                                <h5>CAMBIAR CONTRASEÑA</h5>
                                <div class="form-row">
                                    <div class="col form-group">
                                    <input type="text" class="form-control" id="tipo" name="tipo"
                                            value="home" hidden>
                                        <input type="number" class="form-control" id="documento" name="documento"
                                            value="<?php echo $datos->pk_id_usr ?>" hidden>
                                        <label for="contrasena">Nueva Contraseña:</label>
                                        <input type="password" class="form-control" id="contrasena" name="contrasena"
                                            value="" required>
                                        <h6 id="mensajeLetra" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al menos
                                            una
                                            minuscula<i class="bi bi-x-octagon-fill"></i></h6>
                                        <h6 id="mensajeMayuscula" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al
                                            menos
                                            una
                                            MAYUSCULA<i class="bi bi-x-octagon-fill"></i></h6>
                                        <h6 id="mensajeNumero" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al
                                            menos un
                                            numero<i class="bi bi-x-octagon-fill"></i></h6>
                                        <h6 id="mensajeCaracteres" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al
                                            menos 7
                                            caracteres<i class="bi bi-x-octagon-fill"></i></h6>
                                        <h6 id="mensajeCohinciden" style="color:red"><i class="bi bi-x-octagon-fill"></i>Las
                                            contraseñas
                                            deben coincidir<i class="bi bi-x-octagon-fill"></i></h6>
                                    </div>
                                    <div class="col form-group">
                                        <label for="contrasena">Confirmar Contraseña:</label>
                                        <input type="password" class="form-control" id="ConfirmarContrasena"
                                            name="ConfirmarContrasena" value="" required>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <button type="button" class="btn btn-success" onclick="confirmarContraseña()">ACTUALIZAR
                                        CONTRASEÑA</button>
                                    <button type="submit" class="btn btn-success" id="btnEnviarC" hidden>Enviar</button>
                                    <button type="button" class="btn btn-danger" id="btnCerrarContraseña">REGRESAR</button>
                                </div>
                            </form>
                        </dialog>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-md-8 mx-auto">
                    <!-- FILTROS PARA LA BUSQUEDA DE APRENDICES -->
                    <h4>FILTROS</h4>
                    <label class="form-label">Programa: </label>
                    <select class="form-select" aria-label="Default" id="programa" autofocus required>
                        <option value="todos">Todos</option>
                        <?php
                        $programa = $base->query("SELECT * FROM programas")->fetchAll(PDO::FETCH_OBJ);
                        foreach ($programa as $programas) {
                            ?>
                            <option value="<?php echo $programas->pk_id_pro ?>"><?php echo $programas->pro_nombre ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                    <label class="form-label">Etapa: </label>
                    <select class="form-select" name="etapa" id="etapa">
                        <option value="PRACTICA">PRACTICA</option>
                        <option value="LECTIVA">LECTIVA</option>
                    </select>
                    <br>
                    <button onclick="buscarAprendices()" type="button" class="btn btn-success btn-block">BUSCAR
                        APRENDICES</button>
                    <br><br>
                    <h3>APRENDICES SELECCIONADOS</h3>
                    <div class="overflow-x-scroll">
                        <table id="tablaAprendicesE" class="table table-bordered table-striped table-hover">
                            <thead class="table-success">
                                <tr>
                                    <th>#</th>
                                    <th>Aprendiz</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $usuario = $_SESSION['usuario'];
                                $idAprendices = $base->query("SELECT * FROM empresaaprendiz WHERE fk_id_empresa=$usuario and contratar='si'")->fetchAll(PDO::FETCH_OBJ);
                                foreach ($idAprendices as $idAprendiz) {
                                    $DatosAprendiz = $base->query("SELECT * FROM usuarios WHERE pk_id_usr=$idAprendiz->fk_id_aprendiz;")->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($DatosAprendiz as $DatosA) {

                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $i ?>
                                            </td>
                                            <td>
                                                <?php echo $DatosA->usr_nombre, " ", $DatosA->usr_apellidos ?>
                                            </td>
                                            <td>
                                                <?php echo $DatosA->usr_email ?>
                                            </td>
                                            <td>
                                                <?php echo $DatosA->usr_telefono ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-info btn-sm"
                                                    href="hojaVida.php?id=<?php echo $DatosA->pk_id_usr; ?>">
                                                    <i class="bi bi-file-earmark-text-fill">VER</i></a>
                                                <a onclick="return confirm('Estas seguro de eliminar?');"
                                                    class="btn btn-danger btn-sm"
                                                    href="../controller/eliminarEA.php?id=<?php echo $DatosA->pk_id_usr; ?>"><i
                                                        class="bi bi-trash-fill">ELIMINAR</i></a>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once("footer.php");
    ?>
</body>
<script>
    // MUESTRA O ESCONDE EL DIALOG PARA ACTUAIZAR LA CONTRASEÑA
    const btnActualizarContraseña = document.getElementById('btnActualizarContraseña');
    const btnCerrarContraseña = document.getElementById('btnCerrarContraseña');
    const dialogActualizarContraseña = document.getElementById('dialogActualizarContraseña');

    btnActualizarContraseña.addEventListener('click', () => {
        dialogActualizarContraseña.showModal();
    });
    btnCerrarContraseña.addEventListener('click', () => {
        dialogActualizarContraseña.close();
    });

    function confirmarContraseña() {
        clave1 = $('#contrasena').val()
        clave2 = $('#ConfirmarContrasena').val()
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
                $('#btnEnviarC').click()
            }

        } else {
            $("#mensajeCohinciden").css("color", "red");
        }
    }

    if ('<?php echo $contrasena ?>' == 'si') {
        Swal.fire({
            title: 'Su contraseña ha sido cambiada',
            color: '#ffffff',
            icon: 'success',
            iconColor: 'green',
        })
    }
    //BOTON PARA ENVIAR A LA EMPRESA A BUSCAR APRENDICES CON LOS FILTROS APLICADOS
    function buscarAprendices() {
        idPrograma = $('#programa').val()
        etapa = $('#etapa').val()
        location.href = "buscarAprendices.php?programa=" + idPrograma + "&etapa=" + etapa;
    }
</script>

</html>