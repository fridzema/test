<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
  <head>
    <title>Test</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('semantic/semantic.min.css') }}" rel="stylesheet">
    <link href="https://transloadit.edgly.net/releases/uppy/v0.30.4/uppy.min.css" rel="stylesheet">
    @yield('stylesheets')
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        window.AuthUser = {!! json_encode([
            auth()->user(),
        ]) !!};
    </script>
  </head>
  <body>
    <div id="app">
        @yield('content')
      {{-- @include('admin.layouts.partials.logout') --}}
    </div>

    @yield('scripts')
    <script type="text/javascript" src="{{asset('js/admin.js')}}"></script>
    <script type="text/javascript">Dropzone.autoDiscover = false;</script>
  </body>
</html>
