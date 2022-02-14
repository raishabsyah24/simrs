<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.png') }}">
    <!-- Page Title  -->
    <title>404</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('backend/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('backend/css/theme.css?ver=2.9.1') }}">

    {{-- Theme --}}
    <link rel="stylesheet" href="{{ asset('backend/css/skins/theme-bluelite.css') }}">
</head>

<body class="nk-body bg-white npc-default pg-error">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle wide-md mx-auto">
                        <div class="nk-block-content nk-error-ld text-center">
                            <img class="nk-error-gfx" src="{{ asset('backend/images/gfx/error-404.svg') }}" alt="">
                            <div class="wide-xs mx-auto">
                                <h3 class="nk-error-title">Halaman diblok</h3>
                                <p class="nk-error-text">Kami mohon maaf atas ketidaknyamanan ini. Sepertinya Anda
                                    mencoba
                                    untuk mengakses halaman yang mempunyai akses khusus.</p>
                                <a href="{{ route('dashboard.index') }}"
                                    class="btn btn-lg btn-primary mt-2">Kembali</a>
                            </div>
                        </div>
                    </div><!-- .nk-block -->
                </div>
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
</body>

</html>
