<!-- Nom Field -->
<div class="col-sm-12">
    <h3 class="text-white">{!! Form::label('nom', 'Nom:') !!}</h3>
    <h5 class="text-white">{{ $videojuego->nom }}</h5>
</div>
<span>&nbsp;</span>
<!-- Autor Field -->
<div class="col-sm-12">
    <h3 class="text-white">{!! Form::label('autor', 'Autor:') !!}</h3>
    <h5 class="text-white">{{ $videojuego->autor }}</h5>
</div>
<span>&nbsp;</span>
<!-- Plataforma Field -->
<div class="col-sm-12">
    <h3 class="text-white">{!! Form::label('plataforma', 'Plataforma:') !!}</h3>
    <h5 class="text-white">{{ $videojuego->plataforma }}</h5>
</div>
