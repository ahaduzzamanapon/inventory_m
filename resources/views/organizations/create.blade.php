@extends('layouts.default')

@section('title')
Organization @parent
@stop

@section('content')
    <section class="content-header">
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    {!! Form::open(['route' => 'organizations.store', 'class' => 'form-horizontal col-md-12']) !!}
                    <div class="row">
                        @include('organizations.fields')
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection