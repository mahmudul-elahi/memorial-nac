<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $settings::find('dir')->value }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset($settings->getCSS()) }}">

        <!-- Scripts -->
        <script src="{{ asset('js/tabler.min.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="wrapper">
            
            <!-- Page Content -->
            <div class="page-wrapper">
                @yield('content')
            </div>

            <!-- Footer -->
            @include('layouts.footer')
            
        </div>
    </body>
</html>