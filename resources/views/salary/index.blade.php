@extends('layouts.default')

{{-- Page title --}}
@section('title')
Salary @parent
@stop

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    {{--<div aria-label="breadcrumb" class="card-breadcrumb">
        <h1>Locations</h1>
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
            <h5 class="card-title d-inline">Salary</h5>
        </section>
        <div class="card-body table-responsive" >
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="from-group">
                        <label for="name">Month</label>
                        <input type="Month" name="process_month" id="process_month" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-6">
                    <div class="col-md-12">
                        <table>
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>SL</th>
                                    <th>Name/ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                <tr>
                                    <td><input type="checkbox" name="user_id" value="{{$user->id}}"></td>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->name.' '.$user->last_name.' ('.$user->emp_id.')' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="text-center">

        @include('adminlte-templates::common.paginate', ['records' => $locations])

    </div>
</div>
@endsection
