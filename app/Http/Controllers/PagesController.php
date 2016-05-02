<?php

namespace App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Pages Controller
|--------------------------------------------------------------------------
|
| This Controller is responsible for serving static pages to the user.
| Any page that does not contain dynamically generated content is 
| considered static, and therefore served by this Controller.
|
*/
class PagesController extends Controller
{
	/**
	 * Serves the Home Page.
	 *
	 * @return Response
	 */
	public function home()
	{
		return view('pages.home');
	}
}
