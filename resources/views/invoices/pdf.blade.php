@extends('layouts.pdf')

@section('content')
	<style>
		.wrapper { margin: 0 3px; }

		.table-header { color: white; background-color: rgb(58, 78, 134); text-transform: uppercase; }
		.--borderless { border: none !important; }

		.--border-top-double-black { border-top: 3px double black !important; }
		.--border-top-none { border-top: none !important; }
		.--border-horizontal-thick-gray { border-top: 2px solid gray !important; border-bottom: 2px solid gray; }
		.--border-right-thick-black { border-right: 2px solid black; }
		.--border-right-thick-gray { border-right: 2px solid gray; }
		.--border-vertical-thick-black { border-left: 2px solid black; border-right: 2px solid black; }
		.--border-vertical-thick-gray { border-left: 2px solid gray; border-right: 2px solid gray; }
		.--border-bottom-thin-gray { border-bottom: 1px solid gray; }
		.--border-bottom-thick-black { border-bottom: 2px solid black; }
		.--border-thick-gray { border: 2px solid gray !important; }
		.--border-thick-black { border: 2px solid black; }
	</style>

	<div class="wrapper --right" align="right">
		<h1 style="color: rgb(131, 147, 200)">Development Invoice</h1>
	</div>

	<div id="invoice">
		<div class="wrapper">
			<table class="table --layout-fixed">
				<tbody>
					<tr><td class="--borderless"><!-- Empty Row to fix PDF Bug --></td></tr>
					<tr>
						<th class="table-header --border-thick-gray" width="220px">Bill To:</th>
						<td class="--borderless"><!-- Column Spacing --></td>
						<th class="table-header --border-thick-gray" width="220px">Date:</th>
					</tr>

					<tr>
						<td class="--border-thick-black --border-top-none" width="220px">{{ $invoice->bill_to }}</td>
						<td class="--borderless"><!-- Column Spacing --></td>
						<td class="--border-thick-black --border-top-none" width="220px">{{ $invoice->created_at->format('F jS, Y') }}</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="wrapper">
			<table class="table">
				<tbody>
					<tr><td class="--borderless"><!-- Empty Row to fix PDF Bug --></td></tr>
					<tr>
						@foreach(['Description', 'Hourly Price', 'Hours', 'Total'] as $header)
							<?php $border = $header === 'Description' ? '--border-vertical-thick-gray' : '--border-right-thick-gray'; ?>
							<th class="table-header {{ $border }} --border-horizontal-thick-gray">{{ $header }}</th>
						@endforeach
					</tr>

					@foreach($invoice->lines as $index => $line)
						<tr>
							<?php $bottom = $index == $invoice->lines->count() - 1 ? '--border-bottom-thick-black' : '--border-bottom-thin-gray'; ?>

							<td class="--border-vertical-thick-black {{ $bottom }}">{{ $line->description }}</td>
							<td class="--border-right-thick-black {{ $bottom }}">{{ $line->price()->asCurrency() }}</td>
							<td class="--border-right-thick-black {{ $bottom }}">{{ $line->hours }}</td>
							<td class="--border-right-thick-black {{ $bottom }}">{{ $line->total()->asCurrency() }}</td>
						</tr>
					@endforeach

					<tr>
						<td colspan="2" class="--border-top-none"></td>
						<th class="--border-top-none">Subtotal</th>
						<td class="--border-top-none">{{ $invoice->subtotal()->asCurrency() }}</td>
					</tr>

					<tr>
						<td colspan="2" class="--border-top-none"></td>
						<th class="--border-top-none">Taxes</th>
						<td class="--border-top-none">{{ $invoice->taxes()->asCurrency() }}</td>
					</tr>

					<tr>
						<td colspan="2" class="--border-top-none"></td>
						<th class="--border-top-double-black">Total</th>
						<td class="--border-top-double-black">{{ $invoice->total()->asCurrency() }}</td>
					</tr>
				</tbody>
			</table>
		</div> <!-- </wrapper> -->
	</div> <!-- </invoice> -->
@endsection
