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
    if (isset($_GET['codigo']) && $_GET['codigo'] != "") {
        $codigo = $_GET['codigo'];
        $tipo = $_GET['tipo'];
    }
    ?>
    <div style="min-height: 85vh;">
        <div class="container mt-4">
            <!-- SEGUN LA SELECCION DEL USUARIO EN FORMACION SE MUESTRA UN FORMULARIO PARA EDITAR -->
            <!-- EDITAR FICHA -->
            <div class="card" id="editarFicha" hidden>
                <div class="card-header">
                    EDITAR FICHA:
                </div>
                <?php
                $fichas = $base->query("SELECT * FROM fichas WHERE pk_id_ficha=$codigo")->fetchAll(PDO::FETCH_OBJ);
                $i = 1;
                foreach ($fichas as $datosFicha) {
                    ?>
                    <form class="p-4" method="POST" action="../controller/crudFormacion.php?accion=editar&tipo=ficha">
                        <div class="mb-3">
                            <label class="form-label">ID: </label>
                            <input type="number" class="form-control" name="idFicha"
                                value="<?php echo $datosFicha->pk_id_ficha; ?>" autofocus required readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha Inicio: </label>
                            <input type="date" class="form-control" name="inicioFicha"
                                value="<?php echo $datosFicha->ficha_fecha_inicio; ?>" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha Terminacion: </label>
                            <input type="date" class="form-control" name="terminacionFicha"
                                value="<?php echo $datosFicha->ficha_fecha_terminacion; ?>" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Etapa: </label>
                            <select class="form-select" aria-label="Default" name="etapaFicha" autofocus required>
                                <option selected>
                                    <?php echo $datosFicha->ficha_etapa; ?>
                                </option>
                                <option value="LECTIVA">LECTIVA</option>
                                <option value="PRACTICA">PRACTICA</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Programa: </label>
                            <select class="form-select" aria-label="Default" name="programaFicha" autofocus required
                                disabled>
                                <?php
                                $programas = $base->query("SELECT * FROM programas")->fetchAll(PDO::FETCH_OBJ);
                                $programa = $base->query("SELECT * FROM programas WHERE pk_id_pro=$datosFicha->fk_id_pro")->fetchAll(PDO::FETCH_OBJ);
                                foreach ($programa as $datosPrograma) {
                                    ?>
                                    <option selected>
                                        <?php echo $datosPrograma->pro_nombre ?>
                                    </option>
                                    <?php
                                }
                                foreach ($programas as $datosPrograma) {
                                    ?>
                                    <option value="<?php echo $datosPrograma->pk_id_pro ?>"><?php echo $datosPrograma->pro_nombre ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-center">
                                <input type="submit" class="btn btn-success btn-block" value="ACTUALIZAR">
                            </div>
                            <div class="col d-flex justify-content-center">

                                <a class="btn btn-danger btn-block" href="javascript:history.back(-1);">
                                <input type="button" class="btn btn-danger btn-block" id="btnCerrarFicha" value="CANCELAR">
                                </a>
                            </div>
                        </div>
                    </form>
                    <?php
                }
                ?>
            </div>
            <!-- EDITAR PROGRAMA -->
            <div class="card" id="editarPrograma" hidden>
                <div class="card-header">
                    INGRESAR PROGRAMA:
                </div>
                <?php
                $programas = $base->query("SELECT * FROM programas WHERE pk_id_pro=$codigo")->fetchAll(PDO::FETCH_OBJ);
                $i = 1;
                foreach ($programas as $datosPrograma) {
                    ?>
                    <form class="p-4" method="POST" action="../controller/crudFormacion.php?accion=editar&tipo=programa">
                        <div class="mb-3">
                            <label class="form-label">ID: </label>
                            <input type="number" class="form-control" name="idPrograma"
                                value="<?php echo $datosPrograma->pk_id_pro ?>" autofocus required readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nombre: </label>
                            <input type="text" class="form-control" name="nombrePrograma"
                                value="<?php echo $datosPrograma->pro_nombre ?>" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Perfil: </label>
                            <input type="text" class="form-control" name="perfilPrograma"
                                value="<?php echo $datosPrograma->pro_perfil ?>" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ocupaciones: </label>
                            <input type="text" class="form-control" name="ocupacionesPrograma"
                                value="<?php echo $datosPrograma->pro_ocupaciones ?>" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Centro: </label>
                            <input type="text" class="form-control" name="centroPrograma"
                                value="<?php echo $datosPrograma->fk_id_cefo ?>" autofocus required disabled>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-center">
                                <input type="submit" class="btn btn-success btn-block" value="ACTUALIZAR">
                            </div>
                            <div class="col d-flex justify-content-center">
                                <a class="btn btn-danger btn-block" href="javascript:history.back(-1);">
                                <input type="button" class="btn btn-danger btn-block" id="btnCerrarPrograma"
                                    value="CANCELAR">
                                </a>
                            </div>
                        </div>
                    </form>
                    <?php
                }
                ?>
            </div>
            <!-- EDITAR CENTRO DE FORMACION -->
            <div class="card" id="editarCentro" hidden>
                <div class="card-header">
                    EDITAR CENTRO:
                </div>
                <?php
                $centros = $base->query("SELECT * FROM centros_formacion WHERE pk_id_cefo=$codigo")->fetchAll(PDO::FETCH_OBJ);
                foreach ($centros as $datosCentro) {
                    ?>
                    <form class="p-4" method="POST" action="../controller/crudFormacion.php?accion=editar&tipo=centro">
                        <div class="mb-3">
                            <label class="form-label">ID: </label>
                            <input type="number" class="form-control" name="idCentro" value="<?php echo $datosCentro->pk_id_cefo; ?>" autofocus required readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nombre: </label>
                            <input type="text" class="form-control" name="nombreCentro" value="<?php echo $datosCentro->cefo_nom_centro_formacion; ?>" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Regional: </label>
                            <input type="text" class="form-control" name="regionalCentro" value="<?php echo $datosCentro->cefo_nom_regional; ?>" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Director: </label>
                            <input type="text" class="form-control" name="directorCentro" value="<?php echo $datosCentro->cefo_nom_director_regional; ?>" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subdirector: </label>
                            <input type="text" class="form-control" name="subdirectorCentro" value="<?php echo $datosCentro->cefo_nom_sub_director; ?>" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Coordinador: </label>
                            <input type="text" class="form-control" name="coordinadorCentro" value="<?php echo $datosCentro->cefo_nom_coordinador; ?>" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telefono: </label>
                            <input type="text" class="form-control" name="telefonoCentro" value="<?php echo $datosCentro->cefo_telefono; ?>" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email: </label>
                            <input type="text" class="form-control" name="emailCentro" value="<?php echo $datosCentro->cefo_email; ?>" autofocus required>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-center">
                                <input type="submit" class="btn btn-success btn-block" value="ACTUALIZAR">
                            </div>
                            <div class="col d-flex justify-content-center">
                                <a class="btn btn-danger btn-block" href="javascript:history.back(-1);">
                                <input type="button" class="btn btn-danger btn-block" id="btnCerrarCentro" value="CANCELAR">
                                </a>
                            </div>
                        </div>
                    </form>
                    <?php
                }
                ?>
            </div>
            <br><br>
        </div>
    </div>
    <?php
    require_once("footer.php");
    ?>
</body>
<script>
    $(document).ready(function () {
        if ('<?php echo $tipo ?>' == "ficha") {
            $('#editarFicha').prop("hidden", false);
        }
        else if ('<?php echo $tipo ?>' == "programa") {
            $('#editarPrograma').prop("hidden", false);
        }
        else if ('<?php echo $tipo ?>' == "centro") {
            $('#editarCentro').prop("hidden", false);
        }

    });
</script>

</html>