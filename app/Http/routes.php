<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'InvoicesController@index');

Route::resource('invoices', 'InvoicesController', [
	'parameters' => 'singular'
]);

Route::group(['prefix' => 'invoices'], function() {
	Route::get('{invoice}/pdf', [
		'as' 	=> 'invoices.pdf',
		'uses' 	=> 'InvoicesController@pdf'
	]);
});