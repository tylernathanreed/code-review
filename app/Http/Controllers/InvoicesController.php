<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;

use PDF;

/*
|--------------------------------------------------------------------------
| Invoices Controller
|--------------------------------------------------------------------------
|
| The Invoices Controller handles the Invoices Model as a Resource, and
| utilizes the CRUD process to manage Invoices. Not all Resourceful
| actions are used, as the requirements did not specify them.
|
*/
class InvoicesController extends Controller
{
	/**
	 * Display a Listing of the Resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// Determine all of the Invoices
		$invoices = Invoice::all();

		// Show the Index Page for Invoices
		return view('invoices.index', compact('invoices'));
	}

	/**
	 * Show the Form for Creating a new Resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		// Show the Create Page for Invoices
		return view('invoices.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(InvoiceRequest $request)
	{
		// Store using a Transaction to prevent Childless Parents
		$this->transaction(function() use ($request) {
			// Create the Invoice from the Request
			$invoice = Invoice::create([
				'bill_to' 		=> $request->input('bill-to'),
				'created_at' 	=> $request->date,
				'taxes' 		=> $request->taxes * 100
			]);

			// Create each Invoice Line
			foreach($request->line as $line)
			{
				$invoice->lines()->create([
					'order' 		=> $line['order'],
					'description' 	=> $line['description'],
					'hourly_price' 	=> $line['price'] * 100,
					'hours' 		=> $line['hours']
				]);
			}
		});

		// Redirect to the Index Page
		return redirect()->intended(route('invoices.index'));
	}

	/**
	 * Display the specified Resource.
	 *
	 * @param  Invoice  $invoice  The specified Resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Invoice $invoice)
	{
		// Show the Invoice Page
		return view('invoices.show', compact('invoice'));
	}

	/**
	 * Show the Form for Editing the specified Resource.
	 *
	 * @param  Invoice  $invoice  The specified Resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Invoice $invoice)
	{
		// Show the Edit Page for Invoices
		return view('invoices.edit', compact('invoice'));
	}

	/**
	 * Update the specified Resource in Storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified Resource from Storage.
	 *
	 * @param  Invoice  $invoice  The specified Resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Invoice $invoice)
	{
		// Delete the Invoice
		$invoice->delete();

		// Redirect to the Index Page
		return redirect()->intended(route('invoices.index'));
	}

	/**
	 * Downloads the specified Resource as a PDF Document.
	 *
	 * @param  Invoice  $invoice  The specified Resource.
	 *
	 * @return Response
	 */
	public function pdf(Invoice $invoice)
	{
		$pdf = PDF::loadView('invoices.pdf', compact('invoice'));

		return $pdf->download('invoice.pdf');
	}
}
