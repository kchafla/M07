@extends('layouts.app')

@section('content')
    <div class="content px-3">
        <div class="card">
            <a href="{{url('libros')}}">Volver</a>
            <form action="{{url('librosguardar')}}" method="post">
                @csrf
                <label>Nom: </label>
                <input type="text" name="nom"><br>
                <label>Edicio: </label>
                <input type="text" name="edicio"><br>
                <label>Editorial: </label>
                <input type="text" name="editorial"><br>
                <button type="submit">Crear</button>
            </form>
        </div>
    </div>
@endsection