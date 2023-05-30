<?php
include('conexion.php');
if (isset($_GET["id"])) {
    session_start();
    $id = $_GET["id"];
    $idEmpresa = $_SESSION['usuario'];
    $query = "DELETE FROM empresaaprendiz where fk_id_aprendiz = ? and fk_id_empresa=?;";
    $sentencia = $base->prepare($query);
    $resultado = $sentencia->execute([$id,$idEmpresa]);
    header("location:../views/empresa.php");
}

?>