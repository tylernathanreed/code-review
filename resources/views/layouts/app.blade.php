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
		@stylesheet("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css")
		@stylesheet("/media/css/all.min.css")

		@yield('head')
	</head>

	<body>
		<header>
			@yield('header')
		</header>

		@container
			@yield('content')
		@endcontainer

		@tail(['id' => 'tail'])
			@yield('templates')

			<!-- Scripts -->
			@script("https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js")
			@script("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js")
			@script("https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.21/vue.js")

			@yield('tail')
		@endtail
	</body>
</html>
