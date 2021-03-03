<div class="table-responsive">
    <table class="table" id="mangas-table">
        <thead>
            <tr>
                <th>Nom</th>
        <th>Editorial</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($mangas as $manga)
            <tr>
                <td>{{ $manga->nom }}</td>
            <td>{{ $manga->editorial }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['mangas.destroy', $manga->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('mangas.show', [$manga->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('mangas.edit', [$manga->id]) }}" class='btn btn-default btn-xs'>
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
