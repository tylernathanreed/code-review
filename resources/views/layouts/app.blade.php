<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Title -->
		<title>@yield('title', 'Code Review')</title>

		<!-- Meta -->
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Styles -->
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
		<link href="/media/css/all.min.css" rel="stylesheet">

		@yield('head')
	</head>

	<body>
		<div class="container">
			@yield('content')
		</div>

		<div id="tail" class="tail">
			<!-- Scripts -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/2.0.0-beta.16/angular2.min.js"></script>

			@yield('tail')
		</div> <!-- </tail> -->
	</body>
</html>
