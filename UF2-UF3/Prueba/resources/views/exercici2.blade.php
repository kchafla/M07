<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercici 2</title>
</head>
<body>
    <h1>Exercici 2</h1>
    <form action="validacio2" method="post" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <label>Correo: </label><input type="text" name="correo"><br>
        <label>NIF: </label><input type="text" name="nif"><br>
        <label>Fichero: </label><input type="file" name="fichero"><br>
        <label>Imagen: </label><input type="file" name="imagen"><br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>