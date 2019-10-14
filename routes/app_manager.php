<?php


Route::group(['middleware' => 'auth'], function () 
{


	Route::get('/navigationsettings/navigationparent',
		'app_manager\NavigationController@index')->name('index.navigationparent');


	Route::post('/navigationsettings/navigationparent','app_manager\NavigationController@postParent')->name('post.navigation.parent');


	Route::get('/navigationsettings/navigationcategory',
		'app_manager\NavigationController@Categoryindex')->name('index.navigationcategory');


	Route::post('/navigationsettings/navigationcategory','app_manager\NavigationController@postCategory')->name('post.navigation.category');

	Route::post('/navigationsettings/navigationdelete','app_manager\NavigationController@deleteNav')->name('delete.nav');


	//Company
	Route::get('applicationsetting/company','app_manager\CompanyController@index')->name('company.index');

	Route::post('applicationsetting/company','app_manager\CompanyController@update')->name('company.update');

	//UserList
	//
	Route::get('applicationsetting/user','app_manager\UserController@index')->name('index.users');

	Route::get('validate/user/email/new','app_manager\UserController@validateNewEmail')->name('validate.new.email');

	Route::get('validate/user/username/new','app_manager\UserController@validateNewUsername')->name('validate.new.username');

	Route::post('applicationsetting/user/add','app_manager\UserController@addUser')->name('user.insert');

	//User List Via Data Table
	
	Route::post('applicationsetting/serverside/user' , 'app_manager\UserController@serverside')->name('serverside.users');

	Route::get('applicationsetting/user/resetpassword/{id}','app_manager\UserController@resetpassword')->name('user.reset');


	//Get Window Access
	
	Route::get('applicationsetting/windowaccess/{id}','app_manager\UserAccessController@windowIndex')->name('window.index.user.access');

	Route::get('applicationsetting/windowaccess-ajax','app_manager\UserAccessController@getParent')->name('get.window.parent');

	Route::post('applicationsetting/windowaccess','app_manager\UserAccessController@updateAccess')->name('update.window.access');

	//Get User Access
	
	Route::get('applicationsetting/useraccess/{id}','app_manager\UserAccessController@index')->name('index.user.access');

	//SYS DOC FORM GENERATION
	
	
});