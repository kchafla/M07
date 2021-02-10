@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Editar videojuego</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($videojuego, ['route' => ['videojuegos.update', $videojuego->id], 'method' => 'patch']) !!}

            <div class="card-body bg-primary">
                <div class="row">
                    @include('videojuegos.fields')
                </div>
            </div>

            <div class="card-footer bg-dark">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('videojuegos.index') }}" class="btn btn-default bg-primary text-white">Cancelar</a>
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection
