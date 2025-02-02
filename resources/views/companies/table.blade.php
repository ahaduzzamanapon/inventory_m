<div class="table-responsive">
    <table class="table" id="companies-table">
        <thead>
            <tr>
                <th>Id</th>
        <th>Companie Name</th>
        <th>Companie Address</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($companies as $key => $companie)
            <tr>
                <td>{{ $companie->id }}</td>
            <td>{{ $companie->companie_name }}</td>
            <td>{{ $companie->companie_address }}</td>

                <td>
                    <div class='btn-group'>
                        <a href="{{ route('companies.show', [$companie->id]) }}" class='btn btn-outline-primary btn-xs'><i class="im im-icon-Eye" data-placement="top" title="View"></i></a>
                        <a href="{{ route('companies.edit', [$companie->id]) }}" class='btn btn-outline-primary btn-xs'><i
                            class="im im-icon-Pen"  data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                        @if(can('delete_option'))
                            {!! Form::open(['route' => ['companies.destroy', $companie->id], 'method' => 'delete']) !!}
                            {!! Form::button('<i class="im im-icon-Remove" data-toggle="tooltip" data-placement="top" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-outline-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
