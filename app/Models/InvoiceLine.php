<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Support\ValueObjects\Currency;

/*
|--------------------------------------------------------------------------
| Invoice Line Model
|--------------------------------------------------------------------------
|
| The Invoice Line Model represents an Entity stored by the Invoice Lines
| Table. These Lines pertain to a parent Invoice, and contain financial
| information. Note that all currency is stored in the form of cents.
|
*/
class InvoiceLine extends Model
{
	//////////////////
	//* Attributes *//
	//////////////////
	/**
	 * The Attributes that can be Mass Assigned.
	 *
	 * @var array
	 */
	protected $fillable = ['order', 'description', 'hourly_price', 'hours'];

	/**
	 * Whether or not this Model uses 'created_at' and 'updated_at' Timestamps.
	 *
	 * @var boolean
	 */
	public $timestamps = false;

	/////////////////
	//* Accessors *//
	/////////////////
	/**
	 * Returns the Hourly Price as a Currency Object.
	 *
	 * @return Currency
	 */
	public function price()
	{
		return new Currency($this->price);
	}

	/**
	 * Returns the Total Coust as a Currency Object.
	 *
	 * @return Currency
	 */
	public function total()
	{
		return new Currency($this->total);
	}

	/////////////////
	//* Overrides *//
	/////////////////
	/**
	 * Returns the Hourly Price (in Cents).
	 *
	 * @return integer
	 */
	public function getPriceAttribute()
	{
		return $this->hourly_price;
	}

	/**
	 * Returns the Total Cost of the Invoice Line.
	 *
	 * @return integer
	 */
	public function getTotalAttribute()
	{
		return $this->price * $this->hours;
	}

	/////////////////////
	//* Relationships *//
	/////////////////////
	/**
	 * Returns the Invoice that owns this Invoice Line.
	 *
	 * @return Relationship
	 */
	public function invoice()
	{
		return $this->belongsTo(Invoice::class, 'invoice_id');
	}
}
