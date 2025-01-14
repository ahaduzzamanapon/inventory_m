<?php

Route::get('new_sales', 'SalesController@newSales')->name('sales.new_sales');
Route::get('new_sales/store', 'SalesController@new_sales_store')->name('sales.store');
