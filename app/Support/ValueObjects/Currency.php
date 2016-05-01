<?php

namespace App\Support\ValueObjects;

/*
|--------------------------------------------------------------------------
| Invoice Model
|--------------------------------------------------------------------------
|
| The Invoice Model represents an Entity stored by the Invoices Table.
| Invoices contain financial information, and can contain many lines
| which partain to it. Note that all currency is stored in cents.
|
*/
class Currency
{
	//////////////////
	//* Attributes *//
	//////////////////
	/**
	 * The number of Cents this Currency represents.
	 *
	 * @var int
	 */
	protected $cents;

	///////////////////
	//* Constructor *//
	///////////////////
	/**
	 * Creates an Instance of this Class.
	 *
	 * @param  int  $cents  The number of Cents for this Currency.
	 *
	 * @return $this
	 */
	public function __construct($cents)
	{
		$this->cents = $cents;
	}

	///////////////////
	//* Conversions *//
	///////////////////
	/**
	 * Formats this Object in Dollars.
	 *
	 * @return float
	 */
	public function inDollars()
	{
		return $this->cents / 100;
	}

	/**
	 * Formats this Object in Cents.
	 *
	 * @return int
	 */
	public function inCents()
	{
		return $this->cents;
	}

	/**
	 * Formats this Object in Currency.
	 *
	 * @param  string  $symbol  The Currency Symbol.
	 *
	 * @return string
	 */
	public function asCurrency($symbol = '$')
	{
		return $symbol . $this->inDollars();
	}
}