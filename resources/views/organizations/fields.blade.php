<!-- Name Field -->
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
    </div>
</div>

<!-- Description Field -->
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
    </div>
</div>

<!-- Opening Balance Field -->
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('opening_balance', 'Opening Balance:', ['class' => 'control-label']) !!}
        {!! Form::number('opening_balance', null, ['class' => 'form-control', 'step' => '0.01']) !!}
    </div>
</div>

<!-- Customers Field -->
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('customer_ids', 'Connect Customers:', ['class' => 'control-label']) !!}
        {!! Form::select('customer_ids[]', $customers ?? [], $selected_customers ?? [], ['class' => 'form-control chosen-select', 'multiple' => 'multiple', 'data-placeholder' => 'Select Customers']) !!}
    </div>
</div>

<!-- Suppliers Field -->
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('supplier_ids', 'Connect Suppliers:', ['class' => 'control-label']) !!}
        {!! Form::select('supplier_ids[]', $suppliers ?? [], $selected_suppliers ?? [], ['class' => 'form-control chosen-select', 'multiple' => 'multiple', 'data-placeholder' => 'Select Suppliers']) !!}
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align-last: right;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('organizations.index') }}" class="btn btn-danger">Cancel</a>
</div>