<?php
include('conexion.php');
require '../phpqrcode/qrlib.php';

$tipoUsr = $_POST['tipoUsr'];
// REGISTRO APRENDIZ
if ($tipoUsr == 1) {
    // Definimos los valores recibidos por el form
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $tipoDocumento = $_POST['tipoDocumento'];
    $documento = $_POST['documento'];
    $rh = $_POST['rh'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $ficha = $_POST['ficha'];
    // Inserta en la base de datos un nuevo usuario
    try {
        // crea el usuario
        $sql = "UPDATE usuarios SET usr_nombre=?, usr_apellidos=?, usr_email=?,usr_rh=?, usr_telefono=?,fk_id_tipo_doc=?,fk_id_ficha =? WHERE pk_id_usr=$documento";
        $stmt = $base->prepare($sql);
        $stmt->execute([$nombres, $apellidos, $correo, $rh, $telefono, $tipoDocumento, $ficha]);

    } catch (Exception $e) {
        echo $e;
    }
    header("location: javascript:history.back(-1);");
}
// REGISTRO FUNCIONARIO
else if ($tipoUsr == 2) {
    // Definimos los valores recibidos por el form
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $tipoDocumento = $_POST['tipoDocumento'];
    $documento = $_POST['documento'];
    $rh = $_POST['rh'];
    $cargo = $_POST['cargo'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $foto = "../fotos/defecto.jpg";

    // Inserta en la base de datos un nuevo usuario
    try {
        $sql = "UPDATE usuarios SET   usr_nombre=? , usr_apellidos=? , usr_email=? ,usr_rh=? , usr_telefono=? ,fk_id_tipo_doc=?,usr_cargo =? WHERE pk_id_usr=$documento";
        $stmt = $base->prepare($sql);
        $stmt->execute([$nombres, $apellidos, $correo, $rh, $telefono, $tipoDocumento, $cargo]);

    } catch (Exception $e) {
        echo $e;
    }
    // header("location: javascript:history.back(-1);");
}
// REGISTRO EMPRESA
else if ($tipoUsr == 3) {
    // Definimos los valores recibidos por el form
    $nombreEmpresa = $_POST['nombreEmpresa'];
    $nit = $_POST['nit'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    // Inserta en la base de datos un nuevo usuario
    try {
        // crea el usuario
        $sql = "UPDATE usuarios SET usr_empresa=?, usr_nombre=?, usr_apellidos=?, usr_email=?, usr_telefono=?,fk_id_tipo_usr=? WHERE pk_id_usr=$nit";
        $stmt = $base->prepare($sql);
        $stmt->execute([$nombreEmpresa, $nombres, $apellidos, $correo,  $telefono, $tipoUsr]);

    } catch (Exception $e) {
        echo $e;
    }
    header("location: javascript:history.back(-1);");
}
// REGISTRO INSTRUCTOR
else if ($tipoUsr == 4) {
    // Definimos los valores recibidos por el form
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $tipoDocumento = $_POST['tipoDocumento'];
    $documento = $_POST['documento'];
    $rh = $_POST['rh'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    // Inserta en la base de datos un nuevo usuario
    try {
        // crea el usuario
        $sql = "UPDATE usuarios SET usr_nombre=?, usr_apellidos=?, usr_email=?,usr_rh=?, usr_telefono=?,fk_id_tipo_doc=?, fk_id_tipo_usr=? WHERE pk_id_usr=$documento";
        $stmt = $base->prepare($sql);
        $stmt->execute([$nombres, $apellidos, $correo, $rh, $telefono, $tipoDocumento, $tipoUsr]);

    } catch (Exception $e) {
        echo $e;
    }
    header("location: javascript:history.back(-1);");
}
