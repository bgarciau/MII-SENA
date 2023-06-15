<?php
include('conexion.php');

    $documento = $_POST['documento'];
    $contrasena = $_POST['contrasena'];
    $tipo="no";
    if(isset($_POST['tipo'])){
        $tipo=$_POST['tipo'];
    }
    $pass_cifrado = password_hash($contrasena, PASSWORD_DEFAULT, array("cost" => 7)); //Encripta la clave 
        // Inserta en la base de datos un nuevo usuario
    try {
        // crea el usuario
        $sql = "UPDATE usuarios SET  login_pass=? WHERE pk_id_usr=$documento";
        $stmt = $base->prepare($sql);
        $stmt->execute([$pass_cifrado]);

    } catch (Exception $e) {
        echo $e;
    }
    $url= $_SERVER["HTTP_REFERER"];
    // echo '<script language="javascript">alert("juas");</script>';
    if($tipo=="no"){
        header("location: $url&contrasena=si");
    }
    else{
        header("location: $url?contrasena=si");
    }