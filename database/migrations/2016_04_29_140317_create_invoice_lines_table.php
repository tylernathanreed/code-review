<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*
|--------------------------------------------------------------------------
| Invoice Lines Table
|--------------------------------------------------------------------------
|
| The Invoice Lines Table records each Line of a specified Invoice, which
| includes a description, an hourly price, and a number of hours. All
| other aspects of Invoices can be calculated from this information.
|
*/
class CreateInvoiceLinesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the Invoice Lines Table
		Schema::create('invoice_lines', function (Blueprint $table)
		{
			// Identification
			$table->increments('id');

			$table->integer('invoice_id')->unsigned();
			$table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');

			$table->integer('order')->unsigned();

			// Attributes
			$table->string('description', 100);
			$table->integer('hourly_price')->unsigned();
			$table->integer('hours')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Drop the Invoice Lines Table
		Schema::drop('invoice_lines');
	}
}
