<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook</title>
</head>
<body>
    <div id="publicaciones">
    
    </div>
    <div id="postear">
        <h3>Nueva publicación</h3>
        <form action="{{ url('post') }}" method="post">
            @csrf
            <textarea name="body" id="body" cols="50" rows="8" style="resize: none;"></textarea><br>
            <button>Enviar</button>
        </form>
    </div>
</body>
</html>