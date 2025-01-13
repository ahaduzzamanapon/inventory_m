<div class="table-responsive">
    <table class="table" id="locations-table">
        <thead>
            <tr>
                <th>SL</th>
        <th>Location Name</th>
        <th>Location Address</th>
        <th>Created At</th>
        <th>Updated At</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($locations as $key => $location)
            <tr>
                <td>{{ $key + 1 }}</td>
            <td>{{ $location->location_name }}</td>
            <td>{{ $location->location_address }}</td>
            <td>{{ $location->created_at }}</td>
            <td>{{ $location->updated_at }}</td>
                <td>
                    {!! Form::open(['route' => ['locations.destroy', $location->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('locations.show', [$location->id]) }}" class='btn btn-outline-primary btn-xs'><i class="im im-icon-Eye" data-placement="top" title="View"></i></a>
                        <a href="{{ route('locations.edit', [$location->id]) }}" class='btn btn-outline-primary btn-xs'><i
                                class="im im-icon-Pen"  data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                        {!! Form::button('<i class="im im-icon-Remove" data-toggle="tooltip" data-placement="top" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-outline-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
