<div class="table-responsive">
    <table class="table data_t" id="suppliers-table">
        <thead>
            <tr>
                <th>SL</th>
                <th>Supplier Name</th>
                <th>Supplier Email</th>
                <th>Supplier Phone</th>
                <th>Supplier Address</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($suppliers as $key => $supplier)
            <tr>
                <td>{{ $key + 1 }}</td>
            <td>{{ $supplier->supplier_name }}</td>
            <td>{{ $supplier->supplier_email }}</td>
            <td>{{ $supplier->supplier_phone }}</td>
            <td>{{ $supplier->supplier_address }}</td>

                <td>
                    <div class='btn-group'>
                        <a href="{{ route('suppliers.show', [$supplier->id]) }}" class='btn btn-outline-primary btn-xs'><i class="im im-icon-Eye" data-placement="top" title="View"></i></a>
                        <a href="{{ route('suppliers.edit', [$supplier->id]) }}" class='btn btn-outline-primary btn-xs'><i
                            class="im im-icon-Pen"  data-toggle="tooltip" data-placement="top" title="Edit"></i></a>

                            @if(can('delete_option'))
                                {!! Form::open(['route' => ['suppliers.destroy', $supplier->id], 'method' => 'delete']) !!}
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
