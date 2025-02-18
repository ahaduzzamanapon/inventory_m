<div class="table-responsive">
    <table class="table" id="comissions-table">
        <thead>
            <tr>
                <th>Id</th>
        <th>Date</th>
        <th>Purpose</th>
        <th>Employee</th>
        <th>Customer</th>
        <th>Amount</th>
        <th>Note</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($comissions as $key => $comission)
            <tr>
                <td>{{ $key+1 }}</td>
            <td>{{ $comission->date }}</td>
            <td>{{ $comission->purpose }}</td>
            <td>{{ $comission->employee_name }}</td>
            <td>{{ $comission->customer_name }}</td>
            <td>{{ $comission->amount }}</td>
            <td>{{ $comission->note }}</td>

                <td>
                    {!! Form::open(['route' => ['comissions.destroy', $comission->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('comissions.show', [$comission->id]) }}" class='btn btn-outline-primary btn-xs'><i class="im im-icon-Eye" data-placement="top" title="View"></i></a>
                        <a href="{{ route('comissions.edit', [$comission->id]) }}" class='btn btn-outline-primary btn-xs'><i
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
