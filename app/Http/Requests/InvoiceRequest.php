<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

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
			'date' 				 => 'required|date',
			'line.*.description' => 'required',
			'line.*.hours' 		 => 'required',
			'line.*.price' 		 => 'required',
			'taxes' 			 => 'required'
		];
	}
}
