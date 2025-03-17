<?php

Route::get('new_purchas', 'PurchasController@newPurchas')->name('purchas.new_purchas');
Route::get('purchas_list', 'PurchasController@purchasList')->name('purchas.purchas_list');
Route::get('purchas/delete/{id}', 'PurchasController@delete')->name('purchas.delete');
Route::get('purchas/make_payment/{id}', 'PurchasController@make_payment')->name('purchas.make_payment');
Route::get('purchas/invoice/{id}', 'PurchasController@invoice')->name('purchas.invoice');
Route::resource('purchas', 'PurchasController');
Route::post('purchas/payment/store', 'PurchasController@make_payment_store')->name('purchas.payment.store');
Route::get('approve_payment_p/{id}', 'PurchasController@approve_payment_p');


