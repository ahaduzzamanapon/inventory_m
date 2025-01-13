@extends('layouts.default')

{{-- Page title --}}
@section('title')
Category @parent
@stop

@section('content')
    <section class="content-header">
    <div aria-label="breadcrumb" class="card-breadcrumb">
        <h1>{{ __('Create New') }} Category</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    {!! Form::open(['route' => 'categories.store','class' => 'form-horizontal col-md-12']) !!}
                    <div class="row">
                        @include('categories.fields')
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
