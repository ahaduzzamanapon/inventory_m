<!-- Date Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('date', 'Date:',['class'=>'control-label']) !!}
        {!! Form::date('date', null, ['class' => 'form-control','id'=>'date']) !!}
    </div>
</div>



<!-- Purpose Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('purpose', 'Purpose:',['class'=>'control-label']) !!}
        {!! Form::text('purpose', null, ['class' => 'form-control']) !!}
    </div>
</div>


@php
    $users = \App\Models\User::pluck('name','id');
@endphp

<!-- Employee Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('employee', 'Employee:',['class'=>'control-label']) !!}
        {!! Form::select('employee', $users, null, ['class' => 'form-control']) !!}
    </div>
</div>

@php
    $customers = \App\Models\Customer::pluck('customer_name','id')->prepend('Not applicable', 'Not_applicable');
@endphp

<!-- Customer Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('customer', 'Customer:',['class'=>'control-label']) !!}
        {!! Form::select('customer', $customers, null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Amount Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('amount', 'Amount:',['class'=>'control-label']) !!}
        {!! Form::number('amount', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Note Field -->
<div class="col-md-12">
    <div class="form-group ">
        {!! Form::label('note', 'Note:',['class'=>'control-label']) !!}
        {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align-last: right;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('comissions.index') }}" class="btn btn-danger">Cancel</a>
</div>
