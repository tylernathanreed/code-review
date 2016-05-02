@extends('layouts.app')

@section('header')
	<div class="jumbotron">
		<div class="container">
			<h1>Show Invoice</h1>
			<p>This page shows the details of an Invoice.</p>
			<div>
				<a class="btn btn-primary" href="{{ route('invoices.index') }}" role="button">
					<i class="glyphicon glyphicon-chevron-left"></i>
					<span>Back</span>
				</a>

				<a class="btn btn-info" target="_blank" href="{{ route('invoices.pdf') }}" role="button">
					<i class="glyphicon glyphicon-download-alt"></i>
					<span>Download as PDF</span>
				</a>

				<form method="POST" action="{{ route('invoices.destroy', $invoice->id) }}" class="--inline-block">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}

					<button type="submit" class="btn btn-danger">
						<i class="glyphicon glyphicon-trash"></i>
						<span>Delete</span>
					</button>
				</form>
			</div>
		</div> <!-- </container> -->
	</div> <!-- </jumbotron> -->
@endsection

@section('content')
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h2 class="panel-title">Invoice</h2>
		</div> <!-- </panel-header> -->

		<div class="panel-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<div class="form-group">
							<label for="bill-to" class="form-label">Bill To:</label>
							<textarea class="form-control" style="max-height: 7em" readonly>{{ $invoice->bill_to }}</textarea>
						</div> <!-- </form-group> -->
					</div> <!-- </col> -->

					<div class="col-xs-12 col-sm-6">
						<div class="form-group">
							<label for="date" class="form-label">Date:</label>
							<input type="date" class="form-control" value="{{ $invoice->created_at->format('Y-m-d') }}" readonly>
						</div> <!-- </form-group> -->
					</div> <!-- </col> -->
				</div> <!-- </row> -->

				<div class="container-flex">
					<div class="flex-row --padded-horizontal">
						<div class="flex-col-xs-1 flex-col-sm-1 flex-col-md-2 --center"><b>Description</b></div>
						<div class="flex-col-xs-1 --center"><b>Hourly Price</b></div>
						<div class="flex-col-xs-1 --center"><b>Hours</b></div>
						<div class="flex-col-xs-1 --center"><b>Total</b></div>
					</div> <!-- </flex-row> -->

					@foreach($invoice->lines as $line)
						<div class="flex-row">
							<div class="container-flex-xs flex-row-sm --flush --padded-horizontal-xs">
								<div class="flex-row-xs-1 flex-col-sm-1 flex-col-md-2">
									<input type="text" class="form-control" value="{{ $line->description }}" readonly/>
								</div> <!-- </flex-col> -->

								<div class="flex-row-xs-1 flex-col-sm-1">
									<div class="input-group">
										<span class="input-group-addon">$</span>
										<input type="number" class="form-control" value="{{ $line->price()->inDollars() }}" readonly/>
									</div> <!-- </input-group> -->
								</div> <!-- </flex-col> -->

								<div class="flex-row-xs-1 flex-col-sm-1">
									<input type="number" class="form-control" value="{{ $line->hours }}" readonly/>
								</div> <!-- </flex-col> -->

								<div class="flex-row-xs-1 flex-col-sm-1">
									<div class="input-group">
										<span class="input-group-addon">$</span>
										<input type="number" class="form-control" value="{{ $line->total()->inDollars() }}" readonly/>
									</div> <!-- </input-group> -->
								</div> <!-- </flex-col> -->
							</div> <!-- </flex-row> -->
						</div> <!-- </flex-row> -->
					@endforeach

					<div class="flex-row">
						<div class="flex-col-xs-1 flex-col-sm-7 --right"><b>Subtotal</b></div>
						<div class="flex-col-xs-6 flex-col-sm-2">
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="number" class="form-control" value="{{ $invoice->subtotal()->inDollars() }}" readonly/>
							</div> <!-- </input-group> -->
						</div> <!-- </flex-col> -->
					</div> <!-- </flex-row> -->

					<div class="flex-row">
						<div class="flex-col-xs-1 flex-col-sm-7 --right"><b>Taxes</b></div>
						<div class="flex-col-xs-6 flex-col-sm-2">
							<div class="input-group{{ has_error("taxes") }}">
								<span class="input-group-addon">$</span>
								<input type="number" class="form-control" value="{{ $invoice->taxes()->inDollars() }}" readonly/>
							</div> <!-- </input-group> -->
							@error("taxes")
						</div> <!-- </flex-col> -->
					</div> <!-- </flex-row> -->

					<div class="flex-row">
						<div class="flex-col-xs-1 flex-col-sm-7 --right"><b>Total</b></div>
						<div class="flex-col-xs-6 flex-col-sm-2">
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="number" class="form-control" value="{{ $invoice->total()->inDollars() }}" readonly/>
							</div> <!-- </input-group> -->
						</div> <!-- </flex-col> -->
					</div> <!-- </flex-row> -->
				</div> <!-- </flex-container> -->
			</div> <!-- </container-fluid> -->
		</div> <!-- </panel-body> -->
	</div> <!-- </panel> -->
@endsection
