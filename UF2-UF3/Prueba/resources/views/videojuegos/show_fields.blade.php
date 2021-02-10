<!-- Nom Field -->
<div class="col-sm-12">
    {!! Form::label('nom', 'Nom:') !!}
    <p>{{ $videojuego->nom }}</p>
</div>

<!-- Dissenyador Field -->
<div class="col-sm-12">
    {!! Form::label('dissenyador', 'Dissenyador:') !!}
    <p>{{ $videojuego->dissenyador }}</p>
</div>

<!-- Plataforma Field -->
<div class="col-sm-12">
    {!! Form::label('plataforma', 'Plataforma:') !!}
    <p>{{ $videojuego->plataforma }}</p>
</div>

