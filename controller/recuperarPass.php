<?php
if (isset($_POST['doc'])) {
    $documento = $_POST['doc'];
    if (isset($_POST['email'])) {
        $correo = $_POST['email'];
        include('conexion.php');
        $contrasena = "";
        $pattern = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $max = strlen($pattern) - 1;
        for ($i = 0; $i < 3; $i++) {
            $contrasena .= substr($pattern, mt_rand(0, $max), 1);
        }
        $pattern = "abcdefghijklmnopqrstuvwxyz";
        $max = strlen($pattern) - 1;
        for ($i = 0; $i < 3; $i++) {
            $contrasena .= substr($pattern, mt_rand(0, $max), 1);
        }
        $pattern = "1234567890";
        $max = strlen($pattern) - 1;
        for ($i = 0; $i < 3; $i++) {
            $contrasena .= substr($pattern, mt_rand(0, $max), 1);
        }
        $pass_cifrado = password_hash($contrasena, PASSWORD_DEFAULT, array("cost" => 7)); 
        $sql = "UPDATE usuarios SET login_pass=? WHERE pk_id_usr=$documento";
        $stmt = $base->prepare($sql);
        $stmt->execute([$pass_cifrado]);
    } else {
        echo "No correcto";
    }
} else {
    echo "No correcto";
}
?>
<script src="https://smtpjs.com/v3/smtp.js"></script>
<script type="text/javascript">
    function sendEmail() {
        pass= '<?php echo $contrasena?>'
        corr='<?php echo $correo?>'
        console.log(pass);
        Email.send({
            Host: "smtp.elasticemail.com",
            Username: "brayanMiiSena@gmail.com",
            Password: "6E8B36713FFE72D043DB7B49EAE5DB70B3DD",
            To: corr,
            From: "brayanMiiSena@gmail.com",
            Subject: "CONTRASEÑA TEMPORAL",
            Body: pass
        }).then(
            message => alert("Correo enviado: "+message)
        );
    }
    sendEmail()
</script>