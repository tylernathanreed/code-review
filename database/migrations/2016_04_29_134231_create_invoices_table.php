<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*
|--------------------------------------------------------------------------
| Invoices Table
|--------------------------------------------------------------------------
|
| The Invoices Table records the main Invoice entity, which incluces who
| then invoice is billed to, and when the invoice was created. Item
| specific information is detailed in the Invoice Line Table.
|
*/
class CreateInvoicesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the Invoices Table
		Schema::create('invoices', function (Blueprint $table)
		{
			// Identification
			$table->increments('id');

			// Attributes
			$table->string('bill_to');

			// Revision Tracking
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Drop the Invoices Table
		Schema::drop('invoices');
	}
}
