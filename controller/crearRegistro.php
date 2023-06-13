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
    $pass_cifrado = password_hash($contrasena, PASSWORD_DEFAULT, array("cost" => 7)); //Encripta la clave 
    $ficha = $_POST['ficha'];
    $foto = "../fotos/defecto.jpg";

    // Inserta en la base de datos un nuevo usuario
    try {
        // crea el usuario
        $sql = "INSERT INTO usuarios (pk_id_usr, usr_nombre, usr_apellidos, usr_email,usr_rh, usr_telefono, login_pass,fk_id_tipo_doc, fk_id_tipo_usr,fk_id_ficha ,foto ) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $base->prepare($sql);
        $stmt->execute([$documento, $nombres, $apellidos, $correo, $rh, $telefono, $pass_cifrado, $tipoDocumento, $tipoUsr, $ficha, $foto]);

        // crea los estudios del usuario
        $numero = 1;
        $tipo_estudio = "BACHILLER";
        $sql = "INSERT INTO estudio (numero,tipo_estudio,fk_id_usr) VALUES (?,?,?)";
        $stmt = $base->prepare($sql);
        $stmt->execute([$numero, $tipo_estudio, $documento]);
    } catch (Exception $e) {
        echo $e;
    }
    header("location: ../?mensajeRegistro=si&usuario=$nombres");
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
    $pass_cifrado = password_hash($contrasena, PASSWORD_DEFAULT, array("cost" => 7)); //Encripta la clave 
    $foto = "../fotos/defecto.jpg";

    // Inserta en la base de datos un nuevo usuario
    try {
        // crea el usuario
        $sql = "INSERT INTO usuarios (pk_id_usr, usr_nombre, usr_apellidos, usr_email,usr_rh, usr_telefono, login_pass,fk_id_tipo_doc, fk_id_tipo_usr,usr_cargo ,foto ) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $base->prepare($sql);
        $stmt->execute([$documento, $nombres, $apellidos, $correo, $rh, $telefono, $pass_cifrado, $tipoDocumento, $tipoUsr, $cargo, $foto]);

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
    $pass_cifrado = password_hash($contrasena, PASSWORD_DEFAULT, array("cost" => 7)); //Encripta la clave 

    // Inserta en la base de datos un nuevo usuario
    try {
        // crea el usuario
        $sql = "INSERT INTO usuarios (pk_id_usr,usr_empresa, usr_nombre, usr_apellidos, usr_email, usr_telefono, login_pass,fk_id_tipo_usr ) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $base->prepare($sql);
        $stmt->execute([$nit,$nombreEmpresa, $nombres, $apellidos, $correo,  $telefono, $pass_cifrado, $tipoUsr]);

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
    $pass_cifrado = password_hash($contrasena, PASSWORD_DEFAULT, array("cost" => 7)); //Encripta la clave 
    $foto = "../fotos/defecto.jpg";

    // Inserta en la base de datos un nuevo usuario
    try {
        // crea el usuario
        $sql = "INSERT INTO usuarios (pk_id_usr, usr_nombre, usr_apellidos, usr_email,usr_rh, usr_telefono, login_pass,fk_id_tipo_doc, fk_id_tipo_usr,foto ) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $base->prepare($sql);
        $stmt->execute([$documento, $nombres, $apellidos, $correo, $rh, $telefono, $pass_cifrado, $tipoDocumento, $tipoUsr, $foto]);

    } catch (Exception $e) {
        echo $e;
    }
    header("location: ../views/buscarInstructores.php");
}
