<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="theme-dark bg-page">
<div id="app">
	<nav class="bg-header">
		<div class="container mx-auto">
			<div class="flex justify-between items-center py-2">
				<h1>
					<a class="navbar-brand" href="{{ url('/projects') }}">
						<img width="30" src="/images/cpu.svg" alt="Birdboard">
						{{ config('app.name', 'Birdboard') }}
					</a>
				</h1>
				<div>

					<!-- Right Side Of Navbar -->
					<div class="felx items-center ml-auto">
						<!-- Authentication Links -->
						@guest
							<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
							@if (Route::has('register'))
								<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
							@endif
						@else
							<theme-switcher></theme-switcher>


							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
							   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('logout') }}"
								   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST"
									  style="display: none;">
									@csrf
								</form>
							</div>
						@endguest
					</div>
				</div>
			</div>
		</div>
	</nav>

	<main class="container mx-auto py-4">
		@yield('content')
	</main>
</div>
</body>
<footer>
	<div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a
				href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
</footer>
</html>
