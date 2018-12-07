<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fridzel </title>
    <link href="{{ asset('semantic/semantic.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/admin.css') }}" rel="stylesheet"> --}}
    @yield('stylesheets')
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
  <div id="app" class="ui container">
    @yield('content')

    @include('admin.layouts.partials.logout')
  </div>
  {{-- <script src="{{ asset('semantic/semantic.min.js') }}"></script> --}}
	@yield('scripts')
</body>
</html>
