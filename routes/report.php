<?php

//sales
Route::get('sales_report_page', 'ReportController@sales_report_page')->name('reports.sales_report_page');
Route::post('sales_report', 'ReportController@sales_report')->name('reports.sales_report');

//purchase
Route::get('purchase_report_page', 'ReportController@purchase_report_page')->name('reports.purchase_report_page');
Route::post('purchase_report', 'ReportController@purchase_report')->name('reports.purchase_report');

//account_report_page
Route::get('account_report_page', 'ReportController@account_report_page')->name('reports.account_report_page');
Route::get('account_report', 'ReportController@account_report')->name('reports.account_report');