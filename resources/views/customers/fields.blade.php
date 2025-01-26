<!-- Customer Name Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('customer_name', 'Customer Name:',['class'=>'control-label']) !!}
        {!! Form::text('customer_name', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Customer Email Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('customer_email', 'Customer Email:',['class'=>'control-label']) !!}
        {!! Form::email('customer_email', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Customer Phone Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('customer_phone', 'Customer Phone:',['class'=>'control-label']) !!}
        {!! Form::text('customer_phone', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Customer Address Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('customer_address', 'Customer Address:',['class'=>'control-label']) !!}
        {!! Form::text('customer_address', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('owner_name', 'Owner Name:',['class'=>'control-label']) !!}
        {!! Form::text('owner_name', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align-last: right;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('customers.index') }}" class="btn btn-danger">Cancel</a>
</div>
