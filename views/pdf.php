<?php
require('../fpdf/fpdf.php');
include('../controller/conexion.php');
// ID PARA TOMAR LOS DATOS DE LA HOJA DE VIDA
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
$usuario = $base->query("SELECT * FROM usuarios WHERE pk_id_usr=$id")->fetchAll(PDO::FETCH_OBJ);
foreach ($usuario as $datos) {
    if($datos->usr_hv=='si'){
    class PDF extends FPDF
    {
        // Pie de página
        function Footer()
        {
            // Posición: a 1,5 cm del final
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial', 'I', 10);
            // Número de página
            $this->Cell(0, 10, $this->PageNo(), 0, 0, 'C');
        }
    }
    // Creación del objeto de la clase heredada
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('PORTRAIT', 'letter');
    // $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
// $pdf->SetFont('DejaVu','',14);
// HEADER ----------------------------------------------------------------------------------------
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(170, 25, '', 1, 0, false);
    $pdf->Cell(25, 25, '', 1, 0, false);
    $pdf->Write(2, 'HOJA DE VIDA APRENDICES EN PROGRAMAS DE FORMACION TITULADA');
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 8);
    $pdf->Write(8, 'F04-9124-002/ 06-10');
    $pdf->Ln();
    $pdf->Write(5, 'Ejecucion de la Formacion Profesional');
    $pdf->Ln();
    $pdf->Write(5, 'Desarrollo Curricular');
    $pdf->Image('../images/sena2.jpg', 182, 12, 20, 20, 'jpg');
    $pdf->Ln(10);
    // ----------------------------------------------------------------------------------------------
// INFORMACION GENERAL DEL APRENDIZ--------------------------------------------------------------
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFillColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(100, 6, '1.- INFORMACION GENERAL DEL APRENDIZ', 1, 0, false, 1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 8);
    $pdf->Write(5, ' Informacion personal del aprendiz. Usted como empleador podra solicitar ampliacion de esta.');
    $pdf->Ln();
    $pdf->Image($datos->foto, 170, 48, 35, 40);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(60, 5, 'NOMBRES Y APELLIDOS', 1, 0, false);
    $pdf->Cell(100, 5, $datos->usr_nombre . " " . $datos->usr_apellidos, 1, 0, false);
    $pdf->Ln();
    $pdf->Cell(60, 5, 'DOCUMENTO IDENTIDAD', 1, 0, false);
    $pdf->Cell(100, 5, $datos->pk_id_usr, 1, 0, false);
    $pdf->Ln();
    $pdf->Cell(60, 5, 'FECHA NACIMIENTO', 1, 0, false);
    $pdf->Cell(50, 5, $datos->usr_fecha_nacimiento, 1, 0, false);
    $pdf->Cell(20, 5, 'EDAD', 1, 0, false);
    $nacimiento = new DateTime($datos->usr_fecha_nacimiento);
    $ahora = new DateTime(date("Y-m-d"));
    $edad = $ahora->diff($nacimiento);
    $pdf->Cell(30, 5, $edad->format("%y"), 1, 0, false);
    $pdf->Ln();
    $pdf->Cell(60, 5, 'TELEFONOS', 1, 0, false);
    $pdf->Cell(100, 5, $datos->usr_telefono, 1, 0, false);
    $pdf->Ln();
    $pdf->Cell(60, 5, 'CORREO ELECTRONICO MISENA', 1, 0, false);
    $pdf->Cell(100, 5, $datos->usr_email, 1, 0, false);
    $pdf->Ln();
    $pdf->Cell(60, 5, 'LIBRETA MILITAR', 1, 0, false);
    $pdf->Cell(100, 5, $datos->usr_libreta_militar, 1, 0, false);
    $pdf->Ln();
    $pdf->Cell(60, 5, 'DIRECCION DOMICILIO', 1, 0, false);
    $pdf->Cell(100, 5, $datos->usr_direccion, 1, 0, false);
    $pdf->Ln();
    $pdf->Cell(60, 5, 'ESTRATO', 1, 0, false);
    $pdf->Cell(100, 5, $datos->usr_estrato, 1, 0, false);
    $pdf->Ln();
    $pdf->Cell(60, 5, 'CIUDAD', 1, 0, false);
    $pdf->Cell(100, 5, $datos->usr_ciudad, 1, 0, false);
    $pdf->Cell(35, 5, '', 1, 0, false);
    $pdf->Ln(8);
    // ----------------------------------------------------------------------------------------------
// FORMACION ACADEMICA--------------------------------------------------------------
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFillColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(100, 6, '2.- FORMACION ACADEMICA', 1, 0, false, 1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 8);
    $pdf->Write(5, ' Digite la información referente al título obtenido en el grado 11 que corresponde a la educación media.');
    $pdf->Ln();
    $estudios = $base->query("SELECT * FROM estudio WHERE fk_id_usr=$id and numero=1")->fetchAll(PDO::FETCH_OBJ);
    foreach ($estudios as $estudio) {
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(60, 5, 'TITULO OBTENIDO', 1, 0, false);
        $pdf->Cell(135, 5, $estudio->tipo_estudio, 1, 0, false);
        $pdf->Ln();
        $pdf->Cell(60, 5, 'INSTITUCION EDUCATIVA', 1, 0, false);
        $pdf->Cell(135, 5, $estudio->estudio_institucion, 1, 0, false);
        $pdf->Ln();
        $pdf->Cell(60, 5, 'FECHA DE GRADO', 1, 0, false);
        $pdf->Cell(135, 5, $estudio->estudio_fecha_grado, 1, 0, false);
    }
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 8);
    $pdf->Write(5, 'Si usted ha realizado estudios de nivel superior como TEcnico TC, Tecnologo TL, Especializacion Tecnologica TE, Universitaria UN, Especializacion ES,');
    $pdf->Write(4, 'Maestria MG, Doctorado DOC, relacionelos a continuacion');
    $pdf->SetFont('Arial', 'B', 10);
    $estudios2 = $base->query("SELECT * FROM estudio WHERE fk_id_usr=$id and numero=2")->fetchAll(PDO::FETCH_OBJ);
    if ($estudios2) {
        foreach ($estudios2 as $estudio2) {
            $pdf->Ln();
            $pdf->Cell(60, 5, 'NIVEL', 1, 0, false);
            $pdf->Cell(135, 5, $estudio2->tipo_estudio, 1, 0, false);
            $pdf->Ln();
            $pdf->Cell(60, 5, 'NOMBRE DE LOS ESTUDIOS', 1, 0, false);
            $pdf->Cell(135, 5, $estudio2->estudio_titulo, 1, 0, false);
            $pdf->Ln();
            $pdf->Cell(60, 5, 'INSTITUCION EDUCATIVA', 1, 0, false);
            $pdf->Cell(135, 5, $estudio2->estudio_institucion, 1, 0, false);
            $pdf->Ln();
            $pdf->Cell(60, 5, 'SEMESTRES APROBADOS', 1, 0, false);
            $pdf->Cell(135, 5, $estudio2->estudio_semestres_aprobados, 1, 0, false);
            $pdf->Ln(8);
        }
    } else {
        $pdf->Ln();
        $pdf->Cell(60, 5, 'NIVEL', 1, 0, false);
        $pdf->Cell(135, 5, '', 1, 0, false);
        $pdf->Ln();
        $pdf->Cell(60, 5, 'NOMBRE DE LOS ESTUDIOS', 1, 0, false);
        $pdf->Cell(135, 5, '', 1, 0, false);
        $pdf->Ln();
        $pdf->Cell(60, 5, 'INSTITUCION EDUCATIVA', 1, 0, false);
        $pdf->Cell(135, 5, '', 1, 0, false);
        $pdf->Ln();
        $pdf->Cell(60, 5, 'SEMESTRES APROBADOS', 1, 0, false);
        $pdf->Cell(135, 5, '', 1, 0, false);
        $pdf->Ln(8);
    }
    // ----------------------------------------------------------------------------------------------
// INFORMACION PROGRAMA DE FORMACION--------------------------------------------------------------
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFillColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(100, 6, '3.- INFORMACION PROGRAMA DE FORMACION', 1, 0, false, 1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Ln();
    $idFicha = $datos->fk_id_ficha;
    $ficha = $base->query("SELECT * FROM fichas WHERE pk_id_ficha=$idFicha")->fetchAll(PDO::FETCH_OBJ);
    foreach ($ficha as $datosFicha) {
        $idPrograma = $datosFicha->fk_id_pro;
        $programa = $base->query("SELECT * FROM programas WHERE pk_id_pro=$idPrograma")->fetchAll(PDO::FETCH_OBJ);
        foreach ($programa as $datosPrograma) {
            $idCentro = $datosPrograma->fk_id_cefo;
            $centro = $base->query("SELECT * FROM centros_formacion WHERE pk_id_cefo=$idCentro")->fetchAll(PDO::FETCH_OBJ);
            foreach ($centro as $datosCentro) {
                $pdf->SetFont('Arial', '', 8);
                $pdf->Write(5, ' Informacion relevante del programa de formacion, para mas informacion podra contactar al Coordinador Academico');
                $pdf->Ln();
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(60, 5, 'NOMBRE DEL PROGRAMA', 1, 0, false);
                $pdf->Cell(135, 5, $datosPrograma->pro_nombre, 1, 0, false);
                $pdf->Ln();
                $pdf->Cell(60, 5, 'CODIGO DE FICHA', 1, 0, false);
                $pdf->Cell(135, 5, $idPrograma, 1, 0, false);
                $pdf->Ln();
                $pdf->Cell(60, 5, 'PERFIL OCUPACIONAL', 1, 0, false);
                $pdf->Cell(135, 5, $datosPrograma->pro_perfil, 1, 0, false);
                $pdf->Ln();
                $pdf->Cell(60, 5, 'OCUPACIONES A DESEMPENAR', 1, 0, false);
                $pdf->Cell(135, 5, $datosPrograma->pro_ocupaciones, 1, 0, false);
                $pdf->Ln();
                $pdf->Cell(60, 5, 'CENTRO DE FORMACION', 1, 0, false);
                $pdf->Cell(135, 5, $datosCentro->cefo_nom_centro_formacion, 1, 0, false);
                $pdf->Ln();
                $pdf->Cell(60, 5, 'CIUDAD DE FORMACION', 1, 0, false);
                $pdf->Cell(135, 5, $datosCentro->cefo_nom_regional, 1, 0, false);
                $pdf->Ln();
                $pdf->Cell(60, 5, 'FECHA DE INICIO', 1, 0, false);
                $pdf->Cell(135, 5, $datosFicha->ficha_fecha_inicio, 1, 0, false);
                $pdf->Ln();
                $pdf->Cell(60, 5, 'FECHA DE TERMINACION', 1, 0, false);
                $pdf->Cell(135, 5, $datosFicha->ficha_fecha_terminacion, 1, 0, false);
                $pdf->Ln();
                $pdf->Cell(60, 5, 'ETAPA (Lectiva- Practica)', 1, 0, false);
                $pdf->Cell(135, 5, $datosFicha->ficha_etapa, 1, 0, false);
                $pdf->Ln();
                $pdf->Cell(60, 5, 'COORDINADOR ACADEMICO', 1, 0, false);
                $pdf->Cell(135, 5, $datosCentro->cefo_nom_coordinador, 1, 0, false);
                $pdf->Ln();
                $pdf->Cell(60, 5, 'TELEFONO CONTACTO', 1, 0, false);
                $pdf->Cell(135, 5, $datosCentro->cefo_telefono, 1, 0, false);
                $pdf->Ln();
                $pdf->Cell(60, 5, 'CORREO ELECTRONICO', 1, 0, false);
                $pdf->Cell(135, 5, $datosCentro->cefo_email, 1, 0, false);
                $pdf->Ln(8);
            }
        }
    }
    // ----------------------------------------------------------------------------------------------
// 4 FIRMA DEL APRENDIZ--------------------------------------------------------------
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFillColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(100, 6, '4.- FIRMA DEL APRENDIZ', 1, 0, false, 1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Ln(8);
    $pdf->Cell(195, 24, '', 1, 0, false);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Write(1.5, 'MANIFIESTO BAJO LA GRAVEDAD DEL JURAMENTO QUE NO ME ENCUENTRO DENTRO DE LAS CAUSALES DE INHABILIDAD E');
    $pdf->Write(2.7, 'INCOMPATIBILIDAD QUE CONTRAVENGAN EL REGLAMENTO ESTUDIANTIL O TERMINOS LEGALES, PARA DESARROLLAR LA ETAPA');
    $pdf->Write(3, 'PRACTICA DESEMPENANDOME EN UNA EMPRESA A TRAVES DEL CONTRATO DE APRENDIZAJE. PARA TODOS LOS EFECTOS LEGALES,');
    $pdf->Write(3, 'CERTIFICO QUE LOS DATOS POR MI ANOTADOS EN EL PRESENTE FORMATO DE HOJA DE VIDA, SON VERACES');
    $pdf->Ln(8);
    $pdf->Write(5, 'Ciudad y Fecha de Diligenciamiento: ______________________________________FIRMA: _______________________________');
    $pdf->Ln(8);
    // ----------------------------------------------------------------------------------------------
// FIRMA FUNCIONARIO PROMOCION Y RELACIONAMIENTO CORPORATIVO SENA--------------------------------------------------------------
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFillColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(150, 6, '5.- FIRMA FUNCIONARIO PROMOCION Y RELACIONAMIENTO CORPORATIVO SENA', 1, 0, false, 1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 8);
    $pdf->Write(5, ' Informacion del funcionario encargado en el Centro de Formacion. Contacte para la legalizacion del contrato de aprendizaje');
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(60, 5, 'NOMBRE FUNCIONARIO', 1, 0, false);
    $pdf->Cell(135, 5, '', 1, 0, false);
    $pdf->Ln();
    $pdf->Cell(60, 5, 'TELEFONO', 1, 0, false);
    $pdf->Cell(135, 5, '', 1, 0, false);
    $pdf->Ln();
    $pdf->Cell(60, 5, 'CORREO ELECTRONICO', 1, 0, false);
    $pdf->Cell(135, 5, '', 1, 0, false);
    $pdf->Ln(8);
    // ----------------------------------------------------------------------------------------------
// INFORMACION SERVICIO NACIONAL DE APRENDIZAJE-------------------------------------------------------------
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFillColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(150, 6, '6.- INFORMACION SERVICIO NACIONAL DE APRENDIZAJE', 1, 0, false, 1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 8);
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(60, 5, 'NIT', 1, 0, false);
    $pdf->Cell(135, 5, '', 1, 0, false);
    $pdf->Ln();
    $pdf->Cell(60, 5, 'CENTRO FORMACION', 1, 0, false);
    $pdf->Cell(135, 5, '', 1, 0, false);
    $pdf->Ln();
    $pdf->Cell(60, 5, 'REPRESENTANTE LEGAL', 1, 0, false);
    $pdf->Cell(135, 5, '', 1, 0, false);
    $pdf->Ln();
    $pdf->Cell(60, 5, 'CORREO ELECTRONICO', 1, 0, false);
    $pdf->Cell(135, 5, '', 1, 0, false);
    $pdf->Ln();
    $pdf->Cell(60, 5, 'TELEFONO', 1, 0, false);
    $pdf->Cell(135, 5, '', 1, 0, false);
    $pdf->Ln(8);
    // ----------------------------------------------------------------------------------------------
// OBSERVACIONES DEL JEFE DE RECURSOS HUMANOS Y/O CONTRATOS-------------------------------------------------------------
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFillColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(150, 6, '7.- OBSERVACIONES DEL JEFE DE RECURSOS HUMANOS Y/O CONTRATOS', 1, 0, false, 1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 8);
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(60, 5, 'EMPRESA', 1, 0, false);
    $pdf->Cell(135, 5, '', 1, 0, false);
    $pdf->Ln();
    $pdf->Cell(60, 5, 'TELEFONO', 1, 0, false);
    $pdf->Cell(135, 5, '', 1, 0, false);
    $pdf->Ln();
    $pdf->Cell(60, 5, 'FUNCIONARIO', 1, 0, false);
    $pdf->Cell(135, 5, '', 1, 0, false);
    $pdf->Ln();
    $pdf->Cell(195, 85, '', 1, 0, false);
    $pdf->Write(2, 'OBSERVACIONES');
    $pdf->Ln(65);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Write(2, 'Marque con una x la decisiOn de contratar al aprendiz. Seleccionado: _____ No Seleccionado: ____ ');
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Write(2, 'Ciudad y Fecha de Diligenciamiento: _____________________________FIRMA: _______________________________');
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Write(5, 'Solicitamos a la empresa imprimir y suministrar copia de este documento una vez realizada la evaluacion del aprendiz que sera remitida a la oficina de
Relacionamiento Corporativo del Centro de Formacion.');
    // ----------------------------------------------------------------------------------------------
    $pdf->Output();
}else{
    echo "NO HA COMPLETADO SU HOJA DE VIDA";
}
}
?>