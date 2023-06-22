<?php
try {

    include("conexion.php");

    //toma los datos del formulario que se envia desde el index
    $usuario = htmlentities(addslashes($_POST["usuario"]));
    echo $_POST["usuario"];
    $password = htmlentities(addslashes($_POST["password"]));
    echo $_POST["password"];

    $contador = 0; //Este contador se usa para saber si el usuario existe, cuando se encuentra el ususario se le suma uno

    $sql = "SELECT * FROM usuarios WHERE pk_id_usr= :usuario"; //selecciona los datos del usuario donde su codigo de usuario es igual al enviado en el formulario
    $resultado = $base->prepare($sql); //preparia una sentencia para su ejecucion y devuelve un objeto de sentencia

    $resultado->execute(array(":usuario" => $usuario)); //ejecuta la secuencia preparada 

    while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) { //recorre cada fila de los usuarios encontrados
        echo "comprueba";
        if (password_verify($password, $registro['login_pass'])) { //se comprueba si la contraseña es igual a la que se ingreso en el formulario, lo que hace el password_verify es desifrar la contraseña
            $contador++; //si la clave es correcta se suma uno al contador
            session_start(); //como es correcto el inicio se inicia la sesion para que el usuario pueda entrar a los modulos
            $_SESSION["tipo"] = $registro['fk_id_tipo_usr'];
        }
        // if ($password == $registro['login_pass']) { //se comprueba si la contraseña es igual a la que se ingreso en el formulario, lo que hace el password_verify es desifrar la contraseña
        //     echo "es igual";
        //     echo $registro['login_pass'];
        //     $contador++; //si la clave es correcta se suma uno al contador

        // }
    }

    if ($contador > 0) { //si el contador es mayor que cero es porque el usuario y la contraseña son correctos
        echo "contador mayor que cero";
        $_SESSION["usuario"] = $_POST["usuario"]; //se hace un post a la sesion del usuario para verificar que permisos tiene el usuario en cada modul 

        if ($_SESSION["tipo"] == 1) {
            echo "entra como aprendiz";
            header("location:../views/aprendiz.php"); //manda al usuario a hacer solicitud que es la pagina principal de la aplicacion
        }
        if ($_SESSION["tipo"] == 2) {
            header("location:../views/funcionario.php"); //manda al usuario a hacer solicitud que es la pagina principal de la aplicacion
        }
        if ($_SESSION["tipo"] == 3) {
            header("location:../views/empresa.php"); //manda al usuario a hacer solicitud que es la pagina principal de la aplicacion
        }
        if ($_SESSION["tipo"] == 4) {
            header("location:../views/instructor.php"); //manda al usuario a hacer solicitud que es la pagina principal de la aplicacion
        }
        $fichas = $base->query("SELECT * FROM fichas")->fetchAll(PDO::FETCH_OBJ);
        foreach ($fichas as $datosFicha) {
            $hoy = date('Y-m-d');
            $fin = $datosFicha->ficha_fecha_terminacion;
            if($hoy <= $fin){
                $datetime1 = new DateTime($hoy);
                $datetime2 = new DateTime($fin);
    
                # obtenemos la diferencia entre las dos fechas
                $interval = $datetime2->diff($datetime1);
    
                # obtenemos la diferencia en meses
                // $intervalMeses = $interval->format("%m");
                $intervalMeses = $interval->format('%y')*12 + $interval->format('%m'); 
                echo "-".$intervalMeses;
                }
                else{
                    $intervalMeses=0;
                }
            if ($intervalMeses <= 6) {
                $ficha = $datosFicha->pk_id_ficha;
                $query = "UPDATE fichas SET ficha_etapa='PRACTICA' WHERE pk_id_ficha=$ficha;";
                $sentencia = $base->prepare($query);
                $resultado = $sentencia->execute();
            } else {
                $ficha = $datosFicha->pk_id_ficha;
                $query = "UPDATE fichas SET ficha_etapa='LECTIVA' WHERE pk_id_ficha=$ficha;";
                $sentencia = $base->prepare($query);
                $resultado = $sentencia->execute();
            }
        }
    } else {
        header("location:../index.php?"); //Si no hay datos correctos manda al usuario al inicio para que lo intente nuevamente
    }

    $resultado->closeCursor(); //libera la conexion al servidor, es un metodo opcional que permite la maxima eficiencia

} catch (Exception $e) { //Si ocurre algun error en este proceso se muestra un mensaje 
    die("Error: " . $e->getMessage());
}

?>