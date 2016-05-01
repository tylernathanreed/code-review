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