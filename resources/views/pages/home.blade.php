@extends('layouts.app')

@section('header')
	<div class="jumbotron">
		<div class="container">
			<h1>Code Assessment</h1>
			<p>Created by Tyler Reed - for Sherman Bridge</p>
			<p>
				<a class="btn btn-primary btn-lg" href="{{ route('invoices.index') }}" role="button">
					<i class="glyphicon glyphicon-list"></i>
					<span>View Invoices</span>
				</a>
			</p>
		</div> <!-- </container> -->
	</div> <!-- </jumbotron> -->
@endsection

@section('content')

	<div class="panel panel-default">
		<div class="panel-body">
			<p>
				This project was created for a Code Assessment for Sherman Bridge. The original specifications of the project can be found <a target="_blank" href="https://docs.google.com/document/d/1wcwS9DNdlEsskdxl_mhdunMpCVH1GOBi8vub_CL-RUQ/edit">here</a>.
			</p>
		</div>
	</div>

@endsection