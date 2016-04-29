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
				<button type="submit" class="btn btn-primary --center --full-width">
					<i class="glyphicon glyphicon-plus"></i>
					<span>Create new Invoice</span>
				</button>
			</form>
		</div> <!-- </panel-body> -->
	</div> <!-- </panel> -->
@endsection