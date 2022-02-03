<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    {{-- <base href="../"> --}}
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.png') }}">
    <!-- Page Title  -->
    <title>{{ $title ?? '' }}</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('backend/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('backend/css/theme.css?ver=2.9.1') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/libs/fontawesome-icons.css') }}">

    {{-- Theme --}}
    <link rel="stylesheet" href="{{ asset('backend/css/skins/theme-green.css') }}">
    @stack('css')
</head>

<body class="nk-body bg-lighter npc-default has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            @include('layouts.admin.partials._sidebar')
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">

                <!-- navbar @s -->
                @include('layouts.admin.partials._navbar')
                <!-- navbar @e -->

                <!-- content @s -->
                @yield('admin-content')
                <!-- content @e -->
                <!-- footer @s -->
                @include('layouts.admin.partials._footer')
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->

    <!-- custom -->
    @include('layouts.admin.partials._modal')

    <!-- JavaScript -->
    <script src="{{ asset('backend/js/bundle.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('backend/js/scripts.js?ver=2.9.1') }}"></script>

    @include('layouts.admin.partials.custom')

    @stack('js')
</body>

</html>
