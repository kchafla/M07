<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validacio 2</title>
</head>
<body>
    <h1>Validacio de formulari - Exercici 2</h1>
    @csrf
    Correo: {{$validat['correo']}} <br>
    NIF: {{$validat['nif']}} <br>
    Imagen: <img src='{{ asset('img/'.$imatge) }}'><br>
    Fichero: <a href='{{ asset('files/'.$archiu) }}'>Ir al fichero</a>
</body>
</html>