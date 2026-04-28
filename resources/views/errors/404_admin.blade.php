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
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('frontend/assets/images/favicons/fav.png') }}' />

    <style>
        .admin-error-wrap {
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
        }

        .admin-error-box {
            text-align: center;
            max-width: 500px;
        }

        .admin-error-icon {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #f0f4f9;
            border: 3px solid #e5eaf2;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
        }

        .admin-error-icon i {
            font-size: 38px;
            color: #163355;
        }

        .admin-error-code {
            font-size: 80px;
            font-weight: 800;
            color: #163355;
            line-height: 1;
            letter-spacing: -2px;
            margin-bottom: 8px;
        }

        .admin-error-code span {
            color: #b89867;
        }

        .admin-error-title {
            font-size: 20px;
            font-weight: 700;
            color: #163355;
            margin-bottom: 10px;
        }

        .admin-error-desc {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.65;
            margin-bottom: 28px;
        }

        .admin-error-actions {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .admin-err-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #163355;
            color: #ffffff;
            font-size: 13.5px;
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 6px;
            text-decoration: none;
            transition: background 0.2s;
        }

        .admin-err-btn-primary:hover {
            background: #1e4a7a;
            color: #fff;
            text-decoration: none;
        }

        .admin-err-btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            border: 1.5px solid #e5e7eb;
            background: transparent;
            color: #6b7280;
            font-size: 13.5px;
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 6px;
            text-decoration: none;
            transition: border-color 0.2s, color 0.2s;
        }

        .admin-err-btn-outline:hover {
            border-color: #163355;
            color: #163355;
            text-decoration: none;
        }

        .admin-quick-links {
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid #f0f0f0;
        }

        .admin-quick-links p {
            font-size: 12px;
            color: #9ca3af;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            font-weight: 600;
        }

        .admin-quick-list {
            display: flex;
            gap: 8px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .admin-quick-item {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12.5px;
            font-weight: 600;
            color: #163355;
            background: #f0f4f9;
            padding: 5px 13px;
            border-radius: 20px;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
        }

        .admin-quick-item:hover {
            background: #163355;
            color: #d4b896;
            text-decoration: none;
        }

        .admin-quick-item i {
            font-size: 10px;
        }
    </style>

</head>

<body>

    <div class="loader"></div>

    <div id="app">

        <div class="main-wrapper main-wrapper-1">

            <div class="main-content" style="padding:0; padding-top: 60px;">
                <div class="admin-error-wrap">
                    <div class="admin-error-box">

                        <div class="admin-error-icon">
                            <i class="fas fa-search"></i>
                        </div>

                        <div class="admin-error-code">4<span>0</span>4</div>

                        <h3 class="admin-error-title">Page Not Found</h3>

                        <p class="admin-error-desc">
                            The page you requested could not be found.
                            It may have been moved, deleted, or the URL might be incorrect.
                        </p>

                        <div class="admin-error-actions">
                            <a href="{{ route('admin.dashboard') }}" class="admin-err-btn-primary">
                                <i class="fas fa-tachometer-alt" style="font-size:12px;"></i>
                                Go to Dashboard
                            </a>
                            <a href="javascript:history.back()" class="admin-err-btn-outline">
                                <i class="fas fa-arrow-left" style="font-size:12px;"></i>
                                Go Back
                            </a>
                        </div>

                        <div class="admin-quick-links">
                            <p>Quick Links</p>
                            <div class="admin-quick-list">
                                <a href="{{ route('admin.service.list') }}" class="admin-quick-item">
                                    <i class="fas fa-briefcase"></i> Services
                                </a>
                                <a href="{{ route('admin.training.list') }}" class="admin-quick-item">
                                    <i class="fas fa-chalkboard-teacher"></i> Training
                                </a>
                                <a href="{{ route('admin.training.enrollment.list') }}" class="admin-quick-item">
                                    <i class="fas fa-list-alt"></i> Enrollments
                                </a>
                                <a href="{{ route('admin.blog.list') }}" class="admin-quick-item">
                                    <i class="fas fa-newspaper"></i> Blog
                                </a>
                                <a href="{{ route('admin.setting.edit', siteSetting()->id) }}" class="admin-quick-item">
                                    <i class="fas fa-cog"></i> Settings
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


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
