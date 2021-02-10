@extends('layouts.app')

@section('content')
    <div class="content px-3">
        <div class="card">
            <a href="{{url('libros')}}">Volver</a>
            <form action="{{url('librosmodificar')}}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$libro->id}}">
                <label>Nom: </label>
                <input type="text" name="nom" value="{{$libro->nom}}"><br>
                <label>Edicio: </label>
                <input type="text" name="edicio" value="{{$libro->edicio}}"><br>
                <label>Editorial: </label>
                <input type="text" name="editorial" value="{{$libro->editorial}}"><br>
                <button type="submit">Editar</button>
            </form>
        </div>
    </div>
@endsection