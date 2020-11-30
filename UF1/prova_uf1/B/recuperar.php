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
        if ($_REQUEST["numero1"] + $_REQUEST["numero2"] == $_REQUEST["resultado"]) {
            if (isset($_REQUEST["enviar"]) && comprovar_email_db($_REQUEST["mail"])) {
                $pass = generar_string();
                $username = $_REQUEST["mail"];
                nueva_password(md5($pass), $username);
    
                $mail = new PHPMailer(true);
    
                try {
                    //Server settings
                    //$mail->SMTPDebug = 2;
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'kchaflam@fp.insjoaquimmir.cat';
                    $mail->Password   = 'OnlySora150';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port       = 587;
    
                    //Recipients
                    $mail->setFrom('kchaflam@fp.insjoaquimmir.cat', 'Mailer');
                    $mail->addAddress($username, 'Usuario');
    
                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Recuperacio de contrasenya';
                    $mail->Body    = 'Tu nueva contraseña: '.$pass.'<br>Para iniciar session usa tu nueva contraseña: <a href="https://dawjavi.insjoaquimmir.cat/kchafla/M07/UF1/prova_uf1/B/">Entrar</a>';
                    $mail->AltBody = 'Codigo: ';
    
                    $mail->send();
                    echo 'El correo se ha enviado.';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                echo "Ese correo no esta registrado!";
            }
        } else {
            echo "Escribe el resultado de la suma correctamente!";
        }

        if (isset($_REQUEST["volver"])) {
            header("Location: index.php");
        }
    }
?>
    <table border="1">
        <form method="post">
            <tr><th colspan="2">Escribe tu correo!</th></tr>
            <tr><td><label>Correo: </label></td><td><input type="text" name="mail"></td></tr>
<?php
    $numero1 = rand(1, 9);
    $numero2 = rand(1, 9);
    echo '<input type="hidden" name="numero1" value="'.$numero1.'">';
    echo '<input type="hidden" name="numero2" value="'.$numero2.'">';
    echo '<tr><td>'.$numero1." + ".$numero2." = </td>";
?>
            <td><input type="text" name="resultado"></td></tr>
            <td colspan="2" style="text-align: center;"><button type="submit" name="enviar" value="si">Regenerar</button></td></tr>
        </form>
    </table>
    <br>
    <form method="post">
        <label><strong>Volver:</strong> </label><button type="submit" name="volver" value="si">Volver</button>
    </form>
</body>
</html>