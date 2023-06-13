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
            <div>
                <div class="p-1">
                    <div class="text-center">
                        <h2>INSTRUCTORES</h2>
                    </div>
                    <!-- TABLA PARA VER LOS DATOS DE LOS INSTRUCTORES -->
                    <div class="overflow-x-scroll">
                        <table id="tablaInstructor" class="table table-bordered table-striped table-hover">
                            <thead class="table-success">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Documento</th>
                                    <th scope="col">Nombres</th>
                                    <th scope="col">Apellidos</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Telefono</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $i = 1;
                                $usuario = $base->query("SELECT * FROM usuarios WHERE fk_id_tipo_usr=4")->fetchAll(PDO::FETCH_OBJ);
                                foreach ($usuario as $usuarios) {
                                    ?>

                                    <tr>
                                        <td scope="row">
                                            <?php echo $i; ?>
                                        </td>
                                        <td>
                                            <?php echo $usuarios->pk_id_usr; ?>
                                        </td>
                                        <td>
                                            <?php echo $usuarios->usr_nombre; ?>
                                        </td>
                                        <td>
                                            <?php echo $usuarios->usr_apellidos; ?>
                                        </td>
                                        <td>
                                            <?php echo $usuarios->usr_email; ?>
                                        </td>
                                        <td>
                                            <?php echo $usuarios->usr_telefono; ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-warning btn-sm"
                                                href="editarUsuario.php?id=<?php echo $usuarios->pk_id_usr; ?>">
                                                <i class="bi bi-pencil-square"></i>EDITAR</a>
                                            <a onclick="return confirm('Estas seguro de eliminar?');"
                                                class="btn btn-danger btn-sm"
                                                href="../controller/eliminarUsuario.php?id=<?php echo $usuarios->pk_id_usr; ?>"><i
                                                    class="bi bi-trash-fill">ELIMINAR</i></a>
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
            </div>
            <a href="javascript:history.back(-1);"><button class="btn btn-danger me-md-2"
                    type="button">VOLVER</button></a>
        </div>
    </div>
    <?php
    require_once("footer.php");
    ?>
</body>
<script>
    $(document).ready(function () {
        $('#tablaInstructor').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });
    });
</script>

</html>