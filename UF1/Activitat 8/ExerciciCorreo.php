<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
</head>
<body>
<?php
    include "funcions.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST["volver"])) {
            header("Location: ExerciciPublic.php");
        }

        if (isset($_REQUEST["correo"]) && comprovar_email_db($_REQUEST["recuperar"])) {
            $user = $_REQUEST["recuperar"];
            $codigo = generar_string();
            codigo_db($codigo, $user);

            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 2;
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'kchaflam@fp.insjoaquimmir.cat';
                $mail->Password   = 'OnlySora150';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                //Recipients
                $mail->setFrom('kchaflam@fp.insjoaquimmir.cat', 'Mailer');
                $mail->addAddress($user, 'Usuario');
                //$mail->addReplyTo('info@example.com', 'Information');

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Recuperacio de contrasenya - Reconfirmo Web';
                $mail->Body    = 'Entra en este enlace para recuperar tu contraseña: <a href="https://dawjavi.insjoaquimmir.cat/kchafla/M07/UF1/Activitat%208/ExerciciRecuperar.php?codi='.$codigo.'">Entrar</a>';
                $mail->AltBody = 'Codigo: ';

                $mail->send();
                echo 'El correo se ha enviado.';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
?>
<table border="1">
    <tr><th colspan="2">Recuperar contraseña</th></tr>
    <form method="post">
        <tr><td style="text-align: right;"><label>Tu correo: </label></td><td><input type="text" name="recuperar"></td></tr>
        <tr><td colspan="2" style="text-align: center;"><button type="submit" name="correo">Enviar correo</button></td></tr>
    </form>
</table><br>
<form method="post">
    <h3>Volver a la pagina principal: <button type="submit" name="volver" value="public">Menu</button></h3>
</form>
</body>
</html>