@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Editar Manga</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($manga, ['route' => ['mangas.update', $manga->id], 'method' => 'patch']) !!}

            <div class="card-body bg-primary">
                <div class="row">
                    @include('mangas.fields')
                </div>
            </div>

            <div class="card-footer bg-dark">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('mangas.index') }}" class="btn btn-default bg-primary text-white">Cancel</a>
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection
