@extends('layouts.default')

@section('title')
Organizations @parent
@stop

@section('content')
    <section class="content-header">
    </section>

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="card" width="88vw;">
            <section class="card-header">
                <h5 class="card-title d-inline">Organizations</h5>
                <span class="float-right">
                    <a class="btn btn-primary pull-right" href="{{ route('organizations.create') }}">Add New</a>
                </span>
            </section>
            <div class="card-body table-responsive">
                @include('organizations.table')
            </div>
        </div>

    </div>
@endsection