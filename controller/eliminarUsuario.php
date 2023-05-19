<?php
include('conexion.php');
require '../phpqrcode/qrlib.php';

$id = $_GET['id'];
// ELIMINAR USUARIO
$query = "DELETE FROM usuarios where pk_id_usr = ?;";
$sentencia = $base->prepare($query);
$resultado = $sentencia->execute([$id]);

header("location: javascript:history.back(-1);");