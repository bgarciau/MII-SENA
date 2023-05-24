<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("head.php");
    ?>
</head>

<body>
    <?php
    session_start();
    require_once("header.php");
    include('../controller/conexion.php');
    $tipo=$_SESSION["tipo"];
    // ID PARA TOMAR LOS DATOS DE LA HOJA DE VIDA
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
    }
    $idEmpresa=$_SESSION["usuario"];
    ?>
    <!-- SE MUESTRAN LOS DATOS DE LA HOJA DE VIDA QUE YA HAN SIDO INGRESADOS Y TAMBIEN SE PUEDEN ACTUAIZAR -->
    <!-- EL APRENDIZ PUEDE VER SU PROPIA HOJA DE VIDA Y EDITARLA -->
    <!-- LA EMPRESA PUEDE VER LA HOJA DE VIDA DEL APRENDIZ SELECCIONADO Y DECIDIR SI SELECCIOARLO O NO-->
    <!-- EL FUNCIONARIO PUEDE VER LA HOJA DE VIDA -->
    <div style="min-height: 85vh;">
        <div class="container">
            <h1 class="text-center">HOJA DE VIDA</h1>
        </div>
        <?php
        $usuario = $base->query("SELECT * FROM usuarios WHERE pk_id_usr=$id")->fetchAll(PDO::FETCH_OBJ);
        foreach ($usuario as $datos) {
            ?>
            <div style="margin:1rem 4rem;">
                <form action="../controller/guardarHojaVida.php" method="post" enctype="multipart/form-data">
                    <div class="accordion" style="padding-bottom:1rem" data-bs-theme="light"
                        id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseOne">
                                    #1 INFORMACION GENERAL DEL APRENDIZ
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                <h6>Informacion personal del aprendiz.Usted como empleador podra solicitar ampliacion de
                                    esta
                                </h6>
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-row">
                                                <div class="col form-group">
                                                    <label for="nombres">Nombres:</label>
                                                    <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo $datos->usr_nombre ?>" readonly>
                                                </div>
                                                <div class="col form-group">
                                                    <label for="apellidos">Apellidos:</label>
                                                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $datos->usr_apellidos ?>"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="documento">Documento de identidad:</label>
                                                <input type="text" class="form-control" id="documento" name="documento" value="<?php echo $datos->pk_id_usr ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                        <img src="<?php echo $datos->foto ?>" alt="" height="188px" width="151px">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                                            <input type="date" class="form-control" id="fecha_nacimiento"
                                                name="fecha_nacimiento" value="<?php if(isset($datos->usr_fecha_nacimiento)){echo $datos->usr_fecha_nacimiento;} ?>" required>
                                        </div>
                                        <div class="col form-group">
                                            <label for="telefonos">Teléfonos:</label>
                                            <input type="text" class="form-control" id="telefonos" name="telefonos" value="<?php if(isset($datos->usr_telefono)){echo $datos->usr_telefono;} ?>"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="correo_misena">Correo electrónico Misena:</label>
                                        <input type="email" class="form-control" id="correo_misena" name="correo_misena" value="<?php if(isset($datos->usr_email)){echo $datos->usr_email;} ?>"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="libreta_militar">Libreta militar:</label>
                                        <select class="form-control" id="libreta_militar" name="libreta_militar" required>
                                            <option value="<?php if(isset($datos->usr_libreta_militar)){echo $datos->usr_libreta_militar;}?>" ><?php if(isset($datos->usr_libreta_militar)){echo $datos->usr_libreta_militar;}else{echo "Seleccione una opcion";} ?></option>
                                            <option value="SI">Sí</option>
                                            <option value="NO">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion">Direccion de domicilio:</label>
                                        <input type="text" class="form-control" id="direccion" name="direccion" value="<?php if(isset($datos->usr_direccion)){echo $datos->usr_direccion;} ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="estrato">Estrato:</label>
                                        <input type="text" class="form-control" id="estrato" name="estrato" value="<?php if(isset($datos->usr_estrato)){echo $datos->usr_estrato;} ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="ciudad">Ciudad:</label>
                                        <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?php if(isset($datos->usr_ciudad)){echo $datos->usr_ciudad;} ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseTwo">
                                    #2 FORMACION ACADEMICA
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <h6>Digite la informacion referente al titulo obtenido en el grado 11 que corresponde a
                                        la
                                        educacion media</h6>
                                        <?php
                                        $estudios = $base->query("SELECT * FROM estudio WHERE fk_id_usr=$id and numero=1")->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($estudios as $estudio) {
                                        ?>
                                    <div class="form-group">
                                        <label for="titulo_obtenido">Título obtenido:</label>
                                        <input type="text" class="form-control" id="titulo_obtenido" name="titulo_obtenido" value="<?php if(isset($estudio->tipo_estudio)){echo $estudio->tipo_estudio;} ?>"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="institucion_educativa">Institución educativa:</label>
                                        <input type="text" class="form-control" id="institucion_educativa"
                                            name="institucion_educativa" value="<?php if(isset($estudio->estudio_institucion)){echo $estudio->estudio_institucion;} ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_de_grado">Fecha de grado:</label>
                                        <input type="date" class="form-control" id="fecha_de_grado" name="fecha_de_grado" value="<?php if(isset($estudio->estudio_fecha_grado)){echo $estudio->estudio_fecha_grado;} ?>"
                                            required>
                                    </div>
                                    <?php
                                         }
                                    ?>
                                    <h6>Si usted ha realizado esudios de nivel superior como Tecnico TC, Tecnologo TL,
                                        Especializacion Tecnologica TE, Universitaria UN, Especializacion ES, Maestria MG,
                                        Doctorado DOC, relacionelos a continuacion</h6>
                                    <div class="form-group">
                                    <?php
                                        $estudios2 = $base->query("SELECT * FROM estudio WHERE fk_id_usr=$id and numero=2")->fetchAll(PDO::FETCH_OBJ);
                                        if($estudios2){
                                        foreach ($estudios2 as $estudio2) {
                                        ?>
                                        <label for="nivel">Nivel</label>
                                        <select class="form-control" id="nivel" name="nivel">
                                            <?php if(isset($estudio2->tipo_estudio)){?> <option value="<?php echo $estudio2->tipo_estudio ?>"><?php echo $estudio2->tipo_estudio ?></option> <?php }else{?>
                                            <option selected>Seleccione una opción</option>
                                            <?php } ?>
                                            <option value="Tecnico">Tecnico</option>
                                            <option value="Tecnologo">Tecnologo</option>
                                            <option value="Especializacion Tecnologica">Especializacion Tecnologica</option>
                                            <option value="Universitaria">Universitaria</option>
                                            <option value="Especializacion">Especializacion</option>
                                            <option value="Maestría">Maestría</option>
                                            <option value="Doctorado">Doctorado</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre_estudios">Nombre de los estudios</label>
                                        <input type="text" class="form-control" id="nombre_estudios" name="nombre_estudios" value="<?php if(isset($estudio2->estudio_titulo)){echo $estudio->estudio_titulo;} ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="institucion_educativa">Institución educativa</label>
                                        <input type="text" class="form-control" id="institucion_educativa2"
                                            name="institucion_educativa2" value="<?php if(isset($estudio2->estudio_institucion)){echo $estudio2->estudio_institucion;} ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=" q">Semestres aprobados</label>
                                        <input type="number" class="form-control" id="semestres_aprovados"
                                            name="semestres_aprovados" value="<?php if(isset($estudio2->estudio_semestres_aprobados)){echo $estudio2->estudio_semestres_aprobados;} ?>">
                                    </div>
                                    <?php
                                         }
                                        }
                                        else{
                                            ?>
                                            <label for="nivel">Nivel</label>
                                        <select class="form-control" id="nivel" name="nivel">
                                            <option selected>Seleccione una opción</option>
                                            <option value="Tecnico">Tecnico</option>
                                            <option value="Tecnologo">Tecnologo</option>
                                            <option value="Especializacion Tecnologica">Especializacion Tecnologica</option>
                                            <option value="Universitaria">Universitaria</option>
                                            <option value="Especializacion">Especializacion</option>
                                            <option value="Maestría">Maestría</option>
                                            <option value="Doctorado">Doctorado</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre_estudios">Nombre de los estudios</label>
                                        <input type="text" class="form-control" id="nombre_estudios" name="nombre_estudios">
                                    </div>
                                    <div class="form-group">
                                        <label for="institucion_educativa">Institución educativa</label>
                                        <input type="text" class="form-control" id="institucion_educativa2"
                                            name="institucion_educativa2">
                                    </div>
                                    <div class="form-group">
                                        <label for="semestres_aprovados">Semestres aprobados</label>
                                        <input type="number" class="form-control" id="semestres_aprovados"
                                            name="semestres_aprovados">
                                    </div>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseThree">
                                    #3 INFORMACION PROGRAMA DE FORMACION
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <h6>Informacion relevante del programa de formacion, para mas informacion podra
                                        contactar al
                                        coordinador academico</h6>
                                        <?php
                                        $idFicha=$datos->fk_id_ficha;
                                        $ficha = $base->query("SELECT * FROM fichas WHERE pk_id_ficha=$idFicha")->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($ficha as $datosFicha) {
                                            $idPrograma=$datosFicha->fk_id_pro;
                                            $programa = $base->query("SELECT * FROM programas WHERE pk_id_pro=$idPrograma")->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($programa as $datosPrograma) {
                                                $idCentro=$datosPrograma->fk_id_cefo;
                                                $centro = $base->query("SELECT * FROM centros_formacion WHERE pk_id_cefo=$idCentro")->fetchAll(PDO::FETCH_OBJ);
                                                foreach ($centro as $datosCentro) {
                                        ?>
                                    <div class="form-group">
                                        <label for="nombre_programa">Nombre del programa</label>
                                        <input type="text" class="form-control" id="nombre_programa" name="nombre_programa" value="<?php echo $datosPrograma->pro_nombre ?>"  readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="codigo_ficha">Código de ficha</label>
                                        <input type="text" class="form-control" id="codigo_ficha" name="codigo_ficha" value="<?php echo $datosPrograma->pro_nombre ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="perfil_ocupacional">Perfil ocupacional</label>
                                        <textarea class="form-control" id="perfil_ocupacional" name="perfil_ocupacional"
                                            rows="3" readonly><?php echo $datosPrograma->pro_perfil ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="ocupaciones_desempenar">Ocupaciones a desempeñar</label>
                                        <textarea class="form-control" id="ocupaciones_desempenar"
                                            name="ocupaciones_desempenar" rows="3" readonly><?php echo $datosPrograma->pro_ocupaciones ?></textarea>
                                    </div>
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label for="centro_formacion">Centro de formación</label>
                                            <input type="text" class="form-control" id="centro_formacion"
                                                name="centro_formacion" value="<?php echo $datosCentro->cefo_nom_centro_formacion ?>" readonly>
                                        </div>
                                        <div class="col form-group">
                                            <label for="ciudad_formacion">Ciudad de formación</label>
                                            <input type="text" class="form-control" id="ciudad_formacion"
                                                name="ciudad_formacion" value="<?php echo $datosCentro->cefo_nom_regional ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label for="fecha_inicio">Fecha de inicio</label>
                                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo $datosFicha->ficha_fecha_inicio ?>" readonly>
                                        </div>
                                        <div class="col form-group">
                                            <label for="fecha_terminacion">Fecha de terminacion</label>
                                            <input type="date" class="form-control" id="fecha_terminacion"
                                                name="fecha_terminacion" value="<?php echo $datosFicha->ficha_fecha_terminacion ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="etapa">Etapa</label>
                                        <input type="text" class="form-control" id="etapa"
                                                name="etapa" value="<?php echo $datosFicha->ficha_etapa ?>" readonly>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="coordinador_academico">Coordinador académico</label>
                                            <input type="text" class="form-control" id="coordinador_academico"
                                                name="coordinador_academico" value="<?php echo $datosCentro->cefo_nom_coordinador ?>" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="telefono_contacto">Teléfono de contacto</label>
                                            <input type="text" class="form-control" id="telefono_contacto"
                                                name="telefono_contacto" value="<?php echo $datosCentro->cefo_telefono ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="correo_electronico">Correo electrónico</label>
                                        <input type="email" class="form-control" id="correo_electronico"
                                            name="correo_electronico" value="<?php echo $datosCentro->cefo_email ?>" readonly>
                                    </div>
                                    <?php
                                                }
                                      }
                                    }
                                        ?>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseFour">
                                    #4 FIRMA DEL APRENDIZ
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="form-group">
                                        <label>Manifiesto</label>
                                        <div class="border p-3">
                                            <p class="m-0">MANIFIESTO BAJO LA GRAVEDAD DEL JURAMENTO QUE NO ME ENCUENTRO
                                                DENTRO
                                                DE LAS CAUSALES DE INHABILIDAD E INCOMPATIBILIDAD QUE CONTRAVENGAN EL
                                                REGLAMENTO
                                                ESTUDIANTIL O TERMINOS LEGALES, PARA DESARROLLAR LA ETAPA PRACTICA
                                                DESEMPEÑANDOME EN UNA EMPRESA A TRAVES DEL CONTRATO DE APRENDIZAJE, PARA
                                                TODOS
                                                LOS EFECTOS LEGALES, CERTIFICO QUE LOS DATOS POR MI ANOTADOS EN EL PRESENTE
                                                FORMATO DE LA HOJA DE VIDA, SON VERACES.</p>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                    </div>
                                    <div class="form-group">
                                        <label for="firma">Firma:</label>
                                        <input type="file" class="form-control-file" id="firma" name="firma">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseFive">
                                    #5 FIRMA FUNCIONARIO PROMOCION Y RELACIONAMIENTO CORPORATIVO SENA
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <h6>Informacion del funcionario encargado en el centro de formacion. Contacte para la
                                        legalizacion del contrato de aprendizaje</h6>
                                    <div class="form-group">
                                        <label for="nombre">Nombre Funcionario:</label>
                                        <input type="text" class="form-control" id="nombreFuncionario"
                                            placeholder="Ingrese el nombre del funcionario" name="nombreFuncionario">
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">Teléfono:</label>
                                        <input type="text" class="form-control" id="telefonoFuncionario"
                                            placeholder="Ingrese el número de teléfono" name="telefonoFuncionario">
                                    </div>
                                    <div class="form-group">
                                        <label for="correo">Correo Electrónico:</label>
                                        <input type="email" class="form-control" id="correoFuncionario"
                                            placeholder="Ingrese el correo electrónico" name="correoFuncionario">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseSix">
                                    #6 INFORMACION SERVICIO NACIONAL DE APRENDIZAJE
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="form-group">
                                        <label for="nit">NIT:</label>
                                        <input type="text" class="form-control" id="nitCentro"
                                            placeholder="Ingrese el NIT del centro de formación" name="nitCentro">
                                    </div>
                                    <div class="form-group">
                                        <label for="centro">Centro de Formación:</label>
                                        <input type="text" class="form-control" id="centroFormacion"
                                            placeholder="Ingrese el nombre del centro de formación" name="centroFormacion">
                                    </div>
                                    <div class="form-group">
                                        <label for="representante">Representante Legal:</label>
                                        <input type="text" class="form-control" id="representante"
                                            placeholder="Ingrese el nombre del representante legal" name="representante">
                                    </div>
                                    <div class="form-group">
                                        <label for="correo">Correo Electrónico:</label>
                                        <input type="email" class="form-control" id="correoCentro"
                                            placeholder="Ingrese el correo electrónico" name="correoCentro">
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">Teléfono:</label>
                                        <input type="text" class="form-control" id="telefonoCentro"
                                            placeholder="Ingrese el número de teléfono" name="telefonoCentro">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseSeven" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseSeven">
                                    #7 OBSERVACIONES JEFE DE RECURSOS HUMANOS Y/O CONTRATOS
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse show">
                            <?php
                            $usuario = $_SESSION['usuario'];
                            $Empresa = $base->query("SELECT * FROM empresaaprendiz WHERE fk_id_empresa=$usuario;")->fetchAll(PDO::FETCH_OBJ);
                            foreach ($Empresa as $datosEmpresa) {
                                ?>
                                <div class="accordion-body">
                                    <div class="form-group">
                                    <input type="text" class="form-control" id="idAprendiz" name="idAprendiz" value="<?php echo $id ?>" hidden>
                                    <input type="text" class="form-control" id="idEmpresa" name="idEmpresa" value="<?php echo $idEmpresa ?>" hidden>   
                                    <label for="nombre">Nombre de Funcionario:</label>
                                        <input type="text" class="form-control" id="nombreRecursos"
                                        value="<?php echo $datosEmpresa->nom_funcionario ?>" name="nombreRecursos">
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">Teléfono:</label>
                                        <input type="text" class="form-control" id="telefonoRecursos"
                                        value="<?php echo $datosEmpresa->telefono ?>" name="telefonoRecursos">
                                    </div>
                                    <div class="form-group">
                                        <label for="correo">Correo Electrónico:</label>
                                        <input type="email" class="form-control" id="correoRecursos"
                                        value="<?php echo $datosEmpresa->correo ?>" name="correoRecursos">
                                    </div>
                                    <div class="form-group">
                                        <label for="observaciones">Observaciones:</label>
                                        <textarea class="form-control" id="observacionesRecursos"
                                        name="observacionesRecursos"><?php echo $datosEmpresa->observaciones ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="contratar">¿Contratar al Aprendiz?</label><br>
                                        <input onclick="cambiarCheck(1)" type="checkbox" id="contratar" name="contratar" value="si">
                                        <label for="contratar">Seleccionado</label>
                                        <input onclick="cambiarCheck(2)" type="checkbox" id="NoContratar" name="NoContratar" value="no">
                                        <label for="contratar">No Seleccionado</label>
                                        <input  type="checkbox" id="contrata" name="contrata" value="" hidden>
                                    </div>
                                    <div class="form-group">
                                        <label for="ciudad">Ciudad de Diligenciamiento:</label>
                                        <input type="text" class="form-control" id="ciudadDilegenciamiento"
                                        value="<?php echo $datosEmpresa->ciudad_diligenciamiento ?>" name="ciudadDilegenciamiento">
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha">Fecha de Diligenciamiento:</label>
                                        <input type="date" class="form-control" id="fechaDiligenciamiento" name="fechaDiligenciamiento" value="<?php echo $datosEmpresa->fecha_diligenciamiento ?>">
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="firma">Firma:</label>
                                        <input type="file" class="form-control-file" id="firmaResursos" name="firmaResursos">
                                    </div> -->
                                </div>
                                <?php
                            }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <button class="btn btn-success me-md-2" type="submit">GUARDAR</button>
                        <a href="javascript:history.back(-1);"><button class="btn btn-danger me-md-2" type="button">CANCELAR</button></a>
                    </div>
                </form>
                <?php
        }
        ?>
        </div>
    </div>
    <?php
    require_once("footer.php");
    ?>
</body>
<script>
    // PERMISOS PARA EL APRENDIZ
    if(<?php echo $tipo ?>==1){
        $('#nombreFuncionario').prop("disabled",true);
        $('#telefonoFuncionario').prop("disabled",true);
        $('#correoFuncionario').prop("disabled",true);
        $('#nitCentro').prop("disabled",true);
        $('#centroFormacion').prop("disabled",true);
        $('#representante').prop("disabled",true);
        $('#correoCentro').prop("disabled",true);
        $('#telefonoCentro').prop("disabled",true);
        $('#nombreRecursos').prop("disabled",true);
        $('#telefonoRecursos').prop("disabled",true);
        $('#correoRecursos').prop("disabled",true);
        $('#observacionesRecursos').prop("disabled",true);
        $('#ciudadDilegenciamiento').prop("disabled",true);
        $('#fechaDiligenciamiento').prop("disabled",true);
        $('#firmaResursos').prop("disabled",true);
        $('#contratar').prop("disabled",true);
        $('#NoContratar').prop("disabled",true);   
    }
    // PERMISOS PARA EL FUNCIONARIO
    else if(<?php echo $tipo ?>==2){
        $('#nombreFuncionario').prop("required",true);
        $('#telefonoFuncionario').prop("required",true);
        $('#correoFuncionario').prop("required",true);
        $('#nitCentro').prop("required",true);
        $('#centroFormacion').prop("required",true);
        $('#representante').prop("required",true);
        $('#correoCentro').prop("required",true);
        $('#telefonoCentro').prop("required",true);
    }
    // PERMISOS PARA LA EMPRESA
    else if(<?php echo $tipo ?>==3){
        //DATOS QUE LA EMPRESA PUEDE VER
        $('#fecha_nacimiento').prop("disabled",true);
        $('#telefonos').prop("disabled",true);
        $('#correo_misena').prop("disabled",true);
        $('#libreta_militar').prop("disabled",true);
        $('#direccion').prop("disabled",true);
        $('#estrato').prop("disabled",true);
        $('#ciudad').prop("disabled",true);
        $('#titulo_obtenido').prop("disabled",true);
        $('#institucion_educativa').prop("disabled",true);
        $('#fecha_de_grado').prop("disabled",true);
        $('#nivel').prop("disabled",true);
        $('#nombre_estudios').prop("disabled",true);
        $('#institucion_educativa2').prop("disabled",true);
        $('#semestres_aprovados').prop("disabled",true);
        $('#firma').prop("disabled",true);
        
        $('#nombreFuncionario').prop("disabled",true);
        $('#telefonoFuncionario').prop("disabled",true);
        $('#correoFuncionario').prop("disabled",true);
        $('#nitCentro').prop("disabled",true);
        $('#centroFormacion').prop("disabled",true);
        $('#representante').prop("disabled",true);
        $('#correoCentro').prop("disabled",true);
        $('#telefonoCentro').prop("disabled",true);
        //DATOS QUE LA EMPRESA MANEJA   
        $('#nombreRecursos').prop("required",true);
        $('#telefonoRecursos').prop("required",true);
        $('#correoRecursos').prop("required",true);
        $('#observacionesRecursos').prop("required",true);
        $('#ciudadDilegenciamiento').prop("required",true);
        $('#fechaDiligenciamiento').prop("required",true);
        $('#firmaResursos').prop("required",true);
        // $('#contratar').prop("required",true);
        // $('#NoContratar').prop("required",true); 

}
function cambiarCheck($i){
    if($i==1){
        $('#NoContratar').prop("checked",false); 
    }
    else if($i==2){
        $('#contratar').prop("checked",false);
    }   
}
</script>
</html>