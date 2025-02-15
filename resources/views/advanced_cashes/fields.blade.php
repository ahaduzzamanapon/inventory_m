


@php
    $users = DB::table('users')->get();
@endphp


<!-- Member Id Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('member_id', 'Select Member:',['class'=>'control-label']) !!}
        {!! Form::select('member_id', $users->pluck('name', 'id')->prepend('Select Member', ''), null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Purpose Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('purpose', 'Purpose:',['class'=>'control-label']) !!}
        {!! Form::text('purpose', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Amount Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('amount', 'Amount:',['class'=>'control-label']) !!}
        {!! Form::number('amount', null, ['class' => 'form-control']) !!}
    </div>
</div>

@if(can('advanced_cash_approval'))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('status', 'Status:',['class'=>'control-label']) !!}
        {!! Form::select('status', ['Pending' => 'Pending', 'Approved' => 'Approved', 'Payment' => 'Payment'], null, ['class' => 'form-control']) !!}
    </div>
</div>
@else
<div class="col-md-3 d-none">
    <div class="form-group">
        {!! Form::label('status', 'Status:',['class'=>'control-label']) !!}
        {!! Form::select('status', ['Pending' => 'Pending', 'Approved' => 'Approved', 'Payment' => 'Payment'], null, ['class' => 'form-control']) !!}
    </div>
</div>
@endif


@if(can('advanced_cash_approval'))
<!-- Status Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('settled_amount', 'Settled Amount:',['class'=>'control-label']) !!}
        {!! Form::number('settled_amount', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('settled_status', 'Settled Status:',['class'=>'control-label']) !!}
        {!! Form::select('settled_status', ['Pending' => 'Pending', 'Settled' => 'Settled'], null, ['class' => 'form-control']) !!}
    </div>
</div>
@else
<div class="col-md-3 d-none">
    <div class="form-group">
        {!! Form::label('settled_amount', 'Settled Amount:',['class'=>'control-label']) !!}
        {!! Form::number('settled_amount', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-md-3 d-none">
    <div class="form-group">
        {!! Form::label('settled_status', 'Settled Status:',['class'=>'control-label']) !!}
        {!! Form::select('settled_status', ['Pending' => 'Pending', 'Settled' => 'Settled'], null, ['class' => 'form-control']) !!}
    </div>
</div>
@endif


<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align-last: right;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('advancedCashes.index') }}" class="btn btn-danger">Cancel</a>
</div>
