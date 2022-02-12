<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="/backend/images/favicon.png">
    <!-- Page Title  -->
    <title>{{ $title ?? '' }}</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('backend/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('backend/css/theme.css?ver=2.9.1') }}">
<<<<<<< HEAD
     {{-- Theme --}}
     <link rel="stylesheet" href="{{ asset('backend/css/skins/theme-green.css') }}">
     @stack('css')
 
=======

    {{-- Theme --}}
    <link rel="stylesheet" href="{{ asset('backend/css/skins/theme-green.css') }}">
>>>>>>> a0eeaf3e3d9e3a47c8f7d9355eb2fdf480c232bd
</head>

<body class="nk-body bg-white npc-default pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                @yield('auth-content')
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{ asset('backend/js/bundle.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('backend/js/scripts.js?ver=2.9.1') }}"></script>

</html>
