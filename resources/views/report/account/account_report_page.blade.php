@extends('layouts.default')

@section('title', 'Reports')

@section('content')
<section class="content-header">
    <h1>Generate Reports</h1>
</section>

<div class="content">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Filter Reports</h5>
        </div>
        <div class="card-body">
            
                <div class="row">
                    <div class="col-md-3">
                        <label for="from_date">From Date</label>
                        <input type="date" id="from_date" name="from_date" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="to_date">To Date</label>
                        <input type="date" id="to_date" name="to_date" class="form-control" required>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="company">User</label>
                        <select id="user_id" name="user_id" class="form-control">
                            <option value="">Select user</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="company">Report Type</label>
                        <select id="report_type" name="report_type" class="form-control">
                            <option value="">Select report type</option>
                            <option value="petty_cash">Petty Cash</option>
                            <option value="advance_cash">Advance Cash</option>
                            <option value="logistics_bill">Logistics Bill</option>
                            <option value="salary">Salary</option>
                            <option value="bonuses">Bonuses</option>
                            <option value="commission">Commission</option>
                        </select>
                    </div>
                    
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <button type="submit" id="generate-report" class="btn btn-primary">Generate Report</button>
                    </div>
                </div>
        </div>
    </div>
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Report Details</h5>
                <a onclick="printReport()" class="btn btn-primary" style="float: right;">Print</a>
            </div>
            <div class="card-body" id="report-view">
            </div>
        </div>
</div>
    @section('scripts')
        <script>
            $(document).ready(function () {
                $('#generate-report').on('click', function (e) {
                    e.preventDefault();
                    var from_date = $('#from_date').val();
                    var to_date = $('#to_date').val();
                    var user_id = $('#user_id').val();
                    var report_type = $('#report_type').val();
                    if(report_type == ''){
                        alert('Please select report type');
                        return;
                    }
                    $.ajax({
                        url: "{{ route('reports.account_report') }}",
                        method: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            from_date: from_date,
                            to_date: to_date,
                            user_id: user_id,
                            report_type: report_type
                        },
                        success: function (response) {
                            $('#report-view').html(response);
                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                        }
                    });
                });
            });
        </script>
        <script>
            function printReport() {
                var printContents = document.getElementById('report-view').innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        </script>
    @endsection
@endsection
