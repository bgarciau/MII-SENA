<!DOCTYPE html>
<html lang="en">

<head>
    <!-- TITULO EN LA PESTAÑA -->
<title>MII-SENA</title>
 <!-- se establece el fav de la pagina -->
 <link rel="icon" type="image/png" href="images/miifav.png" /> 
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- bootstrap -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <!-- Jquery -->
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
 <script src="jquery/jquery.min.js"></script>
 <!-- bootstrap -->
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<!-- icnonos-->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> -->
<link href="bootstrap-icons-1.10.5/font/bootstrap-icons.css" rel="stylesheet"/> 
<!-- data table -->
<!-- <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet"/> -->
 <link href="DataTables/datatables.min.css" rel="stylesheet"/>
 <!-- sweet alert -->
<!-- <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet"> -->
<link href="sweetAlert2/dark.css" rel="stylesheet"/>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script> -->
<script src="sweetAlert2/sweetalert2.min.js"></script>
 <!-- se llaman los estilos para el contenido de la pagina -->
 <link rel="stylesheet" href="css/style.css">
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
                                    <!-- <input type="password" class="form-control" id="password" name="password" required> -->
                                    <div class="input-group">
                                        <input id="password" name="password" type="password" Class="form-control" required>
                                        <div class="input-group-append">
                                            <button id="show_password" class="btn btn-dark" type="button"
                                                onclick="mostrarPassword('password')"> <i id="icon" class="bi bi-eye-slash"></i>
                                            </button>
                                        </div>
                                    </div>
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
   <!-- Footer -->
   <div class="bg-info text-center text-lg-start">
<footer class="bg-dark text-center text-white">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    .:: Servicio Nacional de Aprendizaje SENA – Dirección General Calle 57 No. 8-69, Bogotá D.C - PBX (57 1) 5461500
Línea gratuita de atención al ciudadano Bogotá 3430111 – Resto del país 018000 910270
Horario de atención: lunes a viernes de 8:00 am a 5:30 pm
Correo electrónico para notificaciones judiciales: servicioalciudadano@sena.edu.co
Todos los derechos reservados © 2023 ::.
    </div>
    <!-- Grid container -->
    <div class="container pb-0">
        <img src="images/sena.png" alt="" height="50px">
    </div>
    <!-- Grid container -->
</footer>
</div>
<!-- Footer -->
<!-- data tables -->
<script src="DataTables/datatables.min.js"></script>
</body>
<script type="text/javascript">
    function mostrarPassword(nombreInput){
        // console.log("entra a la funcion mostrar pass");
        // console.log($('#password').prop('type'));
		if($('#'+nombreInput).prop('type') == "password"){
            // console.log("entra a tipo password");
			$('#'+nombreInput).prop('type',"text");
			$('#icon').removeClass('bi bi-eye-slash').addClass('bi bi-eye');
		}else{
            // console.log("entra a tipo text");
			$('#'+nombreInput).prop('type',"password");
			$('#icon').removeClass('bi bi-eye').addClass('bi bi-eye-slash');
		}
	}
    // MENSAJE PARA CUANDO EL APRENDIZ COMPLETO EL REGISTRO
    $(document).ready(function () {
        console.log('<?php if(isset($_GET['mensajeRegistro'])){echo $_GET['mensajeRegistro'];}else{echo "no";} ?>')
        if ('<?php if(isset($_GET['mensajeRegistro'])){echo $_GET['mensajeRegistro'];}else{echo "no";} ?>' == 'si') {
            Swal.fire({
                title: '<?php if(isset($_GET['usuario'])){echo $_GET['usuario'];}else{echo "no";} ?> su registro ha sido exitoso ahora puede iniciar sesion',
                color: '#ffffff',
                icon: 'success',
                iconColor: 'green',
            })
        }
    });
</script>

</html>