<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $settings::find('dir')->value }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="{{ $site_description }}">

        <title>{{ $page_name }} - {{ $site_name }}</title>

        <meta name="msapplication-TileColor" content="#206bc4"/>
        <meta name="theme-color" content="#206bc4"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="mobile-web-app-capable" content="yes"/>
        <meta name="HandheldFriendly" content="True"/>
        <meta name="MobileOptimized" content="320"/>

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

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset($settings->getCSS()) }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

        <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>


        <script type="text/javascript">
        "use strict";
        var APP_URL = {!! json_encode(url('/')) !!}
        </script>
<style>
    .ck-editor__editable {
        min-height: 200px; /* Set the desired height in pixels */
    }
</style>
    </head>
    <body class="font-sans antialiased {{ Cookie::get('theme') }}">
        <div class="wrapper">
            <!-- Navigation -->
            @include('layouts.navigation')

            <!-- Page Content -->
            <div class="page-wrapper">

                <!-- Alert Messages -->
                @include('sweetalert::alert')

                @yield('content')
            </div>

            <!-- Footer -->
            @include('layouts.footer')

        </div>

        <a id="insert-button" href="{{ route('insert.obituary') }}" class="btn btn-icon btn-pill insert-button" style="background: {{ $settings->find('app_color')->value }}" role="button" data-bs-toggle="tooltip" data-bs-placement="left" title="{{__('app.btn_propose_an_obituary')}}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-lg text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        </a>

        <!-- Scripts -->
        <script src="{{ asset('js/tabler.min.js') }}" defer></script>
        <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery.jscroll.min.js') }}"></script>
        <script src="{{ asset('js/extra.js') }}"></script>

        <script type="text/javascript" language="javascript">

            // $('ul.pagination').hide();
            $(function() {
                $('.infinite-scroll').jscroll({
                    autoTrigger: true,
                    loadingHtml: '<div class="spinner-border" role="status"></div>',
                    padding: 0,
                    nextSelector: '.pagination li.active + li a',
                    contentSelector: 'div.infinite-scroll',
                    callback: function() {
                        $('ul.pagination').remove();
                    }
                });
            });

            $(document).ready(function(){
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 50) {
                        $('#insert-button').fadeIn();
                    } else {
                        $('#insert-button').fadeOut();
                    }
                });
            });

        </script>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: {
                items: [
                    'heading',        // For headings
                    'bold',           // Bold text
                    'italic',         // Italic text
                    'underline',      // Underline text
                    'strikethrough',  // Strikethrough text
                    'link',           // Insert links
                    'bulletedList',   // Bullet list
                    'numberedList',   // Numbered list
                    'blockQuote',     // Block quotes
                    'code',           // Code block
                    'codeBlock',      // Multi-line code block
                    'alignment',      // Text alignment
                    'insertTable',    // Insert tables
                    'undo',           // Undo changes
                    'redo',           // Redo changes
                    'highlight',      // Highlight text
                    'fontColor',      // Change font color
                    'fontBackgroundColor', // Change background color
                    'fontSize',       // Change font size
                    'fontFamily',     // Change font family
                    'horizontalLine', // Insert horizontal line
                    'specialCharacters', // Special characters
                    'removeFormat'    // Remove formatting
                ]
            }
        })
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
</script>


    </body>
</html>
