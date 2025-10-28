<?php


use App\Http\Controllers\LedgerTransactionController;
use App\Http\Controllers\LedgerReportController;

Route::prefix('ledger')->group(function () {
    Route::get('/', [LedgerTransactionController::class, 'index'])->name('ledger.index');
    Route::get('/transactions/{customer}', [LedgerTransactionController::class, 'getTransactions'])->name('ledger.transactions');
    Route::post('/transaction/store', [LedgerTransactionController::class, 'store'])->name('ledger.transaction.store');
    Route::post('/opening-balance/{customer}', [LedgerTransactionController::class, 'updateOpeningBalance'])->name('ledger.opening-balance.update');
    Route::get('/report/{customer}', [LedgerReportController::class, 'generateReport'])->name('ledger.report');
});
