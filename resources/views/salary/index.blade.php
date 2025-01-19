@extends('layouts.default')

{{-- Page title --}}
@section('title')
    Salary @parent
@stop

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        {{-- <div aria-label="breadcrumb" class="card-breadcrumb">
        <h1>Locations</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div> --}}
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
            <div class="card-body table-responsive">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="from-group">
                                        <label for="name">Month</label>
                                        <input type="Month" name="process_month" id="process_month" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6" style="display: flex;flex-direction: column;">
                                    <label for="" style="color: transparent">.</label>
                                    <a class="btn btn-primary" onclick="process()">Process</a>
                                </div>
                                <div class="col-md-12 mt-12">
                                    Report
                                    <div class="row" style="border-top: 1px solid black;padding-top: 8px;">
                                        <a class="btn btn-primary" onclick="get_salary()">Get Salary</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <table class="table table-light table-hover table-bordered table-striped col-md-12">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" name="select_all" id="select_all">
                                            </th>
                                            <th>SL</th>
                                            <th>Name/ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <td><input type="checkbox" name="user_id" class="user_id_select"
                                                        value="{{ $user->id }}"></td>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $user->name . ' ' . $user->last_name . ' (' . $user->emp_id . ')' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@section('footer_scripts')
    <script>
        $(document).ready(function() {
            $('#select_all').click(function() {
                if (this.checked) {
                    $('.user_id_select').each(function() {
                        this.checked = true;
                    });
                } else {
                    $('.user_id_select').each(function() {
                        this.checked = false;
                    });
                }
            });
        })
        function process() {
            var process_month = $('#process_month').val();
            if (process_month == '') {
                alert('Please select month');
                return;
            }
            var user_id = [];
            $('.user_id_select').each(function() {
                if (this.checked) {
                    user_id.push(this.value);
                }
            });
            if (user_id.length == 0) {
                alert('Please select user');
                return;
            }
            $.ajax({
                type: 'POST',
                url: '{{ route('salary.process') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    process_month: process_month,
                    user_id: user_id
                },
                success: function(data) {
                    if (data.status == true) {
                        alert('Successfully processed');
                    } else {
                        alert('Something went wrong');
                    }
                },
                error: function(data) {
                    alert('Something went wrong');
                }
            });
        }
    </script>
    <script>
        function get_salary() {
            var process_month = $('#process_month').val();
            if (process_month == '') {
                alert('Please select month');
                return;
            }

            var user_id = [];
            $('.user_id_select').each(function() {
                if (this.checked) {
                    user_id.push(this.value);
                }
            });
            if (user_id.length == 0) {
                alert('Please select user');
                return;
            }
            user_id = user_id.join(',');

            window.open('{{ route('salary.get_salary') }}?' + $.param({process_month: process_month, user_id: user_id}), '_blank');
        }
    </script>
@endsection







@endsection
