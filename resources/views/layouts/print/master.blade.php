<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.png') }}">
    <!-- Page Title  -->
    <title>{{ $title ?? '' }}</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('backend/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('backend/css/theme.css?ver=2.9.1') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/skins/theme-green.css') }}">
    @stack('css')
</head>

<body class="bg-white" onload="printPromot()">
    @yield('print-content')
    @stack('js')
</body>

</html>
