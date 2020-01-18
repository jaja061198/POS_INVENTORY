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

	Route::get('/ordersonline/neworders/review/approvereject/{id}/{action}','E_COM\OrderController@approvereject')->name('approve.reject.order');

	//Order For Payments

	Route::get('/ordersonline/forpayments','E_COM\PaymentController@forPayment')->name('payment.list.index');

	Route::get('/ordersonline/forpaymentsreview','E_COM\PaymentController@forPaymentReview')->name('payment.review.index');

	Route::get('/ordersonline/forpaymentsreview/download/{id}','E_COM\PaymentController@downloadPayment')->name('payment.download');

	Route::get('/ordersonline/forpayment/review/approvereject/{id}/{action}','E_COM\PaymentController@approvereject')->name('approve.reject.payment');

	//For shipping

	Route::get('/ordersonline/forshipping','E_COM\ForShippingController@index')->name('shipping.list.index');

	Route::get('/ordersonline/forpayment/review/changestatus/{id}/{action}','E_COM\ForShippingController@changestatus')->name('change.status.order');

	Route::get('/ordersonline/completed','E_COM\ForShippingController@complete')->name('order.complete');

	Route::get('/ordersonline/cancelled','E_COM\ForShippingController@cancel')->name('order.cancel');

	//Shipping Fee

	Route::get('/e_com/shipping','E_COM\ShippingFeeController@index')->name('index.shipping');

	Route::get('/e_com/shipping/validatecode','E_COM\ShippingFeeController@validator')->name('validate.shipping.code');

	Route::get('/e_com/shipping/validatecode/edit','E_COM\ShippingFeeController@validatorEdit')->name('validate.shipping.code.edit');

	Route::get('/e_com/shipping/edit','E_COM\ShippingFeeController@edit')->name('edit.shipping');

	Route::post('/e_com/shipping/add','E_COM\ShippingFeeController@store')->name('add.shipping');

	Route::post('/e_com/shipping/edit','E_COM\ShippingFeeController@update')->name('update.shipping');

	Route::post('/e_com/shipping/delete','E_COM\ShippingFeeController@destroy')->name('delete.shipping');

});