<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercici 1</title>
</head>
<body>
    <h1>Exercici 1</h1>
    <form action="validacio" method="post">
        @csrf
        <label>Correo: </label><input type="text" name="correo">
        <label>Edad: </label><input type="text" name="edad">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>