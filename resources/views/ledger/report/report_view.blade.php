<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ledger Report - {{ $party->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 30px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table th, table td {
            vertical-align: middle !important;
        }
        .table thead {
            background-color: #0d6efd;
            color: white;
        }
        @media print {
            body {
                background: #fff;
                padding: 0;
            }
            .no-print {
                display: none !important;
            }
            .card {
                box-shadow: none;
                border: none;
            }
            .table thead {
                background-color: #ccc !important;
                color: #000 !important;
            }
        }
    </style>
</head>
<body>

    <section class="content-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h4 text-primary">Ledger Report for {{ $party->name }}</h1>
            <button class="btn btn-primary no-print" onclick="window.print()">
                <i class="bi bi-printer"></i> Print
            </button>
        </div>
    </section>

    <div class="card">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $party->name }}</h5>
            @if($party->image)
                <img src="{{ asset( $party->image) }}" 
                     alt="Party Image" 
                     class="img-thumbnail" 
                     style="width: 100px; height: auto;">
            @endif
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p class="mb-1"><strong>Email:</strong> {{ $party->email ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Phone:</strong> {{ $party->phone ?? 'N/A' }}</p>
                    <p class="mb-0"><strong>Address:</strong> 
                        {{ $party->address ?? '' }} 
                        {{ $party->city ? ', ' . $party->city : '' }}
                        {{ $party->state ? ', ' . $party->state : '' }}
                        {{ $party->zip ? '- ' . $party->zip : '' }}
                    </p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <p class="mb-1"><strong>Report Date:</strong> {{ now()->format('Y-m-d') }}</p>
                    <p class="mb-0"><strong>Opening Balance:</strong> 
                        {{ number_format($party->opening_balance, 2) }}
                    </p>
                </div>
            </div>

            <hr>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 120px;">Date</th>
                            <th>Description</th>
                            <th style="width: 140px;">Bill Amount</th>
                            <th style="width: 140px;">Paid Amount</th>
                            <th style="width: 140px;">Discount</th>
                            <th style="width: 140px;">Inv. Due</th>
                            <th style="width: 140px;">Returned</th>
                            <th style="width: 140px;">Paid to customer</th>
                            <th style="width: 140px;">Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="fw-bold bg-light">
                            <td colspan="4" class="text-end">Opening Balance</td>
                            <td class="text-end">{{ number_format($party->opening_balance, 2) }}</td>
                        </tr>

                        @foreach($transactions as $transaction)
                            <tr>
                                <td class="text-center">{{ \Carbon\Carbon::parse($transaction->date)->format('Y-m-d') }}</td>
                                <td>{{ $transaction->description }}</td>
                                <td class="text-end">{{ number_format($transaction->bill_amount, 2) }}</td>
                                <td class="text-end">{{ number_format($transaction->paid_amount, 2) }}</td>
                                <td class="text-end">{{ number_format($transaction->discount, 2) }}</td>
                                <td class="text-end">{{ number_format($transaction->invoice_due, 2) }}</td>
                                <td class="text-end">{{ number_format($transaction->returned_amount, 2) }}</td>
                                <td class="text-end">{{ number_format(0, 2) }}</td>
                                <td class="text-end">{{ number_format($transaction->balance, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="fw-bold table-secondary">
                            <td colspan="4" class="text-end">Final Balance</td>
                            <td class="text-end">
                                {{ number_format($transactions->last()->balance ?? $party->opening_balance, 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
