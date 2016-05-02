<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Support\ValueObjects\Currency;

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
class Invoice extends Model
{
	//////////////////
	//* Attributes *//
	//////////////////
	/**
	 * The Attributes that can be Mass Assigned.
	 *
	 * @var array
	 */
	protected $fillable = ['bill_to', 'billed_at', 'taxes'];

	/////////////////
	//* Accessors *//
	/////////////////
	/**
	 * Calculates the Subtotal of the Lines.
	 *
	 * @return Currency
	 */
	public function subtotal()
	{
		// Determine the Subtotal in Cents
		$cents = $this->lines->reduce(function($previous, $current) { return $previous + $current->total; }, 0);

		// Convert the Subtotal to a Currency Object
		return new Currency($cents);
	}

	/**
	 * Returns the Taxes as a Currency Object.
	 *
	 * @return Currency
	 */
	public function taxes()
	{
		return new Currency($this->attributes['taxes']);
	}

	/**
	 * Calculates the Total of the Lines.
	 *
	 * @return Currency
	 */
	public function total()
	{
		// Determine the Subtotal
		$subtotal = $this->subtotal()->inCents();

		// Add the Taxes to Determine the Total
		$total = $subtotal + $this->taxes()->inCents();

		// Convert the Total to a Currency Object
		return new Currency($total);
	}

	/////////////////
	//* Overrides *//
	/////////////////
	/**
	 * Returns the Subtotal as a String-Formatted Currency
	 *
	 * @return string
	 */
	public function getSubtotalAttribute()
	{
		return $this->subtotal()->asCurrency();
	}

	/**
	 * Returns the Taxes as a String-Formatted Currency
	 *
	 * @return string
	 */
	public function getTaxesAttribute()
	{
		return $this->taxes()->asCurrency();
	}

	/**
	 * Returns the Total as a String-Formatted Currency
	 *
	 * @return string
	 */
	public function getTotalAttribute()
	{
		return $this->total()->asCurrency();
	}

	/////////////////////
	//* Relationships *//
	/////////////////////
	/**
	 * Returns the Invoice Lines that belong to this Invoice.
	 *
	 * @return Relationship
	 */
	public function lines()
	{
		return $this->hasMany(InvoiceLine::class, 'invoice_id', 'id')->orderBy('order');
	}
}
