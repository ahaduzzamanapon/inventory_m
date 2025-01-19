<?php

Route::get('salary', 'SalaryController@index')->name('salary');
Route::post('salary/process', 'SalaryController@process')->name('salary.process');
Route::get('get_salary', 'SalaryController@get_salary')->name('salary.get_salary');




