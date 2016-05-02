<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Title -->
		<title>@yield('title', 'Code Review | Invoices')</title>

		<!-- Meta -->
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Styles -->
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
		<link href="/media/css/all.min.css" rel="stylesheet">

		@yield('head')
	</head>

	<body ng-app="root">
		@yield('content')
	</body>
</html>
