<?php

/*
|--------------------------------------------------------------------------
| Static Page Routes
|--------------------------------------------------------------------------
|
| All Routes pertaining to static pages and/or content are defined here.
| These Routes all use the PagesController, which is responsible for
| serving this content. All static content begins with a root URL.
|
*/

Route::get('/', 'PagesController@home');

/*
|--------------------------------------------------------------------------
| Invoice Routes
|--------------------------------------------------------------------------
|
| All Routes pertaining to Invoices are defined here. These routes are
| prefixed by the 'invoices' noun, and use the '{invoice}' wildcard
| when necessary. The Route Names are prefixed with 'invoices'.
|
*/
Route::resource('invoices', 'InvoicesController', [
	'parameters' => 'singular'
]);

Route::group(['prefix' => 'invoices'], function() {
	Route::get('{invoice}/pdf', [
		'as' 	=> 'invoices.pdf',
		'uses' 	=> 'InvoicesController@pdf'
	]);
});