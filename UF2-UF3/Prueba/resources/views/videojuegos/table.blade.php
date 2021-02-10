<div class="table-responsive">
    <table class="table" id="videojuegos-table">
        <thead>
            <tr>
                <th>Nom</th>
        <th>Dissenyador</th>
        <th>Plataforma</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($videojuegos as $videojuego)
            <tr>
                <td>{{ $videojuego->nom }}</td>
            <td>{{ $videojuego->dissenyador }}</td>
            <td>{{ $videojuego->plataforma }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['videojuegos.destroy', $videojuego->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('videojuegos.show', [$videojuego->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('videojuegos.edit', [$videojuego->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
