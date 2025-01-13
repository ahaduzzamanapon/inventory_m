<!-- Brandname Field -->
<div class="col-md-12">
    <div class="form-group">
        {!! Form::label('BrandName', 'Brand name:',['class'=>'control-label']) !!}
        {!! Form::text('BrandName', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align-last: right;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('brands.index') }}" class="btn btn-danger">Cancel</a>
</div>
