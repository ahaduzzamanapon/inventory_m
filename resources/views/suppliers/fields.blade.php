<!-- Supplier Name Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('supplier_name', 'Supplier Name:',['class'=>'control-label']) !!}
        {!! Form::text('supplier_name', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Supplier Email Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('supplier_email', 'Supplier Email:',['class'=>'control-label']) !!}
        {!! Form::email('supplier_email', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Supplier Phone Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('supplier_phone', 'Supplier Phone:',['class'=>'control-label']) !!}
        {!! Form::text('supplier_phone', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Supplier Address Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('supplier_address', 'Supplier Address:',['class'=>'control-label']) !!}
        {!! Form::text('supplier_address', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align-last: right;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('suppliers.index') }}" class="btn btn-danger">Cancel</a>
</div>
