<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
  <head>
    <title>Test</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    @yield('scripts')
  </body>
</html>
