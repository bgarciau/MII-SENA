<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("head.php");
    ?>
    <link rel="stylesheet" href="carnet/estilos.css">
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
        <div class="container font-weight-bold mt-3">
            <div class="row">
                <div class="col-md-6">
                    <!-- MUESTRA LOS DATOS DEL INSTRUCTOR-->
                    <h2 class="text-center mb-4">DATOS DEL INSTRUCTOR</h2>
                    <?php
                    $usuario = $base->query("SELECT * FROM usuarios WHERE pk_id_usr=$usuario")->fetchAll(PDO::FETCH_OBJ);
                    foreach ($usuario as $datos) {
                        ?>

                        <!-- Campo de nombre -->
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                value="<?php echo $datos->usr_nombre ?>" readonly>
                        </div>

                        <!-- Campo de apellido -->
                        <div class="form-group">
                            <label for="apellido">Apellido:</label>
                            <input type="text" class="form-control" id="apellido" name="apellido"
                                value="<?php echo $datos->usr_apellidos ?>" readonly>
                        </div>

                        <!-- Campo de documento -->
                        <div class="form-group">
                            <label for="documento">Documento:</label>
                            <input type="number" class="form-control" id="documento" name="documento"
                                value="<?php echo $datos->pk_id_usr ?>" readonly>
                        </div>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <!-- Campo de correo -->
                            <div class="form-group">
                                <label for="correo">Correo:</label>
                                <input type="email" class="form-control" id="correo" name="correo"
                                    value="<?php echo $datos->usr_email ?>">
                            </div>

                            <!-- Campo de teléfono -->
                            <div class="form-group">
                                <label for="telefono">Teléfono:</label>
                                <input type="number" class="form-control" id="telefono" name="telefono"
                                    value="<?php echo $datos->usr_telefono ?>">
                            </div>
                            <!-- Botón de enviar -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <input type="submit" class="btn btn-success btn-block mt-2" name="guardarCambios"
                                    value="GUARDAR CAMBIOS">
                            </div>
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
                                        <input type="text" class="form-control" id="tipo" name="tipo" value="home" hidden>
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
                    </div>
                    <div class="col-md-6 justify-content-center">
                        <form class="row g-3" method="POST" action="../controller/foto.php" enctype="multipart/form-data">
                            <div class="col-auto">
                                <!-- <label for="staticEmail2" class="">FOTO:</label> -->
                                <input type="text" readonly class="form-control-plaintext" value="FOTO:">
                            </div>
                            <div class="col-auto">
                                <!-- <label for="inputPassword2" class="visually-hidden"></label> -->
                                <input type="file" class="form-control" id="foto" name="imagen" required>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-secondary mb-3">GUARDAR</button>
                            </div>
                        </form>
                        <!-- CARNET DEL INSTRUCTOR -->
                        <div class="carnet-body">
                            <div class="carnet-container">
                                <div class="shape">
                                    <div class="img">
                                        <img src="<?php echo $datos->foto ?>" alt="" height="188px" width="151px">
                                    </div>
                                    <div>
                                        <?php
                                        $tipoUsuario = $base->query("SELECT * FROM tipo_usuarios WHERE pk_id_tipo_usr=$datos->fk_id_tipo_usr")->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($tipoUsuario as $tipo) {
                                            ?>
                                            <h4 id="Usuario">
                                                <?php echo strtoupper($tipo->tipo_usr_descripcion) ?>
                                            </h4>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div id="logoSena">
                                        <img src="carnet/Sena.jpg" alt="" width="100px" height="100px"
                                            style='float:none; top:-100px; position:relative;'>
                                    </div>
                                </div>
                                <hr style="border-top: 2px green solid; opacity: 0.5;">
                                <br>
                                <div class="subtitle" style="float:left">
                                    <div class="title">
                                        <h6><strong>
                                                <?php echo $datos->usr_nombre ?><br>
                                                <?php echo $datos->usr_apellidos ?>
                                            </strong></h6>
                                    </div>
                                    <h6>C.C.
                                        <?php echo $datos->pk_id_usr ?>
                                    </h6>
                                    <h6>RH
                                        <?php echo $datos->usr_rh ?>
                                    </h6>
                                </div>
                                <?php
                    }
                    ?>
                            <div style="float:none">
                                <a target='_blank' href="verCarnet.php?id=<?php echo $datos->pk_id_usr ?>"><img src="../carnetQr/<?php
                                   require '../phpqrcode/qrlib.php';
                                   $dir = "../carnetQr/" . $datos->pk_id_usr . ".png";
                                   if (!file_exists($dir)) {
                                       $filename = $dir;

                                       $localIP = getHostByName(getHostName());
                                       $tamaño = 10;
                                       $level = 'M';
                                       $frameSize = 3;
                                       $contenido = "http://$localIP/mii/views/verCarnet.php?id=" . $datos->pk_id_usr;

                                       QRcode::png($contenido, $filename, $level, $tamaño, $frameSize);
                                   }
                                   echo $datos->pk_id_usr ?>.png" style="margin-left:2rem" alt="" width="140px"
                                        height="140px"></a>
                            </div>
                            <br>
                            <hr style="border-top: 2px green solid; opacity: 0.5;">
                            <div>
                                <h6><strong>Regional Caldas</strong></h6>
                                <!-- <img src="carnet/Sena.jpg" alt="" width="60px" height="55px" style='float:right'> -->
                            </div>
                            <div class="title">

                                <h6>Centro de Automatizaciòn Industrial </h6>
                                <br>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<br>
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
</script>

</html>