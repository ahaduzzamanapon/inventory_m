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
            <form action="{{ route('generate_report') }}" method="POST">
                @csrf
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
                        <label for="type">Report Type</label>
                        <select id="type" name="type" class="form-control" required>
                            <option value="">Select Report Type</option>
                            <option value="sales">Sales Report</option>
                            <option value="expenses">Expenses Report</option>
                            <option value="purchases">Purchase Report</option>
                            <option value="income">Income Report</option>
                            <option value="stock">Stock Report</option>
                            <option value="customer_due">Customer Due Report</option>
                            <option value="supplier_due">Supplier Due Report</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="company">Company / Supplier</label>
                        <select id="company" name="company" class="form-control">
                            <option value="">All</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->companie_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Generate Report</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if (isset($reportData))
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Report Details</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            @foreach ($headers as $header)
                                <th>{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reportData as $data)
                            <tr>
                                @foreach ($data as $value)
                                    <td>{{ $value }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
