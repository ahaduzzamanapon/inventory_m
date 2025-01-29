<!-- Method Name Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('method_name', 'Method Name:',['class'=>'control-label']) !!}
        {!! Form::text('method_name', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Method Type Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('method_type', 'Method Type:',['class'=>'control-label']) !!}
        {!! Form::select('method_type', ['Cash' => 'Cash', 'Bank' => 'Bank', 'Card' => 'Card', 'Cheque' => 'Cheque'], null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Method Number Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('method_number', 'Method Number:',['class'=>'control-label']) !!}
        {!! Form::text('method_number', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align-last: right;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('paymentMethods.index') }}" class="btn btn-danger">Cancel</a>
</div>
