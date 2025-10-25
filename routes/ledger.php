<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\LedgerTransactionController;
use App\Http\Controllers\LedgerReportController;

Route::prefix('ledger')->group(function () {
    Route::resource('parties', PartyController::class);
    Route::resource('transactions', LedgerTransactionController::class);
    Route::get('report', [LedgerReportController::class, 'showReportForm'])->name('ledger.report.form');
    Route::post('report', [LedgerReportController::class, 'generateReport'])->name('ledger.report.generate');
    Route::get('parties/{party}/report', [LedgerReportController::class, 'generatePartyReport'])->name('ledger.party.report');
});
