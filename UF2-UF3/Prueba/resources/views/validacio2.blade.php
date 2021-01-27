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
    Correo: {{$data['validated']['correo']}} <br>
    NIF: {{$data['validated']['nif']}} <br>
    Imagen: <img src='{{ asset('img/'.$data['originalImage']) }}'><br>
    Fichero: <a href='{{ asset('files/'.$data['originalFile']) }}'>Ir al fichero</a>
</body>
</html>