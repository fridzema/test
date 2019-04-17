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
        window.AuthUser = {!! json_encode([
            auth()->user(),
        ]) !!};
    </script>
  </head>
  <body>
    <div id="app" class="ui container" style="margin-top: 10px; margin-bottom: 10px">
        @yield('content')
      {{-- @include('admin.layouts.partials.logout') --}}
    </div>

    @yield('scripts')
    <script type="text/javascript" src="{{asset('js/admin.js')}}"></script>
    <script type="text/javascript">Dropzone.autoDiscover = false;</script>
  </body>
</html>
