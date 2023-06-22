<?php
include('conexion.php');

if (isset($_GET['accion']) && $_GET['accion'] != "") {
    $accion = $_GET['accion'];
    $tipo = $_GET['tipo'];

    // SECCION PARA AGREGAR 
    if ($accion == "agregar") {
        echo "entra a agregar";
        if ($tipo == "ficha") {
            echo "agregar ficha";
            $idFicha = $_POST["idFicha"];
            $inicioFicha = $_POST["inicioFicha"];
            $terminacionFicha = $_POST["terminacionFicha"];
            // $etapaFicha = $_POST["etapaFicha"];
            $programaFicha = $_POST["programaFicha"];
            try {
                $query = "INSERT INTO fichas(pk_id_ficha,ficha_fecha_inicio,ficha_fecha_terminacion,fk_id_pro) VALUES (?,?,?,?);";
                $sentencia = $base->prepare($query);
                $resultado = $sentencia->execute([$idFicha, $inicioFicha, $terminacionFicha, $programaFicha]);
            } catch (Exception $e) {
                header('Location: ../views/formacion.php?mensaje=errorAgregarF');
                exit();
            }
        } else if ($tipo == "programa") {
            echo "agregar programa";
            $idPrograma = $_POST["idPrograma"];
            $nombrePrograma = $_POST["nombrePrograma"];
            $perfilPrograma = $_POST["perfilPrograma"];
            $ocupacionesPrograma = $_POST["ocupacionesPrograma"];
            $centroPrograma = 1;
            try {
                $query = "INSERT INTO programas(pk_id_pro,pro_nombre,pro_perfil,pro_ocupaciones,fk_id_cefo) VALUES (?,?,?,?,?);";
                $sentencia = $base->prepare($query);
                $resultado = $sentencia->execute([$idPrograma, $nombrePrograma, $perfilPrograma, $ocupacionesPrograma, $centroPrograma]);
            } catch (Exception $e) {
                header('Location: ../views/formacion.php?mensaje=errorAgregarP');
                exit();
            }
        } else if ($tipo == "centro") {
            echo "agregar centro";
            $idCentro = $_POST["idCentro"];
            $nombreCentro = $_POST["nombreCentro"];
            $regionalCentro = $_POST["regionalCentro"];
            $directorCentro = $_POST["directorCentro"];
            $subdirectorCentro = $_POST["subdirectorCentro"];
            $coordinadorCentro = $_POST["coordinadorCentro"];
            $telefonoCentro = $_POST["telefonoCentro"];
            $centrocentro = $_POST["emailCentro"];
            try {
                $query = "INSERT INTO centros_formacion(pk_id_cefo,cefo_nom_centro_formacion,cefo_nom_regional,cefo_nom_director_regional,cefo_nom_sub_director,cefo_nom_coordinador,cefo_telefono,cefo_email) VALUES (?,?,?,?,?,?,?,?);";
                $sentencia = $base->prepare($query);
                $resultado = $sentencia->execute([$idCentro, $nombreCentro, $regionalCentro, $directorCentro, $subdirectorCentro, $coordinadorCentro, $telefonoCentro, $centrocentro]);
            } catch (Exception $e) {
                header('Location: ../views/formacion.php?mensaje=error');
                exit();
            }
        }

        if ($resultado === TRUE) {
            header('Location: ../views/formacion.php');
        } else {
            header('Location: ../views/formacion.php?mensaje=error');
            exit();
        }
    }
    // SECCION PARA EDITAR
    if ($accion == "editar") {
        echo "editar ";
        if ($tipo == "ficha") {
            echo "ficha";
            $idFicha = $_POST["idFicha"];
            $inicioFicha = $_POST["inicioFicha"];
            $terminacionFicha = $_POST["terminacionFicha"];
            // $etapaFicha = $_POST["etapaFicha"];
            $programaFicha = $_POST["programaFicha"];
            try {
                $query = "UPDATE fichas SET ficha_fecha_inicio=? ,ficha_fecha_terminacion=? WHERE pk_id_ficha=$idFicha;";
                $sentencia = $base->prepare($query);
                $resultado = $sentencia->execute([$inicioFicha, $terminacionFicha]);
            } catch (Exception $e) {
                echo $e;
                // header('Location: ../views/formacion.php?mensaje=error');
                // exit();
            }
        } else if ($tipo == "programa") {
            echo "programa";
            $idPrograma = $_POST["idPrograma"];
            $nombrePrograma = $_POST["nombrePrograma"];
            $perfilPrograma = $_POST["perfilPrograma"];
            $ocupacionesPrograma = $_POST["ocupacionesPrograma"];
            // $centroPrograma = $_POST["centroPrograma"];
            try {
                $query = "UPDATE programas SET pro_nombre=? ,pro_perfil=?, pro_ocupaciones=? WHERE pk_id_pro=$idPrograma;";
                $sentencia = $base->prepare($query);
                $resultado = $sentencia->execute([$nombrePrograma, $perfilPrograma, $ocupacionesPrograma]);
            } catch (Exception $e) {
                header('Location: ../views/formacion.php?mensaje=error');
                exit();
            }
        } else if ($tipo == "centro") {
            echo "agregar centro";
            $idCentro = $_POST["idCentro"];
            $nombreCentro = $_POST["nombreCentro"];
            $regionalCentro = $_POST["regionalCentro"];
            $directorCentro = $_POST["directorCentro"];
            $subdirectorCentro = $_POST["subdirectorCentro"];
            $coordinadorCentro = $_POST["coordinadorCentro"];
            $telefonoCentro = $_POST["telefonoCentro"];
            $centrocentro = $_POST["emailCentro"];
            try {
                $query = "UPDATE centros_formacion SET cefo_nom_centro_formacion=?,cefo_nom_regional=?,cefo_nom_director_regional=?,cefo_nom_sub_director=?,cefo_nom_coordinador=?,cefo_telefono=?,cefo_email=? WHERE pk_id_cefo=$idCentro;";
                $sentencia = $base->prepare($query);
                $resultado = $sentencia->execute([$nombreCentro, $regionalCentro, $directorCentro, $subdirectorCentro, $coordinadorCentro, $telefonoCentro, $centrocentro]);
            } catch (Exception $e) {
                header('Location: ../views/formacion.php?mensaje=error');
                exit();
            }
        }

        if ($resultado === TRUE) {
            header('Location: ../views/formacion.php');
        } else {

            header('Location: ../views/formacion.php?mensaje=error');
            exit();
        }
    }
    //SECCION PARA ELIMINAR
    if ($accion == "eliminar") {
        $id = $_GET['id'];

        if ($tipo == "ficha") {
            $query = "DELETE FROM fichas where pk_id_ficha = ?;";
        } else if ($tipo == "programa") {
            $query = "DELETE FROM programas where pk_id_pro = ?;";
        } else if ($tipo == "centro") {
            $query = "DELETE FROM centros_formacion where pk_id_cefo = ?;";
        }
        try {
            $sentencia = $base->prepare($query);
            $resultado = $sentencia->execute([$id]);
        } catch (Exception $e) {
            header('Location: ../views/formacion.php?mensaje=error');
            exit();
        }

        if ($resultado === TRUE) {
            header('Location: ../views/formacion.php');
        } else {
            header('Location: ../views/formacion.php?mensaje=error');
            exit();
        }
    }

}
?>