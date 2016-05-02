<div class="flex-row --space-between">
	<div>
		<h4 class="list-group-item-heading">{{ $invoice->bill_to }}</h4>
		<p class="list-group-item-text">
			<b>Subtotal: </b>{{ $invoice->subtotal }}
			<b>Taxes: </b>{{ $invoice->taxes }}
			<b>Total: </b>{{ $invoice->total }}
		</p>
	</div>
	<div>
		<span class="--large --bold">{{ $invoice->lines->count() }}</span>
		<span class="--faded">Lines</span>
	</div>
</div> <!-- </flex-row> -->
<br>
<div class="actions">
	<a class="btn btn-primary" href="{{ route('invoices.show', $invoice->id) }}" role="button">
		<i class="glyphicon glyphicon-eye-open"></i>
		<span>View Details</span>
	</a>
	<a class="btn btn-info" target="_blank" href="{{ route('invoices.pdf', $invoice->id) }}" role="button">
		<i class="glyphicon glyphicon-download-alt"></i>
		<span>Download as PDF</span>
	</a>
</div>