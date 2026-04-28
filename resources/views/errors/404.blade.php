@extends('frontend.dashboard')
@section('frontend_title', 'Page Not Found')

@section('frontend_content')

<style>
    .error-wrap {
        padding: 80px 0 100px;
        background: #f8f9fc;
        min-height: 60vh;
        display: flex;
        align-items: center;
    }

    .error-box {
        text-align: center;
        max-width: 560px;
        margin: 0 auto;
    }

    .error-code {
        font-size: 120px;
        font-weight: 800;
        line-height: 1;
        color: #163355;
        letter-spacing: -4px;
        margin-bottom: 0;
        position: relative;
        display: inline-block;
    }

    .error-code span {
        color: #b89867;
    }

    .error-divider {
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #163355, #b89867);
        border-radius: 2px;
        margin: 20px auto;
    }

    .error-title {
        font-size: 26px;
        font-weight: 700;
        color: #163355;
        margin-bottom: 14px;
    }

    .error-desc {
        font-size: 15px;
        color: #6b7280;
        line-height: 1.7;
        margin-bottom: 32px;
    }

    .error-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .error-btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #163355;
        color: #ffffff;
        font-size: 14px;
        font-weight: 600;
        padding: 12px 28px;
        border-radius: 6px;
        text-decoration: none;
        transition: background 0.2s;
    }

    .error-btn-primary:hover {
        background: #1e4a7a;
        color: #fff;
        text-decoration: none;
    }

    .error-btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 2px solid #163355;
        background: transparent;
        color: #163355;
        font-size: 14px;
        font-weight: 600;
        padding: 12px 28px;
        border-radius: 6px;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
    }

    .error-btn-outline:hover {
        background: #163355;
        color: #fff;
        text-decoration: none;
    }

    .error-links {
        margin-top: 36px;
        padding-top: 28px;
        border-top: 1px solid #e5e7eb;
    }

    .error-links p {
        font-size: 13px;
        color: #9ca3af;
        margin-bottom: 14px;
    }

    .error-quick-links {
        display: flex;
        gap: 10px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .error-quick-link {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 13px;
        font-weight: 600;
        color: #163355;
        background: #eef3fb;
        padding: 6px 14px;
        border-radius: 20px;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
    }

    .error-quick-link:hover {
        background: #163355;
        color: #d4b896;
        text-decoration: none;
    }

    .error-quick-link i { font-size: 11px; }
</style>

    {{-- Page Header --}}
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Page Not Found</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>404</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="error-wrap">
        <div class="container">
            <div class="error-box">

                <div class="error-code">4<span>0</span>4</div>

                <div class="error-divider"></div>

                <h2 class="error-title">Oops! Page Not Found</h2>

                <p class="error-desc">
                    The page you are looking for might have been removed,
                    had its name changed, or is temporarily unavailable.
                </p>

                <div class="error-actions">
                    <a href="{{ route('frontend.index') }}" class="error-btn-primary">
                        <i class="fas fa-home" style="font-size:13px;"></i>
                        Back to Home
                    </a>
                    <a href="{{ route('frontend.contact.us') }}" class="error-btn-outline">
                        <i class="fas fa-envelope" style="font-size:13px;"></i>
                        Contact Us
                    </a>
                </div>

                <div class="error-links">
                    <p>You might be looking for one of these:</p>
                    <div class="error-quick-links">
                        <a href="{{ route('frontend.all.services.list') }}" class="error-quick-link">
                            <i class="fas fa-briefcase"></i> Services
                        </a>
                        <a href="{{ route('frontend.training.development') }}" class="error-quick-link">
                            <i class="fas fa-chalkboard-teacher"></i> Training
                        </a>
                        <a href="{{ route('frontend.blog.list') }}" class="error-quick-link">
                            <i class="fas fa-newspaper"></i> Blog
                        </a>
                        <a href="{{ route('frontend.contact.us') }}" class="error-quick-link">
                            <i class="fas fa-phone-alt"></i> Contact
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection