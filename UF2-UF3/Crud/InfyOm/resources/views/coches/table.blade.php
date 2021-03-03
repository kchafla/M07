<div class="table-responsive">
    <table class="table" id="coches-table">
        <thead>
            <tr>
                <th>Id</th>
        <th>Nombre</th>
        <th>Marca</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($coches as $coche)
            <tr>
                <td>{{ $coche->id }}</td>
            <td>{{ $coche->nombre }}</td>
            <td>{{ $coche->marca }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['coches.destroy', $coche->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('coches.show', [$coche->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('coches.edit', [$coche->id]) }}" class='btn btn-default btn-xs'>
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
