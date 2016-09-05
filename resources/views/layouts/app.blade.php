<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CheckItOut</title>

    <!-- Fonts -->
    <link href="{{ URL::asset('assets/fonts/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/fonts/lato.css') }}" rel="stylesheet">

{{--     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
 --}}
    <!-- Styles -->
    <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
{{--     <link href="{{ URL::asset('assets/css/bootstrap-table.min.css') }}" rel="stylesheet">
 --}}    <link href="{{ URL::asset('assets/css/select.dataTables.min.css') }}" rel="stylesheet">

</head>

<body id="app-layout">

    @include('layouts.navigation')

    <!-- JavaScripts -->
    <script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>
{{--     <script src="{{ URL::asset('assets/js/bootstrap-table.min.js') }}"></script>
 --}} 
    @yield('content')

</body>
</html>
