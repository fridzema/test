<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fridzel </title>
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @yield('stylesheets')
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
  <div id="app">
    @yield('content')
		@if(Auth::user())
		  <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
		    Logout
		  </a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				{{ csrf_field() }}
			</form>
		@endif
  </div>
	@yield('scripts')
</body>
</html>
