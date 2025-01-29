<?php
    $categories = DB::table('categorys')->get();
?>

<!-- Category Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('Category', 'Category:',['class'=>'control-label']) !!}
        {!! Form::select('Category', $categories->pluck('Name','id'), null, ['class' => 'form-control select2']) !!}
    </div>
</div>

<!-- Subcategoryname Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('SubCategoryName', 'Subcategoryname:',['class'=>'control-label']) !!}
        {!! Form::text('SubCategoryName', null, ['class' => 'form-control']) !!}
    </div>
</div>




<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align-last: right;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('subCategories.index') }}" class="btn btn-danger">Cancel</a>
</div>
