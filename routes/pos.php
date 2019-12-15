<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::group(['middleware' => 'auth'], function () 
{


//Receiving

Route::get('pos/invoice','pos\InvoiceController@index')->name('invoice.index');

Route::post('pos/invoice','pos\InvoiceController@store')->name('invoice.store');

Route::get('pos/invoice/list','pos\InvoiceController@indexList')->name('invoice.list');

Route::get('pos/invoice/view/{id}','pos\InvoiceController@show')->name('invoice.show');

Route::post('inventory/serverside/services' , 'pos\InvoiceController@serverside')->name('serverside.invoice.service');

Route::get('inventory/serverside/services' , 'pos\InvoiceController@populate')->name('populate.invoice.service');

//REPORTS

Route::get('pos/repots/top-selling','pos\InvoiceReportController@index')->name('index.top.selling');

Route::post('pos/repots/top-selling','pos\InvoiceReportController@generate')->name('post.index.top.selling');

Route::get('pos/repots/worst-selling','pos\InvoiceReportController@indexWorst')->name('index.worst.selling');

Route::post('pos/repots/worst-selling','pos\InvoiceReportController@generateWorst')->name('post.index.worst.selling');

Route::get('pos/repots/daily-sales','pos\SalesReportController@indexDaily')->name('index.daily.sales');

Route::post('pos/repots/daily-sales','pos\SalesReportController@generateDailySales')->name('post.daily.sales');

Route::get('pos/repots/weekly-sales','pos\SalesReportController@indexWeekly')->name('index.weekly.sales');

Route::post('pos/repots/weekly-sales','pos\SalesReportController@generateWeeklySales')->name('post.weekly.sales');

Route::get('pos/repots/monthly-sales','pos\SalesReportController@indexMonthly')->name('index.monthly.sales');

Route::post('pos/repots/monthly-sales','pos\SalesReportController@generateMonthlySales')->name('post.monthly.sales');




});