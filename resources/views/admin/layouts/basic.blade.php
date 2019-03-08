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
      <div class="ui top attached menu">
        <a class="ui icon item" href="/admin">
          <i class="dashboard icon"></i>
        </a>
{{--         <a class="ui icon item">
          <i class="uploader icon"></i>
        </a> --}}
        <div class="right menu">
          <div class="ui right aligned category search item">
            <div class="ui transparent icon input">
              <input class="prompt" type="text" placeholder="Search photos...">
              <i class="search link icon"></i>
            </div>
            <div class="results"></div>
          </div>
        </div>
      </div>
      <div class="ui bottom attached segment">
        @yield('content')
      </div>
      @include('admin.layouts.partials.logout')
    </div>

    @yield('scripts')
    <script type="text/javascript" src="{{asset('js/admin.js')}}"></script>
    <script type="text/javascript">Dropzone.autoDiscover = false;</script>
  </body>
</html>
