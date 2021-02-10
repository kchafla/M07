<div class="table-responsive bg-primary">
    <table class="table" id="videojuegos-table">
        <thead class="bg-dark text-white border-0">
            <tr>
                <th class="border-0"><h3>Nom</h3></th>
        <th class="border-0"><h3>Autor</h3></th>
        <th class="border-0"><h3>Plataforma</h3></th>
                <th colspan="3" class="border-0"><h3>Acción</h3></th>
            </tr>
        </thead>
        <tbody>
        @foreach($videojuegos as $videojuego)
            <tr>
                <td class="border-0 text-white">{{ $videojuego->nom }}</td>
            <td class="border-0 text-white">{{ $videojuego->autor }}</td>
            <td class="border-0 text-white">{{ $videojuego->plataforma }}</td>
                <td width="120" class="border-0">
                    {!! Form::open(['route' => ['videojuegos.destroy', $videojuego->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('videojuegos.show', [$videojuego->id]) }}" class='btn btn-default btn-xs border border-dark bg-success'>
                            <i class="far fa-eye">Detalles</i>
                        </a>
                        <a href="{{ route('videojuegos.edit', [$videojuego->id]) }}" class='btn btn-default btn-xs border border-dark bg-warning'>
                            <i class="far fa-edit">Editar</i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt">Eliminar</i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs border border-dark', 'onclick' => "return confirm('Estas seguro de borrar este campo?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
