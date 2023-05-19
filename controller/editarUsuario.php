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
    $contrasena = $_POST['contrasena'];
    $ficha = $_POST['ficha'];
    // Inserta en la base de datos un nuevo usuario
    try {
        // crea el usuario
        $sql = "UPDATE usuarios SET usr_nombre=?, usr_apellidos=?, usr_email=?,usr_rh=?, usr_telefono=?, login_pass=?,fk_id_tipo_doc=?,fk_id_ficha =? WHERE pk_id_usr=$documento";
        $stmt = $base->prepare($sql);
        $stmt->execute([$nombres, $apellidos, $correo, $rh, $telefono, $contrasena, $tipoDocumento, $ficha]);

    } catch (Exception $e) {
        echo $e;
    }
    header("location: ../views/buscarAprendices.php");
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
    $contrasena = $_POST['contrasena'];
    $foto = "../fotos/defecto.jpg";

    // Inserta en la base de datos un nuevo usuario
    try {
        $sql = "UPDATE usuarios SET   usr_nombre=? , usr_apellidos=? , usr_email=? ,usr_rh=? , usr_telefono=? , login_pass=? ,fk_id_tipo_doc=?,usr_cargo =? WHERE pk_id_usr=$documento";
        $stmt = $base->prepare($sql);
        $stmt->execute([$nombres, $apellidos, $correo, $rh, $telefono, $contrasena, $tipoDocumento, $cargo]);

    } catch (Exception $e) {
        echo $e;
    }
    header("location: ../views/buscarFuncionarios.php");
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
    $contrasena = $_POST['contrasena'];

    // Inserta en la base de datos un nuevo usuario
    try {
        // crea el usuario
        $sql = "INSERT INTO usuarios (pk_id_usr,usr_empresa, usr_nombre, usr_apellidos, usr_email, usr_telefono, login_pass,fk_id_tipo_usr ) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $base->prepare($sql);
        $stmt->execute([$nit,$nombreEmpresa, $nombres, $apellidos, $correo,  $telefono, $contrasena, $tipoUsr]);

    } catch (Exception $e) {
        echo $e;
    }
    header("location: ../views/buscarEmpresas.php");
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
    $contrasena = $_POST['contrasena'];
    $foto = "../fotos/defecto.jpg";

    // Inserta en la base de datos un nuevo usuario
    try {
        // crea el usuario
        $sql = "INSERT INTO usuarios (pk_id_usr, usr_nombre, usr_apellidos, usr_email,usr_rh, usr_telefono, login_pass,fk_id_tipo_doc, fk_id_tipo_usr,foto ) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $base->prepare($sql);
        $stmt->execute([$documento, $nombres, $apellidos, $correo, $rh, $telefono, $contrasena, $tipoDocumento, $tipoUsr, $foto]);

    } catch (Exception $e) {
        echo $e;
    }
    header("location: ../views/buscarInstructores.php");
}
