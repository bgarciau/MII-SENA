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
    include('../controller/conexion.php');
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
    } else {
        echo "NECESITA EL ID DEL USUARIO";
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <img src="images/mii.png" alt="" height="70px">
        </div>
    </nav>
    <!-- MUESTRA EL CARNET, SIN NECESIDAD DE INICIAR SESION, SOLO CON ESCANEAR EL QR -->
    <div style="min-height: 85vh;">
        <div class="container mt-2" style="padding-top:2rem">
            <div class="row">
            <div class="col-md-2">
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <a href="../"><button type="botton" class="btn btn-danger mb-3 btn-block">SALIR</button></a>
                    </div>
                    <div class="carnet-body">
                        <?php
                        $usuario = $base->query("SELECT * FROM usuarios WHERE pk_id_usr=$id")->fetchAll(PDO::FETCH_OBJ);
                        foreach ($usuario as $datos) {
                            ?>
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
                                <div style="float:none">
                                    <img src="../carnetQr/<?php echo $datos->pk_id_usr ?>.png" style="margin-left:2rem"
                                        alt="" width="140px" height="140px">
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
                        <?php
                        }
                        ?>
                </div>
                <div class="col-md-4 align-self-center">
                        <img src="../carnetQr/<?php echo $id ?>.png" style="margin-left:2rem" alt="" width="300px">
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once("footer.php");
    ?>
</body>

</html>