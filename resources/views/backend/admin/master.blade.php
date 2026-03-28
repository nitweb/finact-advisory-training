<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('admin_title')</title>

    {{-- CDN Links --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    {{-- General CSS Files --}}
    <link rel="stylesheet" href="{{ asset('/backend/assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend/assets/bundles/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend/assets/bundles/jquery-selectric/selectric.css') }}">

    {{-- Template CSS --}}
    <link rel="stylesheet" href="{{ asset('/backend/assets/bundles/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend/assets/css/components.css') }}">

    {{-- Custom Style CSS --}}
    <link rel="stylesheet" href="{{ asset('/backend/assets/css/custom.css') }}">

    {{-- Favicon Icon --}}
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('/frontend/images/favicon.jpg') }}' />

</head>

<body>

    <div class="loader"></div>

    <div id="app">

        <div class="main-wrapper main-wrapper-1">

            {{-- ############### HEADER SECTION ############### --}}
            @include('backend.admin.body.header')

            {{-- ############### SIDEBAR SECTION ############### --}}
            @include('backend.admin.body.sidebar')

            {{-- ############### INDEX SECTION ############### --}}
            @yield('admin_content')

            {{-- ############### FOOTER SECTION ############### --}}
            @include('backend.admin.body.footer')

        </div>

    </div>


    {{-- CDN Lists --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- General JS Scripts --}}
    <script src="{{ asset('/backend/assets/js/app.min.js') }}"></script>

    {{-- JS Libraies --}}
    <script src="{{ asset('/backend/assets/bundles/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/bundles/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/bundles/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/bundles/datatables/export-tables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/bundles/datatables/export-tables/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/bundles/datatables/export-tables/jszip.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/bundles/datatables/export-tables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/bundles/datatables/export-tables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/backend/assets/bundles/datatables/export-tables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/bundles/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('/backend/assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/js/page/create-post.js') }}"></script>

    {{-- Page Specific JS File --}}
    <script src="{{ asset('/backend/assets/js/page/index.js') }}"></script>
    <script src="{{ asset('/backend/assets/js/page/datatables.js') }}"></script>
    <script src="{{ asset('/backend/assets/js/page/widget-data.js') }}"></script>

    {{-- Template JS File --}}
    <script src="{{ asset('/backend/assets/js/scripts.js') }}"></script>

    {{-- Custom JS Fil --}}
    <script src="{{ asset('/backend/assets/js/custom.js') }}"></script>

    {{-- Footer Script --}}
    @yield('footer_script')

</body>

</html>
