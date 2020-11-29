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
    <title>Document</title>
</head>
<body>
<?php
    include "funcions.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST["enviar"]) && comprovar_email_db($_REQUEST["mail"])) {
            $pin = generar_string();
            $user = $_REQUEST["mail"];
            codigo_db($pin, $user);

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

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Recuperacio de contrasenya';
                $mail->Body    = 'Tu pin: '.$pin.'<br>Entra en este enlace para recuperar tu contraseña: <a href="https://dawjavi.insjoaquimmir.cat/kchafla/M07/UF1/Test/cambiar.php">Entrar</a>';
                $mail->AltBody = 'Codigo: ';

                $mail->send();
                echo 'El correo se ha enviado.';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

        if (isset($_REQUEST["volver"])) {
            header("Location: index.php");
        }
    }
?>
<form method="post">
    <label>Correo: </label><input type="text" name="mail">
    <button type="submit" name="enviar" value="si">Enviar</button>
</form>
<form method="post">
    <label>Volver: </label><button type="submit" name="volver" value="si">Volver</button>
</form>
</body>
</html>