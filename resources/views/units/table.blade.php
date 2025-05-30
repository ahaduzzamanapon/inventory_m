<div class="table-responsive">
    <table class="table data_t" id="units-table">
        <thead>
            <tr>
                <th>Id</th>
        <th>Unit Name</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($units as $key => $unit)
            <tr>
                <td>{{ $unit->id }}</td>
            <td>{{ $unit->Unit_Name }}</td>

                <td>
                    <div class='btn-group'>
                        <a href="{{ route('units.show', [$unit->id]) }}" class='btn btn-outline-primary btn-xs'><i class="im im-icon-Eye" data-placement="top" title="View"></i></a>
                        <a href="{{ route('units.edit', [$unit->id]) }}" class='btn btn-outline-primary btn-xs'><i
                            class="im im-icon-Pen"  data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                        @if(can('delete_option'))
                            {!! Form::open(['route' => ['units.destroy', $unit->id], 'method' => 'delete']) !!}
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
