@extends('backend.admin.master')
@section('admin_title', $title)

@section('admin_content')

    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>{{ $title }} — {{ $enrollment->invoice }}</h4>
                                <div style="display:flex; gap:8px;">
                                    {{-- <button onclick="printInvoice()" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-print"></i> Print
                                    </button> --}}
                                    <a href="{{ route('admin.training.enrollment.list') }}" class="btn btn-outline-dark btn-sm">
                                        <i class="fas fa-arrow-left"></i> Back
                                    </a>
                                </div>
                            </div>

                            <div class="card-body" id="invoice-area">

                                {{-- Invoice Header --}}
                                <div style="background:#163355; border-radius:10px; padding:20px 24px; margin-bottom:24px; display:flex; justify-content:space-between; align-items:center;">
                                    <div>
                                        <div style="color:#d4b896; font-size:11px; font-weight:700; letter-spacing:0.07em; text-transform:uppercase; margin-bottom:4px;">Enrollment Invoice</div>
                                        <div style="color:#ffffff; font-size:18px; font-weight:700;">{{ $enrollment->invoice }}</div>
                                        <div style="color:rgba(212,184,150,0.75); font-size:12px; margin-top:3px;">
                                            {{ $enrollment->created_at?->format('d M Y, h:i A') }}
                                        </div>
                                    </div>
                                    <div style="text-align:right;">
                                        @php
                                            $badge = match ($enrollment->status) {
                                                'paid' => ['bg' => '#16a34a', 'text' => '#fff'],
                                                'pending' => ['bg' => '#0891b2', 'text' => '#fff'],
                                                'failed' => ['bg' => '#dc2626', 'text' => '#fff'],
                                                'cancelled' => ['bg' => '#6b7280', 'text' => '#fff'],
                                                default => ['bg' => '#374151', 'text' => '#fff'],
                                            };
                                        @endphp
                                        <span id="show-badge" style="background:{{ $badge['bg'] }}; color:{{ $badge['text'] }}; padding:6px 16px; border-radius:20px; font-size:12px; font-weight:700; display:inline-block;">
                                            {{ ucfirst(str_replace('_', ' ', $enrollment->status)) }}
                                        </span>

                                        {{-- Status change --}}
                                        <div style="margin-top:10px;">
                                            <select class="form-control form-control-sm enrollment-status-show selectric" style="width:160px; color:#000; background:#fff;" data-id="{{ $enrollment->id }}" data-url="{{ route('admin.training.enrollment.status', $enrollment->id) }}" data-old="{{ $enrollment->status }}">
                                                <option value="pending" @selected($enrollment->status === 'pending')>Pending</option>
                                                <option value="paid" @selected($enrollment->status === 'paid')>Paid</option>
                                                <option value="failed" @selected($enrollment->status === 'failed')>Failed</option>
                                                <option value="cancelled" @selected($enrollment->status === 'cancelled')>Cancelled</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    {{-- Training Info --}}
                                    <div class="col-md-6 mb-4">
                                        <h6 style="color:#163355; font-weight:700; margin-bottom:14px; padding-bottom:8px; border-bottom:2px solid #f0f0f0;">
                                            <i class="fas fa-chalkboard-teacher" style="color:#b89867; margin-right:6px;"></i>
                                            Training Info
                                        </h6>
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td style="color:#6b7280; width:45%;">Title</td>
                                                <td style="font-weight:600;">{{ $enrollment->training?->title ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color:#6b7280;">Type</td>
                                                <td style="font-weight:600;">{{ ucfirst($enrollment->training?->type ?? 'N/A') }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color:#6b7280;">Duration</td>
                                                <td style="font-weight:600;">{{ $enrollment->training?->duration ? $enrollment->training->duration . ' hrs' : 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color:#6b7280;">Classes</td>
                                                <td style="font-weight:600;">{{ $enrollment->training?->no_of_classes ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color:#6b7280;">Course Start</td>
                                                <td style="font-weight:600;">
                                                    {{ $enrollment->training?->course_start ? \Carbon\Carbon::parse($enrollment->training->course_start)->format('d M Y') : 'N/A' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="color:#6b7280;">Certification</td>
                                                <td style="font-weight:600;">{{ $enrollment->training?->certification ?? 'N/A' }}</td>
                                            </tr>
                                        </table>
                                    </div>

                                    {{-- Student Info --}}
                                    <div class="col-md-6 mb-4">
                                        <h6 style="color:#163355; font-weight:700; margin-bottom:14px; padding-bottom:8px; border-bottom:2px solid #f0f0f0;">
                                            <i class="fas fa-user-graduate" style="color:#b89867; margin-right:6px;"></i>
                                            Student Info
                                        </h6>
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td style="color:#6b7280; width:40%;">Name</td>
                                                <td style="font-weight:600;">{{ $enrollment->name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color:#6b7280;">Phone</td>
                                                <td style="font-weight:600;">{{ $enrollment->phone }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color:#6b7280;">Email</td>
                                                <td style="font-weight:600;">{{ $enrollment->email ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color:#6b7280;">Address</td>
                                                <td style="font-weight:600;">{{ $enrollment->address ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color:#6b7280;">Note</td>
                                                <td style="font-weight:600;">{{ $enrollment->note ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color:#6b7280;">Submitted</td>
                                                <td style="font-weight:600;">{{ $enrollment->created_at?->format('d M Y, h:i A') }}</td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>

                                {{-- Payment Info --}}
                                <div style="background:#f8f9fc; border-radius:10px; padding:18px 20px;">
                                    <h6 style="color:#163355; font-weight:700; margin-bottom:14px;">
                                        <i class="fas fa-mobile-screen-button" style="color:#b89867; margin-right:6px;"></i>
                                        Payment Info
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div style="font-size:11px; color:#9ca3af; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:3px;">bKash Number</div>
                                            <div style="font-weight:700; color:#163355; font-size:14px;">{{ $enrollment->bkash_number ?? '-' }}</div>
                                        </div>
                                        <div class="col-md-4">
                                            <div style="font-size:11px; color:#9ca3af; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:3px;">Transaction ID</div>
                                            <div style="font-weight:700; color:#163355; font-size:14px;">{{ $enrollment->bkash_trx_id ?? '-' }}</div>
                                        </div>
                                        <div class="col-md-4">
                                            <div style="font-size:11px; color:#9ca3af; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:3px;">Amount</div>
                                            <div style="font-weight:700; color:#163355; font-size:20px;">৳ {{ number_format($enrollment->amount) }}</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('footer_script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });

        $(document).on('change', '.enrollment-status-show', function() {
            const select = $(this);
            const oldStatus = select.data('old');

            select.prop('disabled', true);

            $.ajax({
                url: select.data('url'),
                method: 'PATCH',
                data: {
                    status: select.val()
                },
                success: function(res) {
                    const colors = {
                        paid: {
                            bg: '#16a34a',
                            text: '#fff'
                        },
                        pending: {
                            bg: '#0891b2',
                            text: '#fff'
                        },
                        failed: {
                            bg: '#dc2626',
                            text: '#fff'
                        },
                        cancelled: {
                            bg: '#6b7280',
                            text: '#fff'
                        },
                    };
                    const c = colors[res.status] || {
                        bg: '#374151',
                        text: '#fff'
                    };
                    $('#show-badge')
                        .text(res.label)
                        .css({
                            background: c.bg,
                            color: c.text
                        });
                    select.data('old', res.status);
                },
                error: function(xhr) {
                    alert(xhr.responseJSON?.message ?? 'Status update failed!');
                    select.val(oldStatus);
                },
                complete: function() {
                    select.prop('disabled', false);
                }
            });
        });

        function printInvoice() {
            const content = document.getElementById('invoice-area').innerHTML;
            const win = window.open('', '_blank');
            win.document.write(`
            <html>
            <head>
                <title>Invoice - {{ $enrollment->invoice }}</title>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
                <style>
                    body { padding: 30px; font-family: sans-serif; }
                    select, button { display: none !important; }
                </style>
            </head>
            <body>${content}</body>
            </html>
        `);
            win.document.close();
            win.focus();
            setTimeout(() => {
                win.print();
                win.close();
            }, 600);
        }
    </script>
@endsection
