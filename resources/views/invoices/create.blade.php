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
							<div class="form-group">
								<label for="bill-to" class="form-label">Bill To:</label>
								<textarea name="bill-to" class="form-control" placeholder="1234 Main Street" style="max-height: 7em"></textarea>
							</div> <!-- </form-group> -->
						</div> <!-- </col> -->

						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="date" class="form-label">Date:</label>
								<input type="date" name="date"/ class="form-control">
							</div> <!-- </form-group> -->
						</div> <!-- </col> -->
					</div> <!-- </row> -->

					<table class="table --layout-fixed">
						<tbody>
							<tr>
								<th class="--center">Description</th>
								<th class="--center">Hourly Price</th>
								<th class="--center">Hours</th>
								<th class="--center">Total</th>
							</tr>
							<tr>
								<td>
									<input type="text" name="description[]" placeholder="Description" class="form-control"/>
								</td>
								<td>
									<div class="input-group">
										<span class="input-group-addon">$</span>
										<input type="number" name="price[]" class="form-control"/>
									</div> <!-- </input-group> -->
								</td>
								<td>
									<input type="number" name="hours[]" class="form-control"/>
								</td>
								<td>
									<div class="input-group">
										<span class="input-group-addon">$</span>
										<input type="number" class="form-control" readonly/>
									</div> <!-- </input-group> -->
								</td>
							</tr>
							<tr>
								<th colspan="3" class="--right">Subtotal</tH>
								<td>
									<div class="input-group">
										<span class="input-group-addon">$</span>
										<input type="number" class="form-control" readonly/>
									</div> <!-- </input-group> -->
								</td>
							</tr>
						</tbody>
					</table>

					<button type="submit" class="btn btn-primary --full-width">
						<i class="glyphicon glyphicon-plus"></i>
						<span>Create new Invoice</span>
					</button>
				</div> <!-- </container-fluid> -->
			</form>
		</div> <!-- </panel-body> -->
	</div> <!-- </panel> -->
@endsection