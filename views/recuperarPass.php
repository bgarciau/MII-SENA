<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("head.php");
    ?>
</head>

<body>
    <?php
    include('../controller/conexion.php');
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- <a class="navbar-brand" href="#">MII</a> -->
            <img src="../images/mii.png" alt="" height="70px">
            <img src="../images/sena.png" alt="" height="70px">
        </div>
    </nav>
    <div style="min-height: 85vh; width: 60%; margin-left: 20%">
        <div class="container font-weight-bold text-center py-4 px-5" style="padding-bottom: 2rem;">
            <div class="card">
                <div class="card-header">
                    RECUPERAR CONTRASEÑA
                </div>
                <h6>Para recuperar su contraseña, debe digitar su documento y correo registrado, si ambos son correctos
                    se le enviara un correo con una contraseña temporal que podra cambiar al ingresar</h6>
                <!-- Campo de documento -->
                <div class="form-group mx-2">
                    <label for="documento">Documento:</label>
                    <input type="number" class="form-control" id="documento" name="documento">
                    <h6 style="color:red" id="textoDocumento" hidden>Documento no encontrado</h6>
                </div>
                <!-- Campo de correo -->
                <div class="form-group mx-2">
                    <label for="correo">Correo:</label>
                    <input type="text" class="form-control" id="correo" name="correo">
                    <h6 style="color:red" id="textoCorreo" hidden>Correo incorrecto</h6>
                </div>
                <div class="form-group mx-2">
                    <button class="btn btn-success" onclick="confirmar()">ENVIAR CORREO</button>
                    <br><br>
                    <a href="../" class="btn btn-danger">VOLVER</a>
                </div>
                <div class="card-footer">
                    Si no recuerda su correo comuniquese con un funcionario para que este actualice sus datos
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once("footer.php");
    ?>
</body>
<script src="https://smtpjs.com/v3/smtp.js"></script>
<script>
    function confirmar() {
        documento = $('#documento').val();
        correo = $('#correo').val();
        console.log(documento);
        console.log(correo);
        if (documento == "" || correo == "") {
            Swal.fire({
                title: 'Todos los campos son obligatorios',
                color: '#ffffff',
                icon: 'error',
                iconColor: 'red',
            })
        }
        else {
            enviar = "NO"
            textoCorreo = "NO"
            textoDocumento = "SI"
            <?php
            $usuarios = $base->query("SELECT pk_id_usr,usr_email FROM usuarios")->fetchAll(PDO::FETCH_OBJ);
            foreach ($usuarios as $dUsuarios) {
                ?>
                if (documento == "<?php echo $dUsuarios->pk_id_usr ?>") {
                    console.log('documento existe');
                    textoDocumento = "NO"
                    if (correo == "<?php echo $dUsuarios->usr_email ?>") {
                        console.log('correo correcto');
                        enviar = "SI"
                    }
                    else {
                        textoCorreo = "SI";
                    }
                }
                <?php
            }
            ?>
            if (textoCorreo == "SI") {
                $('#textoCorreo').prop('hidden', false)
            }
            if (textoDocumento == "SI") {
                $('#textoDocumento').prop('hidden', false)
            }
            if (textoCorreo == "NO") {
                $('#textoCorreo').prop('hidden', true)
            }
            if (textoDocumento == "NO") {
                $('#textoDocumento').prop('hidden', true)
            }
            console.log(enviar);
            if (enviar == "SI") {
                // const Url="../controller/recuperarPass.php"
                // const data = {
                //     correo: "correo"
                // }
                // $.post(Url,data,function(data, status){
                //     console.log(`${data} y status es ${status}`)
                // });
                $.post('../controller/recuperarPass.php', { email: correo, doc:documento }, function (respuesta) {
                    // alert("éxito");
                    $("#resultado").html(respuesta);
                    // console.log(respuesta);
                });
            }
        }
    }
</script>
<div id="resultado">

</div>


</html>