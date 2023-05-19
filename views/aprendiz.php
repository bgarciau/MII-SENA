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
    // Guarda el cambio en los datos basicos del usuario
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
    ?>
    <div style="min-height: 85vh;">
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-center mb-4">DATOS DE APRENDIZ</h2>
                    <?php
                    $usuario = $base->query("SELECT * FROM usuarios WHERE pk_id_usr=$usuario")->fetchAll(PDO::FETCH_OBJ);
                    foreach ($usuario as $datos) {
                        ?>
                        <!-- Campo de ficha -->
                        <div class="form-group">
                            <label for="ficha">Codigo de Ficha:</label>
                            <input type="text" class="form-control" id="ficha" name="ficha"
                                value="<?php echo $datos->fk_id_ficha ?>" readonly>
                        </div>

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
                            <input type="text" class="form-control" id="documento" name="documento"
                                value="<?php echo $datos->pk_id_usr ?>" readonly>
                        </div>
                        <!-- Formulario para la actualizacion de los datos basicos -->
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
                                <input type="tel" class="form-control" id="telefono" name="telefono"
                                    value="<?php echo $datos->usr_telefono ?>">
                            </div>
                            <!-- Botón de guardar cambios -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <input type="submit" class="btn btn-success btn-block mt-2" name="guardarCambios"
                                    value="GUARDAR CAMBIOS">
                            </div>
                        </form>
                        <!-- Botón hoja de vida -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="hojaVida.php?id=<?php echo $datos->pk_id_usr ?>" type="button"
                                class="btn btn-primary btn-block mt-2">HOJA DE VIDA</a>
                        </div>
                    </div>
                    <div class="col-md-6 justify-content-center">
                        <!-- Formulario para la foto -->
                        <form class="row g-3" method="POST" action="../controller/foto.php" enctype="multipart/form-data">
                            <div class="col-auto">
                                <input type="text" readonly class="form-control-plaintext" value="FOTO:">
                            </div>
                            <!-- campo para subir la foto -->
                            <div class="col-auto">
                                <input type="file" class="form-control" id="foto" name="imagen" required>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-secondary mb-3">GUARDAR</button>
                            </div>
                        </form>
                        <!-- CARNET DEL APRENDIZ -->
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
    </div>
    <?php
    require_once("footer.php");
    ?>
</body>

</html>