<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $site_description }}">

    <title>{{ $page_name }} - {{ $site_name }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/frontend/images/favicon.ico') }}">

    <meta name="msapplication-TileColor" content="#206bc4" />
    <meta name="theme-color" content="#206bc4" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />

    <meta name="twitter:image:src" content="{{ $site_image }}">
    <meta name="twitter:site" content="">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ $page_name }}">
    <meta name="twitter:description" content="{{ $site_description }}">
    <meta property="og:image" content="{{ $site_image }}">
    <meta property="og:image:width" content="1280">
    <meta property="og:image:height" content="640">
    <meta property="og:site_name" content="{{ $site_name }}">
    <meta property="og:type" content="object">
    <meta property="og:title" content="{{ $page_name }}">
    <meta property="og:url" content="{{ $site_image }}">
    <meta property="og:description" content="{{ $site_description }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/fontawesome.css') }}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/slick.min.css') }}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/slick-theme.min.css') }}">
    <!-- StyleSheet -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    <!-- Responsive Sheet -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/responsive.css') }}">

    <style>
        #floating-alert {
            position: fixed;
            top: 100px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1050;
            width: 90%;
            max-width: 600px;
            background: white;
            border-radius: 30px;
            color: #252525;
        }

        .tox-statusbar {
            display: none !important;
        }

        .tox-tinymce {
            border: 1px solid #FBA8B2 !important;
            border-radius: 4px;
        }

        .tox .tox-edit-area::before {
            border: 1px solid #FBA8B2 !important;
        }
    </style>
</head>



<body>

    <!-- ========================================
    MobileNav-Section-Start
  =========================================== -->

    @include('frontend.layout.nav-mobile')


    <!-- ========================================
    MobileNav-Section-Start
  =========================================== -->



    <!-- ========================================
     Header-Section-Start
  =========================================== -->

    @include('frontend.layout.header')


    <!-- ========================================
     Header-Section-End
  =========================================== -->


    <!-- ========================================
     Hero-Section-Start
  =========================================== -->

    @include('frontend.layout.hero')

    <!-- ========================================
     Hero-Section-End
  =========================================== -->


    {{-- Content-Start --}}

    @yield('content')


    {{-- Content-End --}}



    <!-- ========================================
    Findout-Section-End
  =========================================== -->

    @include('frontend.layout.footer')

    <!-- ========================================
    Footer-Section-Start
  =========================================== -->



    <!-- ========================================
    Footer-Section-End
  =========================================== -->




    <!--=====================================
        Script-Section-Start
  =======================================-->
    <script src="{{ asset('assets/frontend/js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/script.js') }}"></script>

    <script src="https://cdn.tiny.cloud/1/vc9y1hw2e4ll30xels1zg8fnbz0zp643mw1e8q55igd818h1/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>


    <script>
        function previewImages(input) {
            const fileCount = input.files.length;
            document.getElementById('fileCount').textContent = fileCount + " images selected";

            // Clear existing previews
            const previewContainer = document.getElementById('previewContainer');
            previewContainer.innerHTML = '';

            // Preview each image (preserving order)
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100px';
                    img.style.marginRight = '10px';
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        }
    </script>




    <!--=====================================
        Script-Section-End
  =======================================-->



</body>

</html>
