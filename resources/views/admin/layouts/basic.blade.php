<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fridzel </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet">
    {{-- <link href="{{ asset('css/admin.css') }}" rel="stylesheet"> --}}
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

    @include('admin.layouts.partials.logout')
  </div>
	@yield('scripts')
</body>
</html>
