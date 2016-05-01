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
<a class="btn btn-primary" href="{{ route('invoices.show', $invoice->id) }}" role="button">View Details</a>