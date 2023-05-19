<!-- HEADER DE LA APLICACION -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <img src="../images/mii.png" alt="" height="70px">
    <!-- SEGUN EL USUARIO SE MUESTRAN DIFERENTES OPCIONES -->
    <?php
    if (isset($_SESSION['usuario'])) {
      $usr = $_SESSION['tipo'];
      ?>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <?php
          if ($usr == 2) {
            ?>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="funcionario.php"><i class="bi bi-house-fill"></i>HOME</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="buscarAprendices.php">APRENDIZ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="buscarEmpresas.php">EMPRESA</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="buscarInstructores.php">INSTRUCTOR</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="buscarFuncionarios.php">FUNCIONARIO</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="formacion.php">FORMACION</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                REGISTRO
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="registroEmpresa.php">EMPRESA</a></li>
                <li><a class="dropdown-item" href="registroInstructor">INSTRUCTOR</a></li>
                <li><a class="dropdown-item" href="registroFuncionario">FUNCIONARIO</a></li>
              </ul>
            </li>
          <?php
          } else if ($usr == 1) {
            ?>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="aprendiz.php"><i class="bi bi-house-fill"></i>HOME</a>
              </li>
              <?php
          } else if ($usr == 3) {
            ?>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="empresa.php"><i class="bi bi-house-fill"></i>HOME</a>
              </li>
          <?php
          }
          ?>
        </ul>
        <!-- BOTON PARA SALIR DE LA APLICACION -->
        <div class="d-flex">

          <a href="../controller/salir.php"><button class="btn btn-outline-danger" type="submit"><i class="bi bi-door-open">
                SALIR</i></button></a>
        </div>
      </div>
      <?php
    } else {
      header("Location: ../");
    }
    ?>

  </div>
</nav>