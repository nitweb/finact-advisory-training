@extends('backend.admin.master')
@section('admin_title', '404 - Page Not Found')

@section('admin_content')

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

    .admin-error-code span { color: #b89867; }

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

    .admin-quick-item i { font-size: 10px; }
</style>

<div class="main-content">
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

@endsection