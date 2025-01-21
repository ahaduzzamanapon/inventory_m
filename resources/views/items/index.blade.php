@extends('layouts.default')

{{-- Page title --}}
@section('title')
Items @parent
@stop

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    {{--<div aria-label="breadcrumb" class="card-breadcrumb">
        <h1>Items</h1>
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
            <h5 class="card-title d-inline">Items</h5>
            <span class="float-right">
                @if(can('add_item'))
                <a class="btn btn-primary pull-right" href="{{ route('items.create') }}">Add New</a>
                @endif
            </span>
        </section>
        <div class="card-body table-responsive" >
            @include('items.table')
        </div>
    </div>

</div>
@endsection
