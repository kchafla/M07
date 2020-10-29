<?php
    session_start();
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
        
    }
?>
<form method="post">
    <label>Tu mail: </label><input type="text" name="registroEmail"><br>
    <label>Tu contraseña: </label><input type="text" name="registroPassword"><br><br>
    <button type="submit">Registrarse</button>
</form>
</body>
</html>