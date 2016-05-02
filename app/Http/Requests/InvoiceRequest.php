<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

/*
|--------------------------------------------------------------------------
| Invoice Request
|--------------------------------------------------------------------------
|
| The Invoice Request is responsible for Authorizing and Validating all
| requests that involve managing an Invoice. This application does't
| have a User Authentication Layer, so Authorization is granted.
|
*/
class InvoiceRequest extends Request
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'bill-to' 			 => 'required',
			'billed_at' 		 => 'required|date',
			'line.*.description' => 'required',
			'line.*.hours' 		 => 'required|min:0',
			'line.*.price' 		 => 'required|min:0',
			'taxes' 			 => 'required|min:0'
		];
	}
}
