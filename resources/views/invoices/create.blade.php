@extends('layouts.app')

@section('header')
	@jumbotron
		@container
			<h1>Create New Invoices</h1>
			<p>This is where you can create a new Invoice.</p>
			<p>
				<a class="btn btn-primary btn-lg" href="{{ route('invoices.index') }}" role="button">
					<i class="glyphicon glyphicon-chevron-left"></i>
					<span>Go Back</span>
				</a>
			</p>
		@endcontainer
	@endjumbotron
@endsection

@section('content')
	@panel(['class' => 'panel-primary'])
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
							<div class="form-group{{ has_error('billed_at') }}">
								<label for="billed_at" class="form-label">Date:</label>
								<input type="date" name="billed_at" class="form-control" value="{{ old('billed_at', date('Y-m-d')) }}">
								@error('billed_at')
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

						<div id="lines">
							<div class="flex-row" v-for="line in lines">
								<i class="glyphicon glyphicon-move" style="visibility: hidden"></i>

								<div class="container-flex-xs flex-row-sm --flush --padded-horizontal-xs --align-top">
									<div :class="[
										'flex-row-xs-1',
										'flex-col-sm-1',
										'flex-col-md-2',
										'--full-width',
										errors['line.' + $index + '.description'] ? 'has-error' : ''
									]">
										<input type="text"
											   placeholder="Description"
											   class="form-control"
											   name="line[@{{ $index }}][description]"
											   v-model="line.description"
										/>
										<error :error="errors['line.' + $index + '.description']"></error>
									</div> <!-- </flex-col> -->

									<div class="flex-row-xs-1 flex-col-sm-1">
										<div class="input-group">
											<span class="input-group-addon">$</span>
											<input type="number"
												   step="0.01"
												   placeholder="Hourly Price"
												   min="0"
												   class="form-control"
												   name="line[@{{ $index }}][price]"
												   v-model="line.price"
											/>
										</div> <!-- </input-group> -->
									</div> <!-- </flex-col> -->

									<div class="flex-row-xs-1 flex-col-sm-1">
										<input type="number"
											   step="0.01"
											   placeholder="Hours"
											   min="0"
											   class="form-control"
											   name="line[@{{ $index }}][hours]"
											   v-model="line.hours"
										/>
									</div> <!-- </flex-col> -->

									<div class="flex-row-xs-1 flex-col-sm-1">
										<div class="input-group">
											<span class="input-group-addon">$</span>
											<input type="number"
												   step="0.01"
												   placeholder="Total"
												   min="0"
												   class="form-control"
												   :value="line.price * line.hours"
												   readonly
											/>
										</div> <!-- </input-group> -->
									</div> <!-- </flex-col> -->
								</div> <!-- </flex-row> -->

								<input type="hidden" name="line[@{{ $index }}][order]" :value="$index"/>

								<i class="glyphicon glyphicon-remove" @click="deleteLine(line)"></i>
							</div> <!-- </flex-row> -->
						</div> <!-- </lines> -->

						<div class="flex-row">
							<div class="flex-col-xs-1 --center">
								<a class="btn btn-primary --half-width" href="#" role="button" @click="addLine">
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
									<input type="number"
										   step="0.01"
										   placeholder="Subtotal"
										   min="0"
										   class="form-control"
										   :value="subtotal"
										   readonly
									/>
								</div> <!-- </input-group> -->
							</div> <!-- </flex-col> -->
						</div> <!-- </flex-row> -->

						<div class="flex-row --padded-horizontal">
							<div class="flex-col-xs-1 flex-col-sm-7 --right"><b>Taxes</b></div>
							<div class="flex-col-xs-6 flex-col-sm-2">
								<div class="input-group{{ has_error("taxes") }}">
									<span class="input-group-addon">$</span>
									<input type="number"
										   step="0.01"
										   name="taxes"
										   placeholder="Taxes"
										   min="0"
										   class="form-control"
										   v-model="taxes"
									/>
								</div> <!-- </input-group> -->
								@error("taxes")
							</div> <!-- </flex-col> -->
						</div> <!-- </flex-row> -->

						<div class="flex-row --padded-horizontal">
							<div class="flex-col-xs-1 flex-col-sm-7 --right"><b>Total</b></div>
							<div class="flex-col-xs-6 flex-col-sm-2">
								<div class="input-group">
									<span class="input-group-addon">$</span>
									<input type="number"
										   step="0.01"
										   placeholder="Total"
										   min="0"
										   class="form-control"
										   :value="total"
										   readonly
									/>
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
	@endpanel
@endsection

@section('templates')

	<template id="template-error">
		<span class="help-block" v-if="error">
			<strong>
				@{{ error }}
			</strong>
		</span>
	</template>

@endsection

@section('tail')
	<script>
		Vue.component('error', {
			template: '#template-error',
			props: ['error']
		});

		new Vue({
			el: 'body',

			data: {
				lines: {!! json_encode(old('line', [])) !!},
				errors: {!! $errors->toJson() !!},
				taxes: 0
			},

			computed: {
				subtotal: function() {
					return this.lines.reduce(function(previous, current) {
						return previous + (current.price * current.hours);
					}, 0);
				},

				total: function() {
					return +this.subtotal + +this.taxes;
				}
			},

			methods: {
				addLine: function() {
					this.lines.push({
						description: '',
						price: 0,
						hours: 0,
					});
				},

				deleteLine: function(line) {
					this.lines.$remove(line);
				},
			}
		});
	</script>
@endsection