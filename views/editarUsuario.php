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
    $id = $_GET['id'];
    $contrasena = 'no';
    if (isset($_GET['contrasena'])) {
        $contrasena = $_GET['contrasena'];
    }
    $usuario = $base->query("SELECT * FROM usuarios WHERE pk_id_usr=$id")->fetchAll(PDO::FETCH_OBJ);
    foreach ($usuario as $usuarios) {
        if ($usuarios->fk_id_tipo_usr == 1) {
            ?>
            <div style="min-height: 85vh;">
                <div class="container font-weight-bold">
                    <!-- EDITAR APRENDIZ -->
                    <div class="container" style="padding-bottom: 2rem;" id="editarAprendiz">
                        <br>
                        <h2>EDITAR APRENDIZ</h2>
                        <!-- FORMULARIO PARA EL REGISTRO DEL APRENDIZ -->
                        <form action="../controller/editarUsuario.php" method="post">
                            <input type="text" class="form-control" id="tipoUsr" name="tipoUsr" value=1 hidden>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label for="nombres">Nombres:</label>
                                    <input type="text" class="form-control" id="nombres" name="nombres"
                                        value="<?php echo $usuarios->usr_nombre ?>" required>
                                </div>
                                <div class="col form-group">
                                    <label for="apellidos">Apellidos:</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos"
                                        value="<?php echo $usuarios->usr_apellidos ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label for="tipodocumento">Tipo Documento:</label>
                                    <select class="form-select" aria-label="Default select example" name="tipoDocumento">
                                        <option value="<?php echo $usuarios->fk_id_tipo_doc ?>"><?php echo $usuarios->fk_id_tipo_doc ?></option>
                                        <?php
                                        $tipoDocumento = $base->query("SELECT * FROM tipo_documento")->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($tipoDocumento as $tipo) {
                                            ?>
                                            <option value="<?php echo $tipo->pk_id_tipo_doc ?>"><?php echo $tipo->tipo_doc_descripcion ?></option>

                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="documento">Documento:</label>
                                    <input type="number" class="form-control" id="documento" name="documento"
                                        value="<?php echo $usuarios->pk_id_usr ?>" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group ">
                                    <label for="rh">Rh:</label>
                                    <select class="form-select" name="rh" id="rh" required>
                                        <option value="<?php echo $usuarios->usr_rh ?>"><?php echo $usuarios->usr_rh ?>
                                        </option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="ficha">Numero Ficha:</label>
                                    <input type="number" class="form-control" id="ficha" name="ficha"
                                        value="<?php echo $usuarios->fk_id_ficha ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label for="correo">Correo electrónico:</label>
                                    <input type="email" class="form-control" id="correo" name="correo"
                                        value="<?php echo $usuarios->usr_email ?>" required>
                                </div>
                                <div class="col form-group">
                                    <label for="telefono">Teléfono:</label>
                                    <input type="number" class="form-control" id="telefono" name="telefono"
                                        value="<?php echo $usuarios->usr_telefono ?>" required>
                                </div>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <h6 id="mensajeCampos" style="color:red" hidden><i class="bi bi-x-octagon-fill"></i> Todos los
                                    campos son obligatorios <i class="bi bi-x-octagon-fill"></i></h6>
                            </div>
                            <button type="submit" class="btn btn-success" id="btnEnviar">ACTUALIZAR DATOS</button>
                            <button type="button" class="btn btn-warning" id="btnActualizarContraseña">
                                ACTUALIZAR CONTRASEÑA</button>
                        </form>
                        <dialog id="dialogActualizarContraseña" style="min-width: 50%;">
                            <form action="../controller/actualizarContrasena.php" method="post">
                                <h5>CAMBIAR CONTRASEÑA</h5>
                                <div class="form-row">
                                    <div class="col form-group">
                                        <input type="number" class="form-control" id="documento" name="documento"
                                            value="<?php echo $usuarios->pk_id_usr ?>" hidden>
                                        <label for="contrasena">Nueva Contraseña:</label>
                                        <input type="password" class="form-control" id="contrasena" name="contrasena" value=""
                                            required>
                                        <h6 id="mensajeLetra" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al menos una
                                            minuscula<i class="bi bi-x-octagon-fill"></i></h6>
                                        <h6 id="mensajeMayuscula" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al menos
                                            una
                                            MAYUSCULA<i class="bi bi-x-octagon-fill"></i></h6>
                                        <h6 id="mensajeNumero" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al menos un
                                            numero<i class="bi bi-x-octagon-fill"></i></h6>
                                        <h6 id="mensajeCaracteres" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al
                                            menos 7
                                            caracteres<i class="bi bi-x-octagon-fill"></i></h6>
                                        <h6 id="mensajeCohinciden" style="color:red"><i class="bi bi-x-octagon-fill"></i>Las
                                            contraseñas
                                            deben coincidir<i class="bi bi-x-octagon-fill"></i></h6>
                                    </div>
                                    <div class="col form-group">
                                        <label for="contrasena">Confirmar Contraseña:</label>
                                        <input type="password" class="form-control" id="ConfirmarContrasena"
                                            name="ConfirmarContrasena" value="" required>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <button type="button" class="btn btn-success" onclick="confirmarContraseña()">ACTUALIZAR
                                        CONTRASEÑA</button>
                                    <button type="submit" class="btn btn-success" id="btnEnviarC" hidden>Enviar</button>
                                    <button type="button" class="btn btn-danger" id="btnCerrarContraseña">REGRESAR</button>
                                </div>
                            </form>
                        </dialog>
                    </div>
                    <?php
        } else if ($usuarios->fk_id_tipo_usr == 3) {
            ?>
                        <!-- EDITAR EMPRESA -->
                        <div class="container font-weight-bold" style="padding-bottom: 2rem;" id="editarEmpresa">
                            <br>
                            <h2>EDITAR EMPRESA</h2>
                            <form action="../controller/editarUsuario.php" method="post">
                                <input type="text" class="form-control" id="tipoUsr" name="tipoUsr" value=3 hidden>
                                <div class="form-row">
                                    <div class="col form-group">
                                        <label for="nombreEmpresa">Nombre Empresa:</label>
                                        <input type="text" class="form-control" id="nombreEmpresa" name="nombreEmpresa"
                                            value="<?php echo $usuarios->usr_empresa ?>" required>
                                    </div>
                                    <div class="col form-group">
                                        <label for="nit">Nit:</label>
                                        <input type="number" class="form-control" id="nit" name="nit"
                                            value="<?php echo $usuarios->pk_id_usr ?>" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col form-group">
                                        <label for="nombres">Nombre encargado:</label>
                                        <input type="text" class="form-control" id="nombres" name="nombres"
                                            value="<?php echo $usuarios->usr_nombre ?>" required>
                                    </div>
                                    <div class="col form-group">
                                        <label for="apellidos">Apellidos:</label>
                                        <input type="text" class="form-control" id="apellidos" name="apellidos"
                                            value="<?php echo $usuarios->usr_apellidos ?>" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col form-group">
                                        <label for="correo">Correo electrónico:</label>
                                        <input type="email" class="form-control" id="correo" name="correo"
                                            value="<?php echo $usuarios->usr_email ?>" required>
                                    </div>
                                    <div class="col form-group">
                                        <label for="telefono">Teléfono:</label>
                                        <input type="number" class="form-control" id="telefono" name="telefono"
                                            value="<?php echo $usuarios->usr_telefono ?>" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success" id="btnEnviar">ACTUALIZAR DATOS</button>
                                <button type="button" class="btn btn-warning" id="btnActualizarContraseña">
                                    ACTUALIZAR CONTRASEÑA</button>
                            </form>
                            <dialog id="dialogActualizarContraseña" style="min-width: 50%;">
                                <form action="../controller/actualizarContrasena.php" method="post">
                                    <h5>CAMBIAR CONTRASEÑA</h5>
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <input type="number" class="form-control" id="documento" name="documento"
                                                value="<?php echo $usuarios->pk_id_usr ?>" hidden>
                                            <label for="contrasena">Nueva Contraseña:</label>
                                            <input type="password" class="form-control" id="contrasena" name="contrasena" value=""
                                                required>
                                            <h6 id="mensajeLetra" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al menos una
                                                minuscula<i class="bi bi-x-octagon-fill"></i></h6>
                                            <h6 id="mensajeMayuscula" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al menos
                                                una
                                                MAYUSCULA<i class="bi bi-x-octagon-fill"></i></h6>
                                            <h6 id="mensajeNumero" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al menos un
                                                numero<i class="bi bi-x-octagon-fill"></i></h6>
                                            <h6 id="mensajeCaracteres" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al
                                                menos 7
                                                caracteres<i class="bi bi-x-octagon-fill"></i></h6>
                                            <h6 id="mensajeCohinciden" style="color:red"><i class="bi bi-x-octagon-fill"></i>Las
                                                contraseñas
                                                deben coincidir<i class="bi bi-x-octagon-fill"></i></h6>
                                        </div>
                                        <div class="col form-group">
                                            <label for="contrasena">Confirmar Contraseña:</label>
                                            <input type="password" class="form-control" id="ConfirmarContrasena"
                                                name="ConfirmarContrasena" value="" required>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                        <button type="button" class="btn btn-success" onclick="confirmarContraseña()">ACTUALIZAR
                                            CONTRASEÑA</button>
                                        <button type="submit" class="btn btn-success" id="btnEnviarC" hidden>Enviar</button>
                                        <button type="button" class="btn btn-danger" id="btnCerrarContraseña">REGRESAR</button>
                                    </div>
                                </form>
                            </dialog>
                        </div>
                    <?php
        } else if ($usuarios->fk_id_tipo_usr == 4) {
            ?>
                            <!-- EDITAR INSTRUCTOR -->
                            <div class="container font-weight-bold" style="padding-bottom: 2rem;" id="editarInstructor">
                                <br>
                                <h2>EDITAR INSTRUCTOR</h2>
                                <form action="../controller/editarUsuario.php" method="post">
                                    <input type="text" class="form-control" id="tipoUsr" name="tipoUsr" value=4 hidden>
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label for="nombres">Nombres:</label>
                                            <input type="text" class="form-control" id="nombres" name="nombres"
                                                value="<?php echo $usuarios->usr_nombre ?>" required>
                                        </div>
                                        <div class="col form-group">
                                            <label for="apellidos">Apellidos:</label>
                                            <input type="text" class="form-control" id="apellidos" name="apellidos"
                                                value="<?php echo $usuarios->usr_apellidos ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label for="tipodocumento">Tipo Documento:</label>
                                            <select class="form-select" aria-label="Default select example" name="tipoDocumento">
                                                <option value="<?php echo $usuarios->fk_id_tipo_doc ?>"><?php echo $usuarios->fk_id_tipo_doc ?></option>
                                            <?php
                                            $tipoDocumento = $base->query("SELECT * FROM tipo_documento")->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($tipoDocumento as $tipo) {
                                                ?>
                                                    <option value="<?php echo $tipo->pk_id_tipo_doc ?>"><?php echo $tipo->tipo_doc_descripcion ?></option>

                                            <?php
                                            }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="documento">Documento:</label>
                                            <input type="number" class="form-control" id="documento" name="documento"
                                                value="<?php echo $usuarios->pk_id_usr ?>" required>
                                        </div>
                                        <div class="colmd-2 form-group ">
                                            <label for="rh">Rh:</label>
                                            <select class="form-select" name="rh" id="rh" required>
                                                <option value="<?php echo $usuarios->usr_rh ?>"><?php echo $usuarios->usr_rh ?>
                                                </option>
                                                <option value="A+">A+</option>
                                                <option value="A-">A-</option>
                                                <option value="B+">B+</option>
                                                <option value="B-">B-</option>
                                                <option value="O+">O+</option>
                                                <option value="O-">O-</option>
                                                <option value="AB+">AB+</option>
                                                <option value="AB-">AB-</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label for="correo">Correo electrónico:</label>
                                            <input type="email" class="form-control" id="correo" name="correo"
                                                value="<?php echo $usuarios->usr_email ?>" required>
                                        </div>
                                        <div class="col form-group">
                                            <label for="telefono">Teléfono:</label>
                                            <input type="number" class="form-control" id="telefono" name="telefono"
                                                value="<?php echo $usuarios->usr_telefono ?>" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success" id="btnEnviar">ACTUALIZAR DATOS</button>
                                    <button type="button" class="btn btn-warning" id="btnActualizarContraseña">
                                        ACTUALIZAR CONTRASEÑA</button>
                                </form>
                                <dialog id="dialogActualizarContraseña" style="min-width: 50%;">
                                    <form action="../controller/actualizarContrasena.php" method="post">
                                        <h5>CAMBIAR CONTRASEÑA</h5>
                                        <div class="form-row">
                                            <div class="col form-group">
                                                <input type="number" class="form-control" id="documento" name="documento"
                                                    value="<?php echo $usuarios->pk_id_usr ?>" hidden>
                                                <label for="contrasena">Nueva Contraseña:</label>
                                                <input type="password" class="form-control" id="contrasena" name="contrasena" value=""
                                                    required>
                                                <h6 id="mensajeLetra" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al menos una
                                                    minuscula<i class="bi bi-x-octagon-fill"></i></h6>
                                                <h6 id="mensajeMayuscula" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al menos
                                                    una
                                                    MAYUSCULA<i class="bi bi-x-octagon-fill"></i></h6>
                                                <h6 id="mensajeNumero" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al menos un
                                                    numero<i class="bi bi-x-octagon-fill"></i></h6>
                                                <h6 id="mensajeCaracteres" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al
                                                    menos 7
                                                    caracteres<i class="bi bi-x-octagon-fill"></i></h6>
                                                <h6 id="mensajeCohinciden" style="color:red"><i class="bi bi-x-octagon-fill"></i>Las
                                                    contraseñas
                                                    deben coincidir<i class="bi bi-x-octagon-fill"></i></h6>
                                            </div>
                                            <div class="col form-group">
                                                <label for="contrasena">Confirmar Contraseña:</label>
                                                <input type="password" class="form-control" id="ConfirmarContrasena"
                                                    name="ConfirmarContrasena" value="" required>
                                            </div>
                                        </div>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                            <button type="button" class="btn btn-success" onclick="confirmarContraseña()">ACTUALIZAR
                                                CONTRASEÑA</button>
                                            <button type="submit" class="btn btn-success" id="btnEnviarC" hidden>Enviar</button>
                                            <button type="button" class="btn btn-danger" id="btnCerrarContraseña">REGRESAR</button>
                                        </div>
                                    </form>
                                </dialog>
                            </div>
                    <?php
        } else if ($usuarios->fk_id_tipo_usr == 2) {
            ?>

                                <!-- EDITAR FUNCIONARIO -->
                                <div class="container font-weight-bold" style="padding-bottom: 2rem;" id="editarFuncionario">
                                    <br>
                                    <h2>EDITAR FUNCIONARIO</h2>
                                    <form action="../controller/editarUsuario.php" method="post">
                                        <input type="text" class="form-control" id="tipoUsr" name="tipoUsr" value=2 hidden>
                                        <div class="form-row">
                                            <div class="col form-group">
                                                <label for="nombres">Nombres:</label>
                                                <input type="text" class="form-control" id="nombres" name="nombres"
                                                    value="<?php echo $usuarios->usr_nombre ?>" required>
                                            </div>
                                            <div class="col form-group">
                                                <label for="apellidos">Apellidos:</label>
                                                <input type="text" class="form-control" id="apellidos" name="apellidos"
                                                    placeholder="Introduce tus apellidos" value="<?php echo $usuarios->usr_apellidos ?>"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col form-group">
                                                <label for="tipodocumento">Tipo Documento:</label>
                                                <select class="form-select" aria-label="Default select example" name="tipoDocumento">
                                                    <option value="<?php echo $usuarios->fk_id_tipo_doc ?>"><?php echo $usuarios->fk_id_tipo_doc ?></option>
                                            <?php
                                            $tipoDocumento = $base->query("SELECT * FROM tipo_documento")->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($tipoDocumento as $tipo) {
                                                ?>
                                                        <option value="<?php echo $tipo->pk_id_tipo_doc ?>"><?php echo $tipo->tipo_doc_descripcion ?></option>

                                            <?php
                                            }
                                            ?>
                                                </select>
                                            </div>
                                            <div class="col form-group">
                                                <label for="documento">Documento:</label>
                                                <input type="number" class="form-control" id="documento" name="documento"
                                                    value="<?php echo $usuarios->pk_id_usr ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col form-group ">
                                                <label for="rh">Rh:</label>
                                                <select class="form-select" name="rh" id="rh" required>
                                                    <option value="<?php echo $usuarios->usr_rh ?>"><?php echo $usuarios->usr_rh ?>
                                                    </option>
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                </select>
                                            </div>
                                            <div class="col form-group">
                                                <label for="cargo">Cargo:</label>
                                                <input type="text" class="form-control" id="cargo" name="cargo"
                                                    value="<?php echo $usuarios->usr_cargo ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col form-group">
                                                <label for="correo">Correo electrónico:</label>
                                                <input type="email" class="form-control" id="correo" name="correo"
                                                    value="<?php echo $usuarios->usr_email ?>" required>
                                            </div>
                                            <div class="col form-group">
                                                <label for="telefono">Teléfono:</label>
                                                <input type="number" class="form-control" id="telefono" name="telefono"
                                                    value="<?php echo $usuarios->usr_telefono ?>" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success" id="btnEnviar">ACTUALIZAR DATOS</button>
                                        <button type="button" class="btn btn-warning" id="btnActualizarContraseña">
                                            ACTUALIZAR CONTRASEÑA</button>
                                    </form>
                                    <dialog id="dialogActualizarContraseña" style="min-width: 50%;">
                                        <form action="../controller/actualizarContrasena.php" method="post">
                                            <h5>CAMBIAR CONTRASEÑA</h5>
                                            <div class="form-row">
                                                <div class="col form-group">
                                                    <input type="number" class="form-control" id="documento" name="documento"
                                                        value="<?php echo $usuarios->pk_id_usr ?>" hidden>
                                                    <label for="contrasena">Nueva Contraseña:</label>
                                                    <input type="password" class="form-control" id="contrasena" name="contrasena" value=""
                                                        required>
                                                    <h6 id="mensajeLetra" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al menos una
                                                        minuscula<i class="bi bi-x-octagon-fill"></i></h6>
                                                    <h6 id="mensajeMayuscula" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al menos
                                                        una
                                                        MAYUSCULA<i class="bi bi-x-octagon-fill"></i></h6>
                                                    <h6 id="mensajeNumero" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al menos un
                                                        numero<i class="bi bi-x-octagon-fill"></i></h6>
                                                    <h6 id="mensajeCaracteres" style="color:red"><i class="bi bi-x-octagon-fill"></i>Al
                                                        menos 7
                                                        caracteres<i class="bi bi-x-octagon-fill"></i></h6>
                                                    <h6 id="mensajeCohinciden" style="color:red"><i class="bi bi-x-octagon-fill"></i>Las
                                                        contraseñas
                                                        deben coincidir<i class="bi bi-x-octagon-fill"></i></h6>
                                                </div>
                                                <div class="col form-group">
                                                    <label for="contrasena">Confirmar Contraseña:</label>
                                                    <input type="password" class="form-control" id="ConfirmarContrasena"
                                                        name="ConfirmarContrasena" value="" required>
                                                </div>
                                            </div>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                <button type="button" class="btn btn-success" onclick="confirmarContraseña()">ACTUALIZAR
                                                    CONTRASEÑA</button>
                                                <button type="submit" class="btn btn-success" id="btnEnviarC" hidden>Enviar</button>
                                                <button type="button" class="btn btn-danger" id="btnCerrarContraseña">REGRESAR</button>
                                            </div>
                                        </form>
                                    </dialog>
                                </div>
                    <?php
        }
        ?>
            </div>
        </div>
        <?php
    }
    require_once("footer.php");
    ?>
</body>
<script>
    // MUESTRA O ESCONDE EL DIALOG PARA ACTUAIZAR LA CONTRASEÑA
    const btnActualizarContraseña = document.getElementById('btnActualizarContraseña');
    const btnCerrarContraseña = document.getElementById('btnCerrarContraseña');
    const dialogActualizarContraseña = document.getElementById('dialogActualizarContraseña');

    btnActualizarContraseña.addEventListener('click', () => {
        dialogActualizarContraseña.showModal();
    });
    btnCerrarContraseña.addEventListener('click', () => {
        dialogActualizarContraseña.close();
    });

    function confirmarContraseña() {
        clave1 = $('#contrasena').val()
        clave2 = $('#ConfirmarContrasena').val()
        enviar = 'no';
        if (clave1 == clave2 && clave1 != "") {
            $("#mensajeCohinciden").css("color", "green");
            enviar = 'si';
            // Longitud de la contraseña
            if (clave1.length <= 6) {
                $("#mensajeCaracteres").css("color", "red");
                enviar = 'no';
            }
            else {
                $("#mensajeCaracteres").css("color", "green");
            }
            // Que conenga una letra la contraseña
            if (clave1.match(/[a-z]/)) {
                $("#mensajeLetra").css("color", "green");
            }
            else {
                $("#mensajeLetra").css("color", "red");
                enviar = 'no';
            }

            //validar letra mayúscula
            if (clave1.match(/[A-Z]/)) {
                $("#mensajeMayuscula").css("color", "green");
            } else {
                $("#mensajeMayuscula").css("color", "red");
                enviar = 'no';
            }

            //validar numero
            if (clave1.match(/\d/)) {
                $("#mensajeNumero").css("color", "green");
            } else {
                $("#mensajeNumero").css("color", "red");
                enviar = 'no';
            }

            if (enviar == 'si') {
                $('#btnEnviarC').click()
            }

        } else {
            $("#mensajeCohinciden").css("color", "red");
        }
    }

    if ('<?php echo $contrasena ?>' == 'si') {
        Swal.fire({
            title: 'Su contraseña ha sido cambiada',
            color: '#ffffff',
            icon: 'success',
            iconColor: 'green',
        })
    }
</script>

</html>