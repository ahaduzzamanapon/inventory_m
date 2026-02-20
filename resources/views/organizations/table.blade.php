<div class="table-responsive">
    <table class="table data_t" id="organizations-table">
        <thead>
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Description</th>
                <th>Opening Balance</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($organizations as $key => $organization)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $organization->name }}</td>
                    <td>{{ $organization->description }}</td>
                    <td>{{ number_format($organization->opening_balance, 2) }}</td>
                    <td>
                        <div class='btn-group'>
                            <a href="{{ route('organizations.edit', [$organization->id]) }}"
                                class='btn btn-outline-primary btn-xs'><i class="im im-icon-Pen" data-toggle="tooltip"
                                    data-placement="top" title="Edit"></i></a>
                            {!! Form::open(['route' => ['organizations.destroy', $organization->id], 'method' => 'delete']) !!}
                            {!! Form::button('<i class="im im-icon-Remove" data-toggle="tooltip" data-placement="top" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-outline-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>