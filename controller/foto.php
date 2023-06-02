<?php
session_start();
include('conexion.php');

$usuario = $_SESSION["usuario"];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mii";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    // Ruta de la carpeta donde se guardará el archivo
    $carpeta_destino = "../fotos/";

    // Nombre del archivo
    $nombre_archivo = $_FILES['imagen']['name'];

    // Ruta completa del archivo
    $ruta_archivo = $carpeta_destino . $nombre_archivo;

    // Mover el archivo a la carpeta destino
    move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_archivo);

    // Guardar la ruta del archivo en la base de datos
    $sql = "UPDATE usuarios SET foto='$ruta_archivo' WHERE pk_id_usr=$usuario";
    if (mysqli_query($conn, $sql)) {
        echo "Archivo guardado correctamente";
        $url= $_SERVER["HTTP_REFERER"];
        header('Location:'.$url.'');
    } else {
        echo "Error al guardar el archivo: " . mysqli_error($conn);
    }
}
?>