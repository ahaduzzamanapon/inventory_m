<tr>
    <th scopre="row">{!! Form::label('id', 'Id:') !!}</th>
    <td>{{ $customer->id }}</td>
</tr>


<tr>
    <th scopre="row">{!! Form::label('customer_name', 'Customer Name:') !!}</th>
    <td>{{ $customer->customer_name }}</td>
</tr>


<tr>
    <th scopre="row">{!! Form::label('customer_email', 'Customer Email:') !!}</th>
    <td>{{ $customer->customer_email }}</td>
</tr>


<tr>
    <th scopre="row">{!! Form::label('customer_phone', 'Customer Phone:') !!}</th>
    <td>{{ $customer->customer_phone }}</td>
</tr>


<tr>
    <th scopre="row">{!! Form::label('customer_address', 'Customer Address:') !!}</th>
    <td>{{ $customer->customer_address }}</td>
</tr>


<tr>
    <th scopre="row">{!! Form::label('created_at', 'Created At:') !!}</th>
    <td>{{ $customer->created_at }}</td>
</tr>


<tr>
    <th scopre="row">{!! Form::label('updated_at', 'Updated At:') !!}</th>
    <td>{{ $customer->updated_at }}</td>
</tr>


