@extends('layouts.app')

@section('content')
    <div class="content px-3">
        <div class="card">
            <a href="{{url('libroscreate')}}">Nuevo</a>

            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>NOM</th>
                    <th>EDICIO</th>
                    <th>EDITORIAL</th>
                    <th colspan="2">ACCION</th>
                </tr>
                @foreach ($libros as $libro)
                    <tr>
                        <td>{{$libro->id}}</td>
                        <td>{{$libro->nom}}</td>
                        <td>{{$libro->edicio}}</td>
                        <td>{{$libro->editorial}}</td>
                        <td><a href="{{url('libroseditar')}}/{{$libro->id}}">EDITAR</a></td>
                        <td><a href="{{url('librosborrar')}}/{{$libro->id}}">BORRAR</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
