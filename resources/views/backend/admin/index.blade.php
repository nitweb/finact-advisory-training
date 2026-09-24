@extends('backend.admin.master')
@section('admin_title', 'Dashboard')

@section('admin_content')

    <style>
        :root {
            --brand-navy: #163355;
            --brand-navy-light: #1f4370;
            --brand-gold: #b89867;
            --brand-gold-light: #d4b98c;
        }

        .custom_dashboard_title {
            color: var(--bs-body-color);
        }

        a {
            color: inherit;
        }

        a:hover {
            text-decoration: none;
        }

        /* Welcome / hero banner */
        .gradient-banner {
            background: linear-gradient(115deg, var(--brand-navy) 0%, var(--brand-navy-light) 55%, var(--brand-gold) 100%);
            border-radius: 18px;
            position: relative;
            overflow: hidden;
        }

        .gradient-banner>* {
            position: relative;
            z-index: 2;
        }

        .gradient-banner::before {
            content: "";
            position: absolute;
            top: -60px;
            right: -60px;
            width: 220px;
            height: 220px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            z-index: 1;
            pointer-events: none;
        }

        .gradient-banner::after {
            content: "";
            position: absolute;
            bottom: -80px;
            right: 120px;
            width: 160px;
            height: 160px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 50%;
            z-index: 1;
            pointer-events: none;
        }

        .hover-scale {
            transition: all 0.25s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(255, 255, 255, 0.3);
        }

        .visit_card_btn {
            background-color: #fff !important;
            color: var(--brand-navy) !important;
            border-color: #fff;
        }

        .visit_card_btn:hover {
            background-color: var(--brand-gold) !important;
            border-color: var(--brand-gold) !important;
            color: #fff !important;
        }

        /* KPI stat cards */
        .kpi-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            transition: all 0.25s ease-in-out;
            box-shadow: 0 2px 10px rgba(22, 51, 85, 0.06);
        }

        a .kpi-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 24px rgba(22, 51, 85, 0.15);
        }

        a .kpi-card {
            cursor: pointer;
            display: block;
        }

        .kpi-card .kpi-icon-wrap {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            background: linear-gradient(135deg, var(--brand-navy), var(--brand-navy-light));
            color: #fff;
            flex-shrink: 0;
        }

        .kpi-card.kpi-gold .kpi-icon-wrap {
            background: linear-gradient(135deg, var(--brand-gold), var(--brand-gold-light));
        }

        .kpi-card .kpi-label {
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #8a94a6;
            margin-bottom: 4px;
        }

        .kpi-card .kpi-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--brand-navy);
            margin-bottom: 0;
            line-height: 1.1;
        }

        .kpi-card .kpi-top-accent {
            height: 4px;
            width: 100%;
            background: linear-gradient(90deg, var(--brand-navy), var(--brand-gold));
            position: absolute;
            top: 0;
            left: 0;
        }

        /* Enrollment status badges */
        .enroll-stats {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            margin-top: 8px;
        }

        .enroll-badge {
            font-size: 10.5px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        /* Section card */
        .section-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(22, 51, 85, 0.06);
        }

        .section-card .section-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 20px;
            border-bottom: 1px solid #f0f1f5;
        }

        .section-card .section-card-header h5 {
            margin: 0;
            font-weight: 700;
            color: var(--brand-navy);
            font-size: 16px;
        }

        /* Recent activity list */
        .activity-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .activity-list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 20px;
            border-bottom: 1px solid #f5f6f8;
        }

        .activity-list li:last-child {
            border-bottom: none;
        }

        .activity-dot {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
            background: rgba(22, 51, 85, 0.08);
            color: var(--brand-navy);
        }

        .activity-text {
            font-size: 13.5px;
            color: #333;
            margin-bottom: 2px;
        }

        .activity-time {
            font-size: 11.5px;
            color: #9aa1ae;
        }

        .quick-link-pill {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 12px;
            background: #f7f8fb;
            font-size: 13px;
            font-weight: 600;
            color: var(--brand-navy);
            transition: all 0.2s ease;
        }

        .quick-link-pill:hover {
            background: var(--brand-navy);
            color: #fff !important;
        }

        .quick-link-pill i {
            font-size: 16px;
        }

        .empty-hint {
            font-size: 13px;
            color: #9aa1ae;
            padding: 20px;
            text-align: center;
        }
    </style>

    <div class="main-content">
        <section class="section">

            {{-- Breadcrumb --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Welcome / Frontend Visit Banner --}}
            <div class="row mb-3 mt-3">
                <div class="col-12">
                    <div class="card border-0 shadow-sm gradient-banner text-white p-4 d-flex flex-md-row flex-column align-items-center justify-content-between">
                        <div class="mb-3 mb-md-0">
                            <h4 class="fw-bold mb-1 text-white">
                                Welcome back, {{ Auth::user()->name ?? 'Admin' }} 👋
                            </h4>
                            <p class="mb-0 opacity-75">Here's what's happening across your site today.</p>
                        </div>
                        <a href="{{ route('frontend.index') }}" target="_blank" class="btn btn-light fw-semibold px-4 py-2 rounded-pill shadow-sm hover-scale visit_card_btn">
                            🌐 <span>Visit Frontend</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- KPI Stat Cards --}}
            <div class="row g-3">

                {{-- SMS --}}
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{ route('admin.service.list') }}">
                        <div class="card kpi-card p-3 h-100">
                            <span class="kpi-top-accent"></span>
                            <div class="d-flex align-items-center gap-3">
                                <div class="kpi-icon-wrap"><i class="fas fa-concierge-bell"></i></div>
                                <div>
                                    <p class="kpi-label">SMS Balance</p>
                                    <h2 class="kpi-value">{{ $smsBalance }}</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Services --}}
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{ route('admin.service.list') }}">
                        <div class="card kpi-card p-3 h-100">
                            <span class="kpi-top-accent"></span>
                            <div class="d-flex align-items-center gap-3">
                                <div class="kpi-icon-wrap"><i class="fas fa-concierge-bell"></i></div>
                                <div>
                                    <p class="kpi-label">Services</p>
                                    <h2 class="kpi-value">{{ $services->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Trainers --}}
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{ route('admin.trainer.list') }}">
                        <div class="card kpi-card kpi-gold p-3 h-100">
                            <span class="kpi-top-accent"></span>
                            <div class="d-flex align-items-center gap-3">
                                <div class="kpi-icon-wrap"><i class="fas fa-chalkboard-teacher"></i></div>
                                <div>
                                    <p class="kpi-label">Trainers</p>
                                    <h2 class="kpi-value">{{ $trainers->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Training & Development --}}
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{ route('admin.training.list') }}">
                        <div class="card kpi-card p-3 h-100">
                            <span class="kpi-top-accent"></span>
                            <div class="d-flex align-items-center gap-3">
                                <div class="kpi-icon-wrap"><i class="fas fa-graduation-cap"></i></div>
                                <div>
                                    <p class="kpi-label">Trainings</p>
                                    <h2 class="kpi-value">{{ $trainings->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Training Enrollments --}}
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{ route('admin.training.enrollment.list') }}">
                        <div class="card kpi-card kpi-gold p-3 h-100">
                            <span class="kpi-top-accent"></span>
                            <div class="d-flex align-items-center gap-3">
                                <div class="kpi-icon-wrap"><i class="fas fa-user-check"></i></div>
                                <div>
                                    <p class="kpi-label">Enrollments</p>
                                    <h2 class="kpi-value">{{ $enrollments->count() }}</h2>
                                </div>
                            </div>
                            @php
                                $pending = $enrollments->where('status', 'pending')->count();
                                $paid = $enrollments->where('status', 'paid')->count();
                                $cancelled = $enrollments->where('status', 'cancelled')->count();
                            @endphp
                            <div class="enroll-stats">
                                @if ($pending)
                                    <span class="enroll-badge badge badge-info">{{ $pending }} Pending</span>
                                @endif
                                @if ($paid)
                                    <span class="enroll-badge badge badge-success">{{ $paid }} Paid</span>
                                @endif
                                @if ($cancelled)
                                    <span class="enroll-badge badge badge-danger">{{ $cancelled }} Cancelled</span>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Blog --}}
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{ route('admin.blog.list') }}">
                        <div class="card kpi-card p-3 h-100">
                            <span class="kpi-top-accent"></span>
                            <div class="d-flex align-items-center gap-3">
                                <div class="kpi-icon-wrap"><i class="fas fa-newspaper"></i></div>
                                <div>
                                    <p class="kpi-label">Blogs</p>
                                    <h2 class="kpi-value">{{ $blogs->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Gallery --}}
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{ route('admin.gallery.list') }}">
                        <div class="card kpi-card kpi-gold p-3 h-100">
                            <span class="kpi-top-accent"></span>
                            <div class="d-flex align-items-center gap-3">
                                <div class="kpi-icon-wrap"><i class="fas fa-images"></i></div>
                                <div>
                                    <p class="kpi-label">Gallery</p>
                                    <h2 class="kpi-value">{{ $galleries->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Books --}}
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{ route('admin.book.list') }}">
                        <div class="card kpi-card p-3 h-100">
                            <span class="kpi-top-accent"></span>
                            <div class="d-flex align-items-center gap-3">
                                <div class="kpi-icon-wrap"><i class="fas fa-book"></i></div>
                                <div>
                                    <p class="kpi-label">Books</p>
                                    <h2 class="kpi-value">{{ $books->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Book Orders --}}
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{ route('admin.book.order.list') }}">
                        <div class="card kpi-card kpi-gold p-3 h-100">
                            <span class="kpi-top-accent"></span>
                            <div class="d-flex align-items-center gap-3">
                                <div class="kpi-icon-wrap"><i class="fas fa-shopping-cart"></i></div>
                                <div>
                                    <p class="kpi-label">Book Orders</p>
                                    <h2 class="kpi-value">{{ $bookOrders->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Contact Messages --}}
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{ route('admin.contact.list') }}">
                        <div class="card kpi-card p-3 h-100">
                            <span class="kpi-top-accent"></span>
                            <div class="d-flex align-items-center gap-3">
                                <div class="kpi-icon-wrap"><i class="fas fa-envelope-open-text"></i></div>
                                <div>
                                    <p class="kpi-label">Contact Messages</p>
                                    <h2 class="kpi-value">{{ $contacts->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Site Settings --}}
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{ route('admin.setting.edit', siteSetting()->id) }}">
                        <div class="card kpi-card kpi-gold p-3 h-100">
                            <span class="kpi-top-accent"></span>
                            <div class="d-flex align-items-center gap-3">
                                <div class="kpi-icon-wrap"><i class="fas fa-cog"></i></div>
                                <div>
                                    <p class="kpi-label">Site Settings</p>
                                    <h2 class="kpi-value">⚙</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>

            {{-- Charts + Recent Activity --}}
            <div class="row g-3 mt-1">

                {{-- Enrollment Status Chart --}}
                <div class="col-xl-4 col-lg-5 col-md-12">
                    <div class="card section-card h-100">
                        <div class="section-card-header">
                            <h5>Enrollment Status</h5>
                        </div>
                        <div class="p-3">
                            @if ($enrollments->count())
                                <div id="enrollmentStatusChart"></div>
                            @else
                                <div class="empty-hint">No enrollment data yet.</div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Content Overview Chart --}}
                <div class="col-xl-4 col-lg-7 col-md-12">
                    <div class="card section-card h-100">
                        <div class="section-card-header">
                            <h5>Content Overview</h5>
                        </div>
                        <div class="p-3">
                            <div id="contentOverviewChart"></div>
                        </div>
                    </div>
                </div>

                {{-- Recent Activity --}}
                <div class="col-xl-4 col-lg-12 col-md-12">
                    <div class="card section-card h-100">
                        <div class="section-card-header">
                            <h5>Recent Activity</h5>
                        </div>
                        @php
                            $recentEnrollments = $enrollments->take(3)->map(function ($item) {
                                return [
                                    'icon' => 'fa-user-check',
                                    'text' => 'New enrollment: ' . ($item->name ?? 'Guest'),
                                    'time' => optional($item->created_at)->diffForHumans(),
                                    'sort' => optional($item->created_at),
                                ];
                            });
                            $recentContacts = $contacts->take(3)->map(function ($item) {
                                return [
                                    'icon' => 'fa-envelope-open-text',
                                    'text' => 'New contact message from ' . ($item->name ?? 'Someone'),
                                    'time' => optional($item->created_at)->diffForHumans(),
                                    'sort' => optional($item->created_at),
                                ];
                            });
                            $recentBlogs = $blogs->take(3)->map(function ($item) {
                                return [
                                    'icon' => 'fa-newspaper',
                                    'text' => 'Blog published: ' . ($item->title ?? 'Untitled'),
                                    'time' => optional($item->created_at)->diffForHumans(),
                                    'sort' => optional($item->created_at),
                                ];
                            });
                            $recentBooks = $books->take(3)->map(function ($item) {
                                return [
                                    'icon' => 'fa-book',
                                    'text' => 'New book added: ' . ($item->title ?? ($item->name ?? 'Untitled')),
                                    'time' => optional($item->created_at)->diffForHumans(),
                                    'sort' => optional($item->created_at),
                                ];
                            });
                            $recentBookOrders = $bookOrders->take(3)->map(function ($item) {
                                return [
                                    'icon' => 'fa-shopping-cart',
                                    'text' => 'New book order: ' . ($item->invoice ?? 'Order') . ' by ' . ($item->name ?? 'Guest'),
                                    'time' => optional($item->created_at)->diffForHumans(),
                                    'sort' => optional($item->created_at),
                                ];
                            });
                            $recentActivity = collect()->merge($recentEnrollments)->merge($recentContacts)->merge($recentBlogs)->merge($recentBooks)->merge($recentBookOrders)->sortByDesc('sort')->take(6);
                        @endphp

                        @if ($recentActivity->count())
                            <ul class="activity-list">
                                @foreach ($recentActivity as $activity)
                                    <li>
                                        <div class="activity-dot"><i class="fas {{ $activity['icon'] }}"></i></div>
                                        <div>
                                            <div class="activity-text">{{ $activity['text'] }}</div>
                                            <div class="activity-time">{{ $activity['time'] }}</div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="empty-hint">No recent activity yet.</div>
                        @endif
                    </div>
                </div>

            </div>

            {{-- Recent Book Orders --}}
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card section-card">
                        <div class="section-card-header">
                            <h5>Recent Book Orders</h5>
                            <a href="{{ route('admin.book.order.list') }}" class="btn btn-sm btn-outline-secondary rounded-pill">View All</a>
                        </div>
                        @if ($bookOrders->count())
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th class="ps-3">Invoice</th>
                                            <th>Customer</th>
                                            <th>Amount</th>
                                            <th>Payment</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th class="pe-3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookOrders->take(5) as $order)
                                            <tr>
                                                <td class="ps-3 fw-semibold">{{ $order->invoice }}</td>
                                                <td>
                                                    {{ $order->name }}
                                                    <div class="activity-time">{{ $order->phone }}</div>
                                                </td>
                                                <td>৳{{ $order->total_amount }}</td>
                                                <td>
                                                    @php
                                                        $payBadge = match ($order->payment_status) {
                                                            'paid' => 'badge-success',
                                                            'failed' => 'badge-danger',
                                                            'cancelled' => 'badge-danger',
                                                            default => 'badge-info',
                                                        };
                                                    @endphp
                                                    <span class="enroll-badge badge {{ $payBadge }}">{{ ucfirst($order->payment_status) }}</span>
                                                </td>
                                                <td>
                                                    @php
                                                        $statusBadge = match ($order->status) {
                                                            'completed' => 'badge-success',
                                                            'processing' => 'badge-info',
                                                            'cancelled' => 'badge-danger',
                                                            default => 'badge-warning',
                                                        };
                                                    @endphp
                                                    <span class="enroll-badge badge {{ $statusBadge }}">{{ ucfirst($order->status) }}</span>
                                                </td>
                                                <td class="activity-time">{{ optional($order->created_at)->format('d M, Y') }}</td>
                                                <td class="pe-3">
                                                    <a href="{{ route('admin.book.order.show', $order->id) }}" class="quick-link-pill py-1 px-2"><i class="fas fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-hint">No book orders yet.</div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card section-card">
                        <div class="section-card-header">
                            <h5>Quick Links</h5>
                        </div>
                        <div class="p-3 d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.service.add') }}" class="quick-link-pill"><i class="fas fa-plus-circle"></i> Add Service</a>
                            <a href="{{ route('admin.trainer.add') }}" class="quick-link-pill"><i class="fas fa-plus-circle"></i> Add Trainer</a>
                            <a href="{{ route('admin.blog.add') }}" class="quick-link-pill"><i class="fas fa-plus-circle"></i> Write Blog</a>
                            <a href="{{ route('admin.gallery.add') }}" class="quick-link-pill"><i class="fas fa-plus-circle"></i> Add Gallery Image</a>
                            <a href="{{ route('admin.book.add') }}" class="quick-link-pill"><i class="fas fa-plus-circle"></i> Add Book</a>
                            <a href="{{ route('admin.contact.list') }}" class="quick-link-pill"><i class="fas fa-envelope"></i> View Messages</a>
                            <a href="{{ route('admin.setting.edit', siteSetting()->id) }}" class="quick-link-pill"><i class="fas fa-cog"></i> Site Settings</a>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var brandNavy = '#163355';
            var brandGold = '#b89867';
            var brandNavyLight = '#1f4370';

            @if ($enrollments->count())
                var enrollmentStatusOptions = {
                    chart: {
                        type: 'donut',
                        height: 260,
                        fontFamily: 'inherit'
                    },
                    labels: ['Pending', 'Paid', 'Cancelled'],
                    series: [
                        {{ $enrollments->where('status', 'pending')->count() }},
                        {{ $enrollments->where('status', 'paid')->count() }},
                        {{ $enrollments->where('status', 'cancelled')->count() }}
                    ],
                    colors: [brandGold, brandNavy, '#e0625c'],
                    legend: {
                        position: 'bottom'
                    },
                    dataLabels: {
                        enabled: true
                    },
                    stroke: {
                        width: 2
                    }
                };
                var enrollmentStatusChart = new ApexCharts(document.querySelector("#enrollmentStatusChart"), enrollmentStatusOptions);
                enrollmentStatusChart.render();
            @endif

            var contentOverviewOptions = {
                chart: {
                    type: 'bar',
                    height: 260,
                    fontFamily: 'inherit',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        columnWidth: '45%',
                        distributed: true
                    }
                },
                series: [{
                    name: 'Total',
                    data: [
                        {{ $services->count() }},
                        {{ $trainers->count() }},
                        {{ $trainings->count() }},
                        {{ $blogs->count() }},
                        {{ $galleries->count() }},
                        {{ $books->count() }}
                    ]
                }],
                xaxis: {
                    categories: ['Services', 'Trainers', 'Trainings', 'Blogs', 'Gallery', 'Books']
                },
                colors: [brandNavy, brandNavyLight, brandGold, '#7c8ba1', '#c9a876', '#5b7fa6'],
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: true
                }
            };
            var contentOverviewChart = new ApexCharts(document.querySelector("#contentOverviewChart"), contentOverviewOptions);
            contentOverviewChart.render();
        });
    </script>

@endsection
