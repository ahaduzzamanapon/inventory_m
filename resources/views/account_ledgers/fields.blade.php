<!-- Name Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('name', 'Name:',['class'=>'control-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Type Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('type', 'Type:',['class'=>'control-label']) !!}
        {!! Form::select('type', ['Debit' => 'Debit', 'Credit' => 'Credit'], null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align-last: right;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('accountLedgers.index') }}" class="btn btn-danger">Cancel</a>
</div>
