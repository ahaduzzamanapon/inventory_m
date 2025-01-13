<!-- Companie Name Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('companie_name', 'Companie Name:',['class'=>'control-label']) !!}
        {!! Form::text('companie_name', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Companie Address Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('companie_address', 'Companie Address:',['class'=>'control-label']) !!}
        {!! Form::text('companie_address', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align-last: right;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('companies.index') }}" class="btn btn-danger">Cancel</a>
</div>
