@php
    $users = \App\Models\User::pluck('name','id');
@endphp

<!-- User Id Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('user_id', 'Employee:',['class'=>'control-label']) !!}
        {!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Month Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('month', 'Month:',['class'=>'control-label']) !!}
        {!! Form::month('month', null, ['class' => 'form-control','id'=>'month']) !!}
    </div>
</div>
<!-- Month Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('amount', 'Amount:',['class'=>'control-label']) !!}
        {!! Form::number('amount', null, ['class' => 'form-control','id'=>'amount']) !!}
    </div>
</div>



<!-- Reason Field -->
<div class="col-md-12">
    <div class="form-group ">
        {!! Form::label('reason', 'Reason:',['class'=>'control-label']) !!}
        {!! Form::textarea('reason', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align-last: right;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('bonuses.index') }}" class="btn btn-danger">Cancel</a>
</div>
