<?php
session_start();
include('conexion.php');
$tipo = $_SESSION['tipo'];
// Lo que hace el APRENDIZ
if ($tipo == 1) {
    // DATOS APRENDIZ
    $usuario = $_POST['documento'];
    $correo = $_POST['correo_misena'];
    $fecha_nacimieno = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefonos'];
    $libreta_militar = $_POST['libreta_militar'];
    $direccion = $_POST['direccion'];
    $estrato = $_POST['estrato'];
    $ciudad = $_POST['ciudad'];
    $hv="si";

    $sql = "UPDATE usuarios SET usr_email=?,usr_fecha_nacimiento=? ,usr_telefono=?, usr_libreta_militar=?, usr_direccion=?, usr_estrato=?, usr_ciudad=?, usr_hv=? WHERE pk_id_usr=$usuario;";
    $stmt = $base->prepare($sql);
    $stmt->execute([$correo, $fecha_nacimieno, $telefono, $libreta_militar, $direccion, $estrato, $ciudad,$hv]);

    // datos BACHILLER
    $titulo_obtenido = $_POST['titulo_obtenido'];
    $institucion_educativa = $_POST['institucion_educativa'];
    $fecha_de_grado = $_POST['fecha_de_grado'];
    $sql = "UPDATE estudio SET estudio_titulo=? ,estudio_institucion=?, estudio_fecha_grado=? WHERE fk_id_usr=$usuario and numero=1";
    $stmt = $base->prepare($sql);
    $stmt->execute([$titulo_obtenido, $institucion_educativa, $fecha_de_grado]);

    //DATOS OTROS ESTUDIOS
    $nivel = $_POST['nivel'];
    $nombre_estudios = $_POST['nombre_estudios'];
    $institucion_educativa2 = $_POST['institucion_educativa2'];
    $semestres_aprovados = $_POST['semestres_aprovados'];
    $numero = 2;
    try {
        $sql = "DELETE FROM estudio WHERE fk_id_usr=$usuario and numero=2";
        $stmt = $base->prepare($sql);
        $stmt->execute();

        $sql = "INSERT INTO estudio (numero,tipo_estudio,estudio_titulo,estudio_institucion,estudio_semestres_aprobados,fk_id_usr) VALUES (?,?,?,?,?,?)";
        $stmt = $base->prepare($sql);
        $stmt->execute([$numero, $nivel, $nombre_estudios, $institucion_educativa2, $semestres_aprovados, $usuario]);
    } catch (Exception $e) {
        echo $e;
    }
    header("location: ../views/aprendiz.php?hojaVida=si");
    echo "todo correcto";
}
// LO QUE HACE EL FUNCIONARIO
else if ($tipo == 2) {

}
// LO QUE HACE LA EMPRESA
else if ($tipo == 3) {
    $nombreRecursos = $_POST['nombreRecursos'];
    $telefonoRecursos = $_POST['telefonoRecursos'];
    $correoRecursos = $_POST['correoRecursos'];
    $observacionesRecursos = $_POST['observacionesRecursos'];
    $ciudadDilegenciamiento = $_POST['ciudadDilegenciamiento'];
    $fechaDiligenciamiento = $_POST['fechaDiligenciamiento'];
    $idAprendiz = $_POST['idAprendiz'];
    $idEmpresa = $_POST['idEmpresa'];
    
    // $firmaResursos = $_POST['firmaResursos'];
    if(isset($_POST['contratar'])){
        $contrata="si";
    }
    else if(isset($_POST['NoContratar'])){
        $contrata="no";
    }

    echo $contrata;
    try {
        $idAprendices = $base->query("SELECT * FROM empresaaprendiz WHERE fk_id_aprendiz=$idAprendiz and fk_id_empresa=$idEmpresa;")->fetchAll(PDO::FETCH_OBJ);
        $existe=0;
        foreach ($idAprendices as $idAprendiz) {
            $existe=1;
        }
        if($existe==0){
        $sql = "INSERT INTO empresaaprendiz (nom_funcionario,telefono,correo,observaciones,contratar,ciudad_diligenciamiento,fecha_diligenciamiento,fk_id_empresa,fk_id_aprendiz) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = $base->prepare($sql);
        $stmt->execute([$nombreRecursos, $telefonoRecursos, $correoRecursos, $observacionesRecursos,$contrata, $ciudadDilegenciamiento, $fechaDiligenciamiento, $idEmpresa, $idAprendiz ]);
        }
    } catch (Exception $e) {
        echo $e;
    }
    header("location: ../views/empresa.php");
}