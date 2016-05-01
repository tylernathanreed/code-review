@extends('layouts.app')

@section('header')
	<div class="jumbotron">
		<div class="container">
			<h1>Create New Invoices</h1>
			<p>This is where you can create a new Invoice.</p>
			<p>
				<a class="btn btn-primary btn-lg" href="{{ route('invoices.index') }}" role="button">
					<i class="glyphicon glyphicon-chevron-left"></i>
					<span>Go Back</span>
				</a>
			</p>
		</div> <!-- </container> -->
	</div> <!-- </jumbotron> -->
@endsection

@section('content')
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h2 class="panel-title">Create new Invoice</h2>
		</div> <!-- </panel-header> -->

		<div class="panel-body">
			<form action="{{ route('invoices.store') }}" method="POST">
				{{ csrf_field() }}

				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<div class="form-group{{ has_error('bill-to') }}">
								<label for="bill-to" class="form-label">Bill To:</label>
								<textarea name="bill-to" class="form-control" placeholder="1234 Main Street" style="max-height: 7em">{{ old('bill-to') }}</textarea>
								@error('bill-to')
							</div> <!-- </form-group> -->
						</div> <!-- </col> -->

						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="date" class="form-label">Date:</label>
								<input type="date" name="date" class="form-control" value="{{ old('date', date('Y-m-d')) }}">
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

						@foreach([0, 1, 2, 3] as $index)
							<div class="flex-row">
								<i class="glyphicon glyphicon-move"></i>

								<div class="container-flex-xs flex-row-sm --flush --padded-horizontal-xs">
									<div class="flex-row-xs-1 flex-col-sm-1 flex-col-md-2{{ has_error("line.$index.description") }}">
										<input type="text" name="line[{{ $index }}][description]" placeholder="Description" class="form-control" value="{{ old("line.$index.description") }}"/>
										@error("line.$index.description")
									</div> <!-- </flex-col> -->

									<div class="flex-row-xs-1 flex-col-sm-1{{ has_error("line.$index.price") }}">
										<div class="input-group">
											<span class="input-group-addon">$</span>
											<input type="number" step="0.01" name="line[{{ $index }}][price]" placeholder="Hourly Price" min="0" class="form-control" value="{{ old("line.$index.price", 0) }}"/>
										</div> <!-- </input-group> -->
										@error("line.$index.price")
									</div> <!-- </flex-col> -->

									<div class="flex-row-xs-1 flex-col-sm-1{{ has_error("line.$index.hours") }}">
										<input type="number" step="0.01" name="line[{{ $index }}][hours]" placeholder="Hours" min="0" class="form-control" value="{{ old("line.$index.hours", 0) }}"/>
										@error("line.$index.hours")
									</div> <!-- </flex-col> -->

									<div class="flex-row-xs-1 flex-col-sm-1">
										<div class="input-group">
											<span class="input-group-addon">$</span>
											<input type="number" step="0.01" name="line[{{ $index }}][total]" placeholder="Total" min="0" class="form-control" readonly/>
										</div> <!-- </input-group> -->
									</div> <!-- </flex-col> -->

									<input type="hidden" name="line[{{ $index }}][order]" value="{{ $index }}"/>
								</div> <!-- </flex-row> -->

								<i class="glyphicon glyphicon-trash"></i>
							</div> <!-- </flex-row> -->
						@endforeach

						<div class="flex-row">
							<div class="flex-col-xs-1 --center">
								<a class="btn btn-primary --half-width" href="#" role="button">
									<i class="glyphicon glyphicon-plus"></i>
									<span>Add New Line</span>
								</a>
							</div>
						</div> <!-- </flex-row> -->

						<div class="flex-row --padded-horizontal">
							<div class="flex-col-xs-1 flex-col-sm-7 --right"><b>Subtotal</b></div>
							<div class="flex-col-xs-6 flex-col-sm-2">
								<div class="input-group">
									<span class="input-group-addon">$</span>
									<input type="number" step="0.01" name="subtotal" placeholder="Subtotal" min="0" class="form-control" readonly/>
								</div> <!-- </input-group> -->
							</div> <!-- </flex-col> -->
						</div> <!-- </flex-row> -->

						<div class="flex-row --padded-horizontal">
							<div class="flex-col-xs-1 flex-col-sm-7 --right"><b>Taxes</b></div>
							<div class="flex-col-xs-6 flex-col-sm-2">
								<div class="input-group{{ has_error("taxes") }}">
									<span class="input-group-addon">$</span>
									<input type="number" step="0.01" name="taxes" placeholder="Taxes" min="0" class="form-control"/>
								</div> <!-- </input-group> -->
								@error("taxes")
							</div> <!-- </flex-col> -->
						</div> <!-- </flex-row> -->

						<div class="flex-row --padded-horizontal">
							<div class="flex-col-xs-1 flex-col-sm-7 --right"><b>Total</b></div>
							<div class="flex-col-xs-6 flex-col-sm-2">
								<div class="input-group">
									<span class="input-group-addon">$</span>
									<input type="number" step="0.01" name="total" placeholder="Total" min="0" class="form-control" readonly/>
								</div> <!-- </input-group> -->
							</div> <!-- </flex-col> -->
						</div> <!-- </flex-row> -->
					</div> <!-- </flex-container> -->

					<button type="submit" class="btn btn-primary --full-width">
						<i class="glyphicon glyphicon-plus"></i>
						<span>Create new Invoice</span>
					</button>
				</div> <!-- </container-fluid> -->
			</form>
		</div> <!-- </panel-body> -->
	</div> <!-- </panel> -->
@endsection