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
	Route::get('/e_com/settings/welcome','E_COM\WelcomeController@index')->name('welcome.ecom.index');

	Route::post('/e_com/settings/welcome/update','E_COM\WelcomeController@update')->name('update.welcome.ecom.index');

	//Footer 
	
	Route::get('/e_com/settings/footer','E_COM\FooterController@index')->name('welcome.footer.index');

	Route::post('/e_com/settings/footer/update','E_COM\FooterController@update')->name('update.footer.index');


	//new Orders

	Route::get('/ordersonline/neworders','E_COM\OrderController@index')->name('new.orders.index');

	Route::get('/ordersonline/neworders/review/{id}','E_COM\OrderController@show')->name('new.orders.review');

});