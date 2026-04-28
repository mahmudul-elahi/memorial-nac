<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $page_name }} - {{ $site_name }}</title>

    <meta name="msapplication-TileColor" content="#206bc4" />
    <meta name="theme-color" content="#206bc4" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('adm/css/tabler.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" />

    <style>
        .ck-editor__editable {
            min-height: 200px;
            /* Set the desired height in pixels */
        }
    </style>

    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>

    <script type="text/javascript">
        "use strict";
        var APP_URL = {!! json_encode(url('/')) !!}
    </script>

</head>

<body class="font-sans antialiased">
    <div class="wrapper">
        @include('admin.layouts.navigation')
        <div class="page-wrapper">

            <!-- Alert Messages -->
            @include('sweetalert::alert')

            @yield('content')
            @include('admin.layouts.footer')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('adm/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('adm/libs/jquery/dist/jquery.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#master').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });


            $('.delete_all').on('click', function(e) {


                var allVals = [];
                $(".sub_chk:checked").each(function() {
                    allVals.push($(this).attr('data-id'));
                });


                if (allVals.length <= 0) {
                    alert("Please select row.");
                } else {


                    var check = confirm("Are you sure you want to delete this row?");
                    if (check == true) {


                        var join_selected_values = allVals.join(",");


                        $.ajax({
                            url: $(this).data('url'),
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: 'ids=' + join_selected_values,
                            success: function(data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function() {
                                        $(this).parents("tr").remove();
                                    });
                                    alert(data['success']);
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function(data) {
                                alert(data.responseText);
                            }
                        });


                        $.each(allVals, function(index, value) {
                            $('table tr').filter("[data-row-id='" + value + "']").remove();
                        });
                    }
                }
            });

            $(document).on('confirm', function(e) {
                var ele = e.target;
                e.preventDefault();


                $.ajax({
                    url: ele.href,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data['success']) {
                            $(".sub_chk:checked").each(function() {
                                $(this).parents("tr").remove();
                            });
                            alert(data['success']);
                        } else if (data['error']) {
                            alert(data['error']);
                        } else {
                            alert('Whoops Something went wrong!!');
                        }
                    },
                    error: function(data) {
                        alert(data.responseText);
                    }
                });


                return false;
            });

        });

        //

        //

        function updateStatusPost(e, t) {
            $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    }
                }),
                $.ajax({
                    url: APP_URL + "/admin/change/status",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: e,
                        table: t,
                        _token: $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(t) {
                        0 == t.bool ? $("#status-post-" + e).removeClass("badge bg-red-lt").addClass(
                                "badge bg-green-lt").text("Active") : 1 == t.bool && $("#status-post-" + e)
                            .removeClass("badge bg-green-lt").addClass("badge bg-red-lt").text("Disabled")
                    }
                })
        };

        //

        //

        //
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: {
                    items: [
                        'heading', // For headings
                        'bold', // Bold text
                        'italic', // Italic text
                        'underline', // Underline text
                        'strikethrough', // Strikethrough text
                        'link', // Insert links
                        'bulletedList', // Bullet list
                        'numberedList', // Numbered list
                        'blockQuote', // Block quotes
                        'code', // Code block
                        'codeBlock', // Multi-line code block
                        'alignment', // Text alignment
                        'insertTable', // Insert tables
                        'undo', // Undo changes
                        'redo', // Redo changes
                        'highlight', // Highlight text
                        'fontColor', // Change font color
                        'fontBackgroundColor', // Change background color
                        'fontSize', // Change font size
                        'fontFamily', // Change font family
                        'horizontalLine', // Insert horizontal line
                        'specialCharacters', // Special characters
                        'removeFormat' // Remove formatting
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
