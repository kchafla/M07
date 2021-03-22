<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta id="token" name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/48ff99beb4.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script id="user" name="{{Auth::user()->name}}" src="{{ asset('js/functions.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Facebook</h2>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div id="errors" class="alert alert-danger" style="display: none;"></div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <p><span class="h3">Nueva publicación</span> <span id="escribiendo" class="text-disabled"></span></p>
                                <div id="postear">
                                    <br><hr><br>
                                    <form action="{{ route('post') }}" id="nuevopost" enctype="multipart/form-data">
                                        <textarea name="cuerpo" id="cuerpo" style="width: 100%; height: 100px; resize: none;" maxlength="200"></textarea><br><br>
                                        <input type="file" name="imagen" id="imagen"><br><br>
                                        <button class="btn btn-dark">Enviar publicación</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div id="alerta" class="alert alert-success" style="display: none;"></div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <p class="h3">Publicaciones</p>
                                <br><hr><br>
                                <div id="publicaciones">
                                    @foreach ($posts as $post)
                                        <div id="{{$post->id}}">
                                            <p><span class="h5">Publicación de {{$post->from}}</span> <span class="text-muted">{{$post->created_at}}</span></p>
                                            <p>{{$post->body}}</p>
                                            @if ($post->image != NULL)
                                                <img src="{{ asset("$post->image") }}" class="img-fluid">
                                            @endif
                                            <br>
                                            <form id="nuevolike" action="{{ route('like') }}">
                                                <input type="hidden" name="id" id="id" value="{{$post->id}}">
                                                @php
                                                    $total = 0;
                                                    $dado = false;
                                                    foreach ($likes as $like) {
                                                        if ($like->post_id == $post->id) {
                                                            $total++;
                                                            if ($like->user_id == $user) {
                                                                $dado = true;
                                                            }  
                                                        }
                                                    }

                                                    if ($dado) {
                                                        echo "<p><span id='likes'>".$total."</span> Likes <button class='btn btn-danger' id='darlike'><i class='far fa-thumbs-down'></i> No me gusta</button></p>";
                                                    } else {
                                                        echo "<p><span id='likes'>".$total."</span> Likes <button class='btn btn-primary' id='darlike'><i class='far fa-thumbs-up'></i> Me gusta</button></p>";
                                                    }
                                                @endphp
                                            </form>
                                            <br>
                                            <p class="h5">Comentarios</p>
                                            <div id="comentarios">
                                                @foreach ($comments as $comment)
                                                    @if ($comment->post_id == $post->id)
                                                        <p>{{$comment->from}} a las {{$comment->created_at}}: {{$comment->body}}</p>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <form id="nuevocomment" action="{{ route('comment') }}">
                                                <input type="hidden" name="id" id="id" value="{{$post->id}}">
                                                <input type="text" name="mensaje" id="mensaje">
                                                <button class="btn btn-dark">Enviar comentario</button>
                                            </form><br>
                                            <div id="errorscomment" class="alert alert-danger" style="display: none;"></div>

                                            @if ($post->from == Auth::user()->name)
                                                <br>
                                                <form action="{{ route('delete') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$post->id}}">
                                                    <button class="btn btn-danger">Borrar</button>
                                                </form>
                                            @endif
                                            <br><hr><br>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
