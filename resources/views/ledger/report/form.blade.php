@extends('layouts.default')

@section('title', 'Ledger Report')

@section('content')
<section class="content-header">
    <h1>Ledger Report</h1>
</section>

<div class="content">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('ledger.report.generate') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="party_id">Party</label>
                    <select name="party_id" class="form-control" required>
                        @foreach($parties as $party)
                            <option value="{{ $party->id }}">{{ $party->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="from_date">From Date</label>
                    <input type="date" name="from_date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="to_date">To Date</label>
                    <input type="date" name="to_date" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Generate Report</button>
            </form>
        </div>
    </div>
</div>
@endsection