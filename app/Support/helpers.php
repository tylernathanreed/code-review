<?php

if(!function_exists('has_error'))
{
	/**
	 * Returns an HTML Class when the specified Field has an Error.
	 *
	 * @param  string  $field  The Name of the Field
	 *
	 * @return string
	 */
	function has_error($field)
	{
		// Determine the Session
		$session = app('session');

		if($session->has('errors') && $session->get('errors')->has($field))
			return ' has-error';

		return '';
	}
}

if(!function_exists('money_format'))
{
	/**
	 * Returns a Money Format representation of the specified Amount using the specfied Format.
	 *
	 * Note: This function already exists on Linus Operating Systems, and therefore this
	 * helper will only be used on Windows Operating Systems (Or Mac).
	 *
	 * @param  string  $format  The specified Format.
	 * @param  number  $amount  The specified Amount.
	 *
	 * @return string
	 */
	function money_format($format, $amount)
	{
		return sprintf('%01.2f', $amount);
	}
}