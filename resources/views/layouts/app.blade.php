<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CheckItOut</title>

    <!-- Fonts -->
    <link href="{{ URL::asset('assets/fonts/font-awesome.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ URL::asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/select.dataTables.css') }}" rel="stylesheet">

</head>

<body id="app-layout">

    @include('layouts.navigation')

    <!-- JavaScripts -->
    <script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.autocomplete.js') }}"></script>
 
    @yield('content')

</body>
</html>
