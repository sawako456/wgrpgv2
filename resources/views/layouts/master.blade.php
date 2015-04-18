<!DOCTYPE html>
<html lang="en">
  <head>
    @include('partials.meta')
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title', 'Cryptic\'s WGRPG v3')</title>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @yield('styles')
  </head>
  <body>
    @yield('page')
    <script src="{{ asset('js/lib.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
  </body>
</html>