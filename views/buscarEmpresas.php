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
                        <h2>EMPRESAS</h2>
                    </div>
                    <!-- TABLA PARA VER LOS DATOS DE LAS EMPRESAS  -->
                    <table id="tablaEmpresas" class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">NIT</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Telefono</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                $i=1;
                                $usuario = $base->query("SELECT * FROM usuarios WHERE fk_id_tipo_usr=3")->fetchAll(PDO::FETCH_OBJ);
                                foreach ($usuario as $usuarios) {
                                    ?>

                                    <tr>
                                        <td scope="row">
                                            <?php echo $i; ?>
                                        </td>
                                        <td>
                                            <?php echo $usuarios->usr_empresa; ?>
                                        </td>
                                        <td>
                                            <?php echo $usuarios->pk_id_usr; ?>
                                        </td>
                                        <td>
                                            <?php echo $usuarios->usr_email; ?>
                                        </td>
                                        <td>
                                            <?php echo $usuarios->usr_telefono; ?>
                                        </td>
                                        <td>
                                            <a class="text-warning"
                                                href="editarUsuario.php?id=<?php echo $usuarios->pk_id_usr; ?>">
                                                <i class="bi bi-pencil-square"></i>EDITAR</a>
                                                <a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger"
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
            <a href="javascript:history.back(-1);"><button class="btn btn-danger me-md-2" type="button">CANCELAR</button></a>
        </div>
    </div>
    <?php
    require_once("footer.php");
    ?>
</body>
<script>
     $(document).ready(function () {
        $('#tablaEmpresas').DataTable();
    });
</script>
</html>