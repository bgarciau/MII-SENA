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
    ?>
    <div style="min-height: 85vh;">
        <div class="container">
            <!-- FILA PARA LA FICHA -->
            <div>
                <div class="p-1">
                    <div class="text-center">
                        <h2>FICHA</h2>
                        <button type="submit" class="btn btn-success mb-3" id="btnAgregarFicha"><i
                                class="bi bi-plus-square-dotted"></i></button>
                    </div>
                    <table id="tablaFicha" class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">Fecha Inicio</th>
                                <th scope="col">Fecha Terminacion</th>
                                <th scope="col">Etapa</th>
                                <th scope="col">Programa</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $fichas = $base->query("SELECT * FROM fichas")->fetchAll(PDO::FETCH_OBJ);
                            $i = 1;
                            foreach ($fichas as $datosFicha) {
                                ?>

                                <tr>
                                    <td scope="row">
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php echo $datosFicha->pk_id_ficha; ?>
                                    </td>
                                    <td>
                                        <?php echo $datosFicha->ficha_fecha_inicio; ?>
                                    </td>
                                    <td>
                                        <?php echo $datosFicha->ficha_fecha_terminacion; ?>
                                    </td>
                                    <td>
                                        <?php echo $datosFicha->ficha_etapa; ?>
                                    </td>
                                    <td>
                                        <?php echo $datosFicha->fk_id_pro; ?>
                                    </td>
                                    <td>
                                        <a class="text-warning"
                                            href="editarFormacion.php?codigo=<?php echo $datosFicha->pk_id_ficha; ?>&tipo=ficha"><i
                                                class="bi bi-pencil-square">EDITAR</i></a>
                                        <a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger"
                                            href="../controller/crudFormacion.php?id=<?php echo $datosFicha->pk_id_ficha; ?>&accion=eliminar&tipo=ficha"><i
                                                class="bi bi-trash-fill">BORRAR</i></a>
                                    </td>
                                </tr>

                                <?php
                                $i++;
                            }
                            ?>

                        </tbody>
                    </table>

                </div>
            </div>
            <!-- DIALOG PARA AGREGAR FICHA -->
            <dialog id="dialogAgregarFicha" style="width: 50%;">
                <div class="card">
                    <div class="card-header">
                        INGRESAR FICHA:
                    </div>
                    <form class="p-4" method="POST" action="../controller/crudFormacion.php?accion=agregar&tipo=ficha">
                        <div class="mb-3">
                            <label class="form-label">ID: </label>
                            <input type="number" class="form-control" name="idFicha" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha Inicio: </label>
                            <input type="date" class="form-control" name="inicioFicha" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha Terminacion: </label>
                            <input type="date" class="form-control" name="terminacionFicha" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Etapa: </label>
                            <select class="form-select" aria-label="Default" name="etapaFicha" autofocus required>
                                <option selected>Seleccione una opcion</option>
                                <option value="LECTIVA">LECTIVA</option>
                                <option value="PRACTICA">PRACTICA</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Programa: </label>
                            <select class="form-select" aria-label="Default" name="programaFicha" autofocus required>
                                <option selected>Seleccione una opcion</option>
                                <?php
                                $programas = $base->query("SELECT * FROM programas")->fetchAll(PDO::FETCH_OBJ);
                                $i = 1;
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
                                <input type="submit" class="btn btn-success btn-block" value="AGREGAR">
                            </div>
                            <div class="col d-flex justify-content-center">
                                <input type="button" class="btn btn-danger btn-block" id="btnCerrarFicha"
                                    value="CANCELAR">
                            </div>
                        </div>
                    </form>
                </div>
            </dialog>
            <!-- FILA PARA EL PROGRAMA -->
            <div>
                <div class="p-4">
                    <div class="text-center">
                        <h2>PROGRAMA FORMACION</h2>
                        <button type="submit" class="btn btn-success mb-3" id="btnAgregarPrograma"><i
                                class="bi bi-plus-square-dotted"></i></button>
                    </div>
                    <table id="tablaPrograma" class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Perfil</th>
                                <th scope="col">Ocupaciones</th>
                                <th scope="col">Centro</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $programas = $base->query("SELECT * FROM programas")->fetchAll(PDO::FETCH_OBJ);
                            $i = 1;
                            foreach ($programas as $datosPrograma) {
                                ?>

                                <tr>
                                    <td scope="row">
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php echo $datosPrograma->pk_id_pro; ?>
                                    </td>
                                    <td>
                                        <?php echo $datosPrograma->pro_nombre; ?>
                                    </td>
                                    <td>
                                        <?php echo $datosPrograma->pro_perfil; ?>
                                    </td>
                                    <td>
                                        <?php echo $datosPrograma->pro_ocupaciones; ?>
                                    </td>
                                    <td>
                                        <?php echo $datosPrograma->fk_id_cefo; ?>
                                    </td>
                                    <td><a class="text-warning"
                                            href="editarFormacion.php?codigo=<?php echo $datosPrograma->pk_id_pro; ?>&tipo=programa"><i
                                                class="bi bi-pencil-square">EDITAR</i></a>
                                        <a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger"
                                            href="../controller/crudFormacion.php?id=<?php echo $datosPrograma->pk_id_pro; ?>&accion=eliminar&tipo=programa"><i
                                                class="bi bi-trash-fill">BORRAR</i></a>
                                    </td>
                                </tr>

                                <?php
                                $i++;
                            }
                            ?>

                        </tbody>
                    </table>

                </div>
            </div>
            <!-- DIALOG PARA AGREGAR PROGRAMA -->
            <dialog id="dialogAgregarPrograma" style="width: 50%;">
                <div class="card">
                    <div class="card-header">
                        INGRESAR PROGRAMA:
                    </div>
                    <form class="p-4" method="POST"
                        action="../controller/crudFormacion.php?accion=agregar&tipo=programa">
                        <div class="mb-3">
                            <label class="form-label">ID: </label>
                            <input type="number" class="form-control" name="idPrograma" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nombre: </label>
                            <input type="text" class="form-control" name="nombrePrograma" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Perfil: </label>
                            <input type="text" class="form-control" name="perfilPrograma" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ocupaciones: </label>
                            <input type="text" class="form-control" name="ocupacionesPrograma" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Centro: </label>
                            <select class="form-select" aria-label="Default" name="centroPrograma" autofocus required>
                                <option selected>Seleccione una opcion</option>
                            <?php
                            $centros = $base->query("SELECT * FROM centros_formacion")->fetchAll(PDO::FETCH_OBJ);
                            $i = 1;
                            foreach ($centros as $datosCentro) {
                                ?>
                                    <option value="<?php echo $datosCentro->pk_id_cefo; ?>"> <?php echo $datosCentro->cefo_nom_centro_formacion; ?></option>
                                <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-center">
                                <input type="submit" class="btn btn-success btn-block" value="AGREGAR">
                            </div>
                            <div class="col d-flex justify-content-center">
                                <input type="button" class="btn btn-danger btn-block" id="btnCerrarPrograma"
                                    value="CANCELAR">
                            </div>
                        </div>
                    </form>
                </div>
            </dialog>
            <!--FILA PARA CENTRO DE FORMACION  -->
            <div class="">
                <div class="p-4">
                    <div class="text-center">
                        <h2>CENTRO FORMACION</h2>
                        <button type="submit" class="btn btn-success mb-3" id="btnAgregarCentro"><i
                                class="bi bi-plus-square-dotted"></i></button>
                    </div>
                    <table id="tablaCentro" class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Regional</th>
                                <th scope="col">Director</th>
                                <th scope="col">Subdirector</th>
                                <th scope="col">Coordinador</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Email</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $centros = $base->query("SELECT * FROM centros_formacion")->fetchAll(PDO::FETCH_OBJ);
                            $i = 1;
                            foreach ($centros as $datosCentro) {
                                ?>

                                <tr>
                                    <td scope="row">
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php echo $datosCentro->pk_id_cefo; ?>
                                    </td>
                                    <td>
                                        <?php echo $datosCentro->cefo_nom_centro_formacion; ?>
                                    </td>
                                    <td>
                                        <?php echo $datosCentro->cefo_nom_regional; ?>
                                    </td>
                                    <td>
                                        <?php echo $datosCentro->cefo_nom_director_regional; ?>
                                    </td>
                                    <td>
                                        <?php echo $datosCentro->cefo_nom_sub_director; ?>
                                    </td>
                                    <td>
                                        <?php echo $datosCentro->cefo_nom_coordinador; ?>
                                    </td>
                                    <td>
                                        <?php echo $datosCentro->cefo_telefono; ?>
                                    </td>
                                    <td>
                                        <?php echo $datosCentro->cefo_email; ?>
                                    </td>
                                    <td><a class="text-warning"
                                            href="editarFormacion.php?codigo=<?php echo $datosCentro->pk_id_cefo; ?>&tipo=centro"><i
                                                class="bi bi-pencil-square">EDITAR</i></a>
                                            <br>
                                        <a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger"
                                            href="../controller/crudFormacion.php?id=<?php echo $datosCentro->pk_id_cefo; ?>&accion=eliminar&tipo=centro"><i
                                                class="bi bi-trash-fill">BORRAR</i></a>
                                    </td>
                                </tr>

                                <?php
                                $i++;
                            }
                            ?>

                        </tbody>
                    </table>

                </div>
            </div>
            <!-- DIALOG PARA AGREGAR CENTRO DE FORMACION -->
            <dialog id="dialogAgregarCentro" style="width: 50%;">
                <div class="card">
                    <div class="card-header">
                        INGRESAR CENTRO:
                    </div>
                    <form class="p-4" method="POST" action="../controller/crudFormacion.php?accion=agregar&tipo=centro">
                        <div class="mb-3">
                            <label class="form-label">ID: </label>
                            <input type="number" class="form-control" name="idCentro" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nombre: </label>
                            <input type="text" class="form-control" name="nombreCentro" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Regional: </label>
                            <input type="text" class="form-control" name="regionalCentro" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Director: </label>
                            <input type="text" class="form-control" name="directorCentro" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subdirector: </label>
                            <input type="text" class="form-control" name="subdirectorCentro" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Coordinador: </label>
                            <input type="text" class="form-control" name="coordinadorCentro" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telefono: </label>
                            <input type="text" class="form-control" name="telefonoCentro" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email: </label>
                            <input type="text" class="form-control" name="emailCentro" autofocus required>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-center">
                                <input type="submit" class="btn btn-success btn-block" value="AGREGAR">
                            </div>
                            <div class="col d-flex justify-content-center">
                                <input type="button" class="btn btn-danger btn-block" id="btnCerrarCentro"
                                    value="CANCELAR">
                            </div>
                        </div>
                    </form>
                </div>
            </dialog>
            <br><br>
        </div>
    </div>
    <?php
    require_once("footer.php");
    ?>
</body>
<script>
    $(document).ready(function () {
        // APLIKCA EL ESTILO DE LA LIBRERIA DATATABLE 
        $('#tablaFicha').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
  });
        $('#tablaPrograma').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
  });
        $('#tablaCentro').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
  });

        // TOMAMOS LOS BOTONES Y LOS DIALOGS PARA AGREGAR FICHAS, PROGRAMAS Y CENTROS
        const btnAgregarFicha = document.getElementById('btnAgregarFicha');
        const btnAgregarPrograma = document.getElementById('btnAgregarPrograma');
        const btnAgregarCentro = document.getElementById('btnAgregarCentro');
        const btnCerrarFicha = document.getElementById('btnCerrarFicha');
        const btnCerrarPrograma = document.getElementById('btnCerrarPrograma');
        const btnCerrarCentro = document.getElementById('btnCerrarCentro');
        const dialogAgregarFicha = document.getElementById('dialogAgregarFicha');
        const dialogAgregarPrograma = document.getElementById('dialogAgregarPrograma');
        const dialogAgregarCentro = document.getElementById('dialogAgregarCentro');

        // AÑADIMOS EVENTOS A LOS BOTONES PARA QUE CUANDO SEAN CLICKEADOS ABRAN O CIERREN EL DIALOG
        btnAgregarFicha.addEventListener('click', () => {
            dialogAgregarFicha.showModal();
        });

        btnAgregarPrograma.addEventListener('click', () => {
            dialogAgregarPrograma.showModal();
        });

        btnAgregarCentro.addEventListener('click', () => {
            dialogAgregarCentro.showModal();
        });
        btnCerrarFicha.addEventListener('click', () => {
            dialogAgregarFicha.close();
        });

        btnCerrarPrograma.addEventListener('click', () => {
            dialogAgregarPrograma.close();
        });

        btnCerrarCentro.addEventListener('click', () => {
            dialogAgregarCentro.close();
        });
    });
</script>

</html>