<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CheckItOut</title>

    @include('layouts.css')

</head>

<body id="app-layout">

    @include('layouts.navigation')

    <!-- JavaScripts -->
    @include('layouts.scripts')

    @yield('content')

</body>
</html>
