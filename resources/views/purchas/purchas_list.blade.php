@extends('layouts.default')

{{-- Page title --}}
@section('title')
Purchas List @parent
@stop

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    {{--<div aria-label="breadcrumb" class="card-breadcrumb">
        <h1>Purchas List</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div>--}}
</section>

<!-- Main content -->
<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="card" width="88vw;">
        <section class="card-header">
            <h5 class="card-title d-inline">Purchas List</h5>
            <span class="float-right">
                <a class="btn btn-primary pull-right" href="{{ route('purchas.new_purchas') }}">New Purchas</a>
                <a class="btn btn-info pull-right" href="{{ route('purchas.purchas_return') }}" style="margin-right: 5px;">Purchase Return</a>
            </span>
        </section>
        <div class="card-body table-responsive" >
            @include('purchas.table')
        </div>
    </div>

</div>
@endsection
