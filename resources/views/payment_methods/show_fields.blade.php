<tr>
    <th scopre="row">{!! Form::label('id', 'Id:') !!}</th>
    <td>{{ $paymentMethod->id }}</td>
</tr>


<tr>
    <th scopre="row">{!! Form::label('method_name', 'Method Name:') !!}</th>
    <td>{{ $paymentMethod->method_name }}</td>
</tr>


<tr>
    <th scopre="row">{!! Form::label('method_type', 'Method Type:') !!}</th>
    <td>{{ $paymentMethod->method_type }}</td>
</tr>


<tr>
    <th scopre="row">{!! Form::label('method_number', 'Method Number:') !!}</th>
    <td>{{ $paymentMethod->method_number }}</td>
</tr>


<tr>
    <th scopre="row">{!! Form::label('created_at', 'Created At:') !!}</th>
    <td>{{ $paymentMethod->created_at }}</td>
</tr>


<tr>
    <th scopre="row">{!! Form::label('updated_at', 'Updated At:') !!}</th>
    <td>{{ $paymentMethod->updated_at }}</td>
</tr>


