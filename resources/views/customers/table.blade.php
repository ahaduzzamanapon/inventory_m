<div class="table-responsive">
    <table class="table data_t" id="customers-table">
        <thead>
            <tr>
                <th>SL</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Owner</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($customers as $key => $customer)
            <tr>
                <td>{{ $key + 1 }}</td>
            <td>{{ $customer->customer_name }}</td>
            <td>{{ $customer->customer_email }}</td>
            <td>{{ $customer->customer_phone }}</td>
            <td>{{ $customer->customer_address }}</td>
            <td>{{ $customer->owner_name }}</td>
                <td>
                    <div class='btn-group'>
                        <a href="{{ route('customers.show', [$customer->id]) }}" class='btn btn-outline-primary btn-xs'><i class="im im-icon-Eye" data-placement="top" title="View"></i></a>
                        <a href="{{ route('customers.edit', [$customer->id]) }}" class='btn btn-outline-primary btn-xs'><i
                            class="im im-icon-Pen"  data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                            @if(can('delete_option'))
                                {!! Form::open(['route' => ['customers.destroy', $customer->id], 'method' => 'delete']) !!}
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
