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
    // $programa = "todos";
    $tipo=$_SESSION['tipo'];
    if(isset($_GET['programa'])){
        $programa = $_GET['programa'];
    }
    if(isset($_GET['etapa'])){
        $etapa = $_GET['etapa'];
    }
    ?>
    <div style="min-height: 85vh;">
        <div class="container">
            <div>
                <div class="p-1">
                    <div class="text-center">
                        <h2>APRENDICES</h2>
                    </div>
                    <!-- TABLA CON LOS DATOS DE LOS APRENDICES Y OPCIONES SEGUN EL USUARIO QUE LO VE -->
                    <table id="tablaAprendices" class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Documento</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Ficha</th>
                                <th scope="col">Programa</th>
                                <th scope="col">Etapa</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- FILTROS DE LA TABLA PARA LA EMPRESA -->
                            <?php
                            if(!isset($programa) and !isset($etapa)){
                                $query="SELECT * FROM fichas";
                            }
                            else{
                            if($programa=="todos"){
                                $query="SELECT * FROM fichas WHERE ficha_etapa='$etapa'";
                            }
                            else{
                                $query="SELECT * FROM fichas WHERE fk_id_pro=$programa and ficha_etapa='$etapa'";
                            }
                        }
                            $fichas = $base->query($query)->fetchAll(PDO::FETCH_OBJ);
                            $i = 1;
                            foreach ($fichas as $datosFicha) {
                                $fichaPro = $datosFicha->pk_id_ficha;
                                $usuario = $base->query("SELECT * FROM usuarios WHERE fk_id_ficha=$fichaPro")->fetchAll(PDO::FETCH_OBJ);
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
                                            <?php echo $usuarios->fk_id_ficha; ?>
                                        </td>
                                        <td>
                                            <?php 
                                            $programaa=$datosFicha->fk_id_pro; 
                                            $pro = $base->query("SELECT * FROM programas WHERE pk_id_pro=$programaa")->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($pro as $prog) {
                                                echo $prog->pro_nombre;
                                            } 
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $datosFicha->ficha_etapa; ?>
                                        </td>
                                        <td>
                                            <?php echo $usuarios->usr_email; ?>
                                        </td>
                                        <td>
                                            <?php echo $usuarios->usr_telefono; ?>
                                        </td>
                                        <td>
                                            <a class="text-primary"
                                                href="hojaVida.php?id=<?php echo $usuarios->pk_id_usr; ?>">
                                                <i class="bi bi-file-earmark-text-fill">VER</i></a>
                                                <br>
                                                <!-- OPCIONES QUE SOLAMENTE EL FUNCIONARIO PUEDE VER Y EJECUTAR -->
                                                <?php if($tipo==2){ ?>
                                                <a class="text-warning"
                                                href="editarUsuario.php?id=<?php echo $usuarios->pk_id_usr; ?>">
                                                <i class="bi bi-pencil-square"></i>EDITAR</a>
                                                <br>
                                                <a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger"
                                            href="../controller/eliminarUsuario.php?id=<?php echo $usuarios->pk_id_usr; ?>"><i
                                                class="bi bi-trash-fill">ELIMINAR</i></a>
                                                <?php } ?>
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
            <!-- BOTON PARA VOLVER -->
            <a href="javascript:history.back(-1);"><button class="btn btn-danger me-md-2" type="button">CANCELAR</button></a>
        </div>
    </div>
    <?php
    require_once("footer.php");
    ?>
</body>
<script>
    // INICIALIZA LA TABLA CON LA LIBRERIA DATATABLE
     $(document).ready(function () {
        $('#tablaAprendices').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
  });
    });

</script>
</html>