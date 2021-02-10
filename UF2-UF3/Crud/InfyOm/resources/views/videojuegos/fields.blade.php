<!-- Nom Field -->
<div class="form-group col-sm-6">
    <h3 class="text-white">{!! Form::label('nom', 'Nom:') !!}</h3>
    {!! Form::text('nom', null, ['class' => 'form-control','maxlength' => 200,'maxlength' => 200]) !!}
</div>

<!-- Autor Field -->
<div class="form-group col-sm-6">
    <h3 class="text-white">{!! Form::label('autor', 'Autor:') !!}</h3>
    {!! Form::text('autor', null, ['class' => 'form-control','maxlength' => 200,'maxlength' => 200]) !!}
</div>

<!-- Plataforma Field -->
<div class="form-group col-sm-6">
    <h3 class="text-white">{!! Form::label('plataforma', 'Plataforma:') !!}</h3>
    {!! Form::text('plataforma', null, ['class' => 'form-control','maxlength' => 200,'maxlength' => 200]) !!}
</div>