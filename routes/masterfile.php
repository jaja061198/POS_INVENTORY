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


//BRAND

Route::get('/masterfile/brand','masterfile\BrandController@index')->name('index.brand');

Route::get('/masterfile/brand/validatecode','masterfile\BrandController@validator')->name('validate.brand.code');

Route::get('/masterfile/brand/validatecode/edit','masterfile\BrandController@validatorEdit')->name('validate.brand.code.edit');

Route::get('/masterfile/brand/edit','masterfile\BrandController@edit')->name('edit.brand');

Route::post('/masterfile/brand/add','masterfile\BrandController@store')->name('add.brand');

Route::post('/masterfile/brand/edit','masterfile\BrandController@update')->name('update.brand');

Route::post('/masterfile/brand/delete','masterfile\BrandController@destroy')->name('delete.brand');


//ITEM TYPE
//
Route::get('/masterfile/itemtype','masterfile\ItemTypeController@index')->name('index.itemtype');

Route::get('/masterfile/itemtype/validatecode','masterfile\ItemTypeController@validator')->name('validate.itemtype.code');

Route::get('/masterfile/itemtype/validatecode/edit','masterfile\ItemTypeController@validatorEdit')->name('validate.itemtype.code.edit');

Route::get('/masterfile/itemtype/edit','masterfile\ItemTypeController@edit')->name('edit.itemtype');

Route::post('/masterfile/itemtype/add','masterfile\ItemTypeController@store')->name('add.itemtype');

Route::post('/masterfile/itemtype/edit','masterfile\ItemTypeController@update')->name('update.itemtype');

Route::post('/masterfile/itemtype/delete','masterfile\ItemTypeController@destroy')->name('delete.itemtype');


//ITEM
//
Route::get('/masterfile/item','masterfile\ItemController@index')->name('index.item');

Route::get('/masterfile/item/validatecode','masterfile\ItemController@validator')->name('validate.item.code');

Route::get('/masterfile/item/validatecode/edit','masterfile\ItemController@validatorEdit')->name('validate.item.code.edit');

Route::get('/masterfile/item/edit','masterfile\ItemController@edit')->name('edit.item');

Route::post('/masterfile/item/add','masterfile\ItemController@store')->name('add.item');

Route::post('/masterfile/item/edit','masterfile\ItemController@update')->name('update.item');

Route::post('/masterfile/item/delete','masterfile\ItemController@destroy')->name('delete.item');

//SERVICES
//
Route::get('/masterfile/service','masterfile\ServicesController@index')->name('index.service');

Route::get('/masterfile/service/validatecode','masterfile\ServicesController@validator')->name('validate.service.code');

Route::get('/masterfile/service/validatecode/edit','masterfile\ServicesController@validatorEdit')->name('validate.service.code.edit');

Route::get('/masterfile/service/edit','masterfile\ServicesController@edit')->name('edit.service');

Route::post('/masterfile/service/add','masterfile\ServicesController@store')->name('add.service');

Route::post('/masterfile/service/edit','masterfile\ServicesController@update')->name('update.service');

Route::post('/masterfile/service/delete','masterfile\ServicesController@destroy')->name('delete.service');
});