<!-- Date Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('date', 'Date:',['class'=>'control-label']) !!}
        {!! Form::date('date', $logisticBill->date ?? null, ['class' => 'form-control', 'id'=>'date']) !!}
    </div>
</div>




@php
$sales = DB::table('sales_models')->get();
$customers = DB::table('customers')->get();
@endphp


<!-- Sale Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('Sale', 'Sale:',['class'=>'control-label']) !!}
        {!! Form::select('Sale', $sales->pluck('sales_id', 'id'), null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Location Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('location', 'Location:',['class'=>'control-label']) !!}
        {!! Form::text('location', null, ['class' => 'form-control','required']) !!}
    </div>
</div>


<!-- Customer Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('customer', 'Customer:',['class'=>'control-label']) !!}
        {!! Form::select('customer', $customers->pluck('customer_name', 'id'), null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Amount Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('amount', 'Amount:',['class'=>'control-label']) !!}
        {!! Form::text('amount', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Attachment Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('attachment', 'Attachment:',['class'=>'control-label']) !!}
        {!! Form::file('attachment') !!}
    </div>
</div>
 <div class="clearfix"></div>


<!-- Note Field -->
<div class="col-md-12">
    <div class="form-group ">
        {!! Form::label('note', 'Note:',['class'=>'control-label']) !!}
        {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
    </div>
</div>

@if(can('logistic_bills_approval'))
<!-- Status Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('status', 'Status:',['class'=>'control-label']) !!}
        {!! Form::select('status', ['Pending' => 'Pending', 'Approved' => 'Approved', 'Payment' => 'Payment'], null, ['class' => 'form-control']) !!}
    </div>
</div>
@endif


<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align-last: right;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('logisticBills.index') }}" class="btn btn-danger">Cancel</a>
</div>


