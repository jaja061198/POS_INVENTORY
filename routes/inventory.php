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

Route::get('inventory/receiving','inventory\ReceivingController@index')->name('receiving.index');

Route::post('inventory/serverside/receiving' , 'inventory\ReceivingController@serverside')->name('serverside.receiving');

Route::get('inventory/populate/item-code','inventory\ReceivingController@populate')->name('populate.item');

Route::post('inventory/receiving/receive','inventory\ReceivingController@receive')->name('post.receive');

Route::get('inventory/receiving/list','inventory\ReceivingController@indexList')->name('receiving.list');

Route::get('inventory/receiving/show/{id}','inventory\ReceivingController@show')->name('receiving.show');


//INVENTORY REPORTS

Route::get('inventory/reports/reorderreport','inventory\ReorderController@index')->name('reorder.inventory.report');

Route::get('inventory/reports/inventoryvalue','inventory\InventoryReportController@index')->name('value.inventory.report');

});