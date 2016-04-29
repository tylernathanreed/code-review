@extends('layouts.app')

@section('header')
	<div class="jumbotron">
		<div class="container">
			<h1>Invoices</h1>
			<p>This is a listing of the invoices on the site.</p>
			<p>
				<a class="btn btn-primary btn-lg" href="{{ route('invoices.create') }}" role="button">
					<i class="glyphicon glyphicon-plus"></i>
					<span>Create Invoice</span>
				</a>
			</p>
		</div> <!-- </container> -->
	</div> <!-- </jumbotron> -->
@endsection