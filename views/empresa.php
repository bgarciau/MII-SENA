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
    $usuario = $_SESSION['usuario'];
    // ACTUALIZA LOS DATOS BASICOS DEL USUARIO
    if (isset($_POST['guardarCambios'])) {
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        try {
            $query = "UPDATE usuarios SET usr_email=?, usr_telefono=? WHERE pk_id_usr=$usuario;";
            $sentencia = $base->prepare($query);
            $resultado = $sentencia->execute([$correo, $telefono]);
        } catch (Exception $e) {
            echo $e;
        }
    }
    ?>
    <div style="min-height: 85vh;">
        <div class="container font-weight-bold mt-4">
            <div class="row">
                <div class="col-md-4 mx-auto">
                    <!-- MUESTRA LOS DATOS BASICOS DE LA EMPRESA -->
                    <h2 class="text-center mb-4">DATOS DE EMPRESA</h2>
                    <?php
                    $usuario = $base->query("SELECT * FROM usuarios WHERE pk_id_usr=$usuario")->fetchAll(PDO::FETCH_OBJ);
                    foreach ($usuario as $datos) {
                        ?>
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                value="<?php echo $datos->usr_nombre ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nit">NIT:</label>
                            <input type="number" class="form-control" id="nit" name="nit"
                                value="<?php echo $datos->pk_id_usr ?>" readonly>
                        </div>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="form-group">
                                <label for="correo">Correo electrónico:</label>
                                <input type="email" class="form-control" id="correo" name="correo"
                                    value="<?php echo $datos->usr_email ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono:</label>
                                <input type="numberber" class="form-control" id="telefono" name="telefono"
                                    value="<?php echo $datos->usr_telefono ?>" required>
                            </div>
                            <input type="submit" class="btn btn-success btn-block mt-2" name="guardarCambios"
                                value="GUARDAR CAMBIOS">
                        </form>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-md-8 mx-auto">
                    <!-- FILTROS PARA LA BUSQUEDA DE APRENDICES -->
                    <h4>FILTROS</h4>
                    <label class="form-label">Programa: </label>
                    <select class="form-select" aria-label="Default" id="programa" autofocus required>
                        <option value="todos">Todos</option>
                        <?php
                        $programa = $base->query("SELECT * FROM programas")->fetchAll(PDO::FETCH_OBJ);
                        foreach ($programa as $programas) {
                            ?>
                            <option value="<?php echo $programas->pk_id_pro ?>"><?php echo $programas->pro_nombre ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                    <label class="form-label">Etapa: </label>
                    <select class="form-select" name="etapa" id="etapa">
                        <option value="PRACTICA">PRACTICA</option>
                        <option value="LECTIVA">LECTIVA</option>    
                    </select>
                    <br>
                    <button onclick="buscarAprendices()" type="button" class="btn btn-success btn-block">BUSCAR
                        APRENDICES</button>
                    <br><br>
                    <h3>APRENDICES SELECCIONADOS</h3>
                    <div class="overflow-x-scroll">
                    <table id="tablaAprendicesE" class="table table-bordered table-striped table-hover">
                        <thead class="table-success">
                            <tr>
                                <th>#</th>
                                <th>Aprendiz</th>
                                <th>Correo</th>
                                <th>Telefono</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $usuario = $_SESSION['usuario'];
                            $idAprendices = $base->query("SELECT * FROM empresaaprendiz WHERE fk_id_empresa=$usuario and contratar='si'")->fetchAll(PDO::FETCH_OBJ);
                            foreach ($idAprendices as $idAprendiz) {
                                $DatosAprendiz = $base->query("SELECT * FROM usuarios WHERE pk_id_usr=$idAprendiz->fk_id_aprendiz;")->fetchAll(PDO::FETCH_OBJ);
                                foreach ($DatosAprendiz as $DatosA) {

                                ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $DatosA->usr_nombre," ",$DatosA->usr_apellidos ?></td>
                                    <td><?php echo $DatosA->usr_email ?></td>
                                    <td><?php echo $DatosA->usr_telefono ?></td>
                                    <td>
                                        <a class="btn btn-info btn-sm"
                                                href="hojaVida.php?id=<?php echo $DatosA->pk_id_usr; ?>">
                                                <i class="bi bi-file-earmark-text-fill">VER</i></a>
                                                <a onclick="return confirm('Estas seguro de eliminar?');" class="btn btn-danger btn-sm"
                                            href="../controller/eliminarEA.php?id=<?php echo $DatosA->pk_id_usr; ?>"><i class="bi bi-trash-fill">ELIMINAR</i></a>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once("footer.php");
    ?>
</body>
<script>
    //BOTON PARA ENVIAR A LA EMPRESA A BUSCAR APRENDICES CON LOS FILTROS APLICADOS
    function buscarAprendices() {
        idPrograma = $('#programa').val()
        etapa = $('#etapa').val()
        location.href = "buscarAprendices.php?programa=" + idPrograma+"&etapa="+etapa;
    }
</script>

</html>