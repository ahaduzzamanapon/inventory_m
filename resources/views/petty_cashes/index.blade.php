@extends('layouts.default')

{{-- Page title --}}
@section('title')
Petty Cash @parent
@stop

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div aria-label="breadcrumb" class="card-breadcrumb">
        <h1>Petty Cash</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div>
</section>

<!-- Main content -->
<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="card" width="88vw;">
        <section class="card-header">
            <h5 class="card-title d-inline">Petty Cash</h5>
            <span class="float-right">
                <a class="btn btn-primary pull-right" href="{{ route('pettyCashes.create') }}">Add New</a>
            </span>
        </section>
        <div class="card-body table-responsive" style="width: 70vw;">
            @include('petty_cashes.table')
        </div>
    </div>
    <div class="text-center">

        @include('adminlte-templates::common.paginate', ['records' => $pettyCashes])

    </div>
</div>
@endsection
