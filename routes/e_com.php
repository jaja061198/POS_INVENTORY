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

	//About Us 
	
	Route::get('/e_com/settings/about-us','E_COM\AboutController@index')->name('welcome.about.index');

	Route::post('/e_com/settings/about-us/update','E_COM\AboutController@update')->name('update.about.index');

	//Terms 
	
	Route::get('/e_com/settings/terms','E_COM\TermsController@index')->name('welcome.terms.index');

	Route::post('/e_com/settings/terms/update','E_COM\TermsController@update')->name('update.terms.index');

	//Payment Guide 
	
	Route::get('/e_com/settings/payment','E_COM\PaymentController@index')->name('welcome.payment.index');

	Route::post('/e_com/settings/payment/update','E_COM\PaymentController@update')->name('update.payment.index');

	//new Orders

	Route::get('/ordersonline/neworders','E_COM\OrderController@index')->name('new.orders.index');

	Route::get('/ordersonline/neworders/review/{id}','E_COM\OrderController@show')->name('new.orders.review');

});