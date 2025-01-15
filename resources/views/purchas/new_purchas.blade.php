@extends('layouts.default')

{{-- Page title --}}
@section('title')
New Purchas @parent
@stop

@section('content')
    <section class="content-header">
    {{--<div aria-label="breadcrumb" class="card-breadcrumb">
        <h1>{{ __('Create New') }} Purchas</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div>--}}
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'purchas.store', 'files' => true,'class' => 'form-horizontal']) !!}
                    @include('purchas.fields_new')
                    <!-- Submit Field -->
                    <div class="form-group col-sm-12" style="text-align-last: right;">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('subCategories.index') }}" class="btn btn-danger">Cancel</a>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>



@endsection
