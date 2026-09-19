<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 13px;
            color: #1f2937;
            background: #ffffff;
            padding: 40px;
        }

        /* ── Header ── */
        .header {
            text-align: center;
            border-bottom: 2px solid #163355;
            padding-bottom: 18px;
            margin-bottom: 24px;
        }

        .header h1 {
            font-size: 22px;
            color: #163355;
            margin-bottom: 4px;
        }

        .header p {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 2px;
        }

        .invoice-num {
            display: inline-block;
            border: 1px solid #163355;
            color: #163355;
            font-size: 12px;
            font-weight: bold;
            padding: 3px 14px;
            border-radius: 4px;
            margin-top: 8px;
        }

        /* ── Section Title ── */
        .section-title {
            font-size: 11px;
            font-weight: bold;
            color: #163355;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            background: #f0f4f9;
            padding: 6px 12px;
            margin-bottom: 0;
            border-left: 3px solid #163355;
        }

        /* ── Table ── */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table tr {
            border-bottom: 1px solid #e5e7eb;
        }

        table tr:last-child {
            border-bottom: none;
        }

        table td {
            padding: 8px 12px;
            vertical-align: middle;
        }

        table td.lbl {
            color: #6b7280;
            width: 38%;
            font-size: 12px;
        }

        table td.val {
            color: #163355;
            font-weight: bold;
            text-align: right;
            font-size: 13px;
        }

        .amount-val {
            font-size: 16px;
            font-weight: bold;
            color: #163355;
        }

        /* ── Status ── */
        .status-text {
            color: #92630a;
            font-weight: bold;
            font-size: 12px;
        }

        /* ── Notice ── */
        .notice {
            border: 1px solid #fde68a;
            background: #fffbeb;
            padding: 12px 14px;
            font-size: 12px;
            color: #78350f;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        /* ── Footer ── */
        .footer {
            border-top: 1px solid #e5e7eb;
            padding-top: 14px;
            text-align: center;
            font-size: 11px;
            color: #9ca3af;
        }

        .footer p {
            margin-bottom: 3px;
        }

        .toolbar {
            padding: 12px 20px;
            background: #f0f4f9;
            text-align: right;
        }

        .toolbar a,
        .toolbar button {
            display: inline-block;
            font-size: 12px;
            padding: 7px 14px;
            margin-left: 6px;
            border: 1px solid #163355;
            border-radius: 4px;
            background: #163355;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
        }

        @media print {
            .toolbar {
                display: none;
            }
        }
    </style>
</head>

<body>
    @if (!empty($print))
        <div class="toolbar">
            <button type="button" onclick="window.print()">Print</button>
            <a href="{{ route('admin.training.enrollment.invoice.pdf', $enrollment->id) }}">Download PDF</a>
        </div>
    @endif

    {{-- Header --}}
    <div class="header">
        <h1>Enrollment Invoice</h1>
        <p>{{ siteSetting()->site_name ?? 'Finact Advisory Training' }}</p>
        <p>{{ siteSetting()->site_email ?? '' }} &nbsp;|&nbsp; {{ siteSetting()->site_phone ?? '' }}</p>
        <p>{{ siteSetting()->site_address ?? '' }}</p>
        <span class="invoice-num">{{ $enrollment->invoice }}</span>
    </div>

    {{-- Student Details --}}
    <div class="section-title">Student Details</div>
    <table>
        <tr>
            <td class="lbl">Name</td>
            <td class="val">{{ $enrollment->name }}</td>
        </tr>
        <tr>
            <td class="lbl">Phone / WhatsApp</td>
            <td class="val">{{ $enrollment->phone }}</td>
        </tr>
        @if ($enrollment->email)
            <tr>
                <td class="lbl">Email</td>
                <td class="val">{{ $enrollment->email }}</td>
            </tr>
        @endif
        @if ($enrollment->address)
            <tr>
                <td class="lbl">Address</td>
                <td class="val">{{ $enrollment->address }}</td>
            </tr>
        @endif
    </table>

    {{-- Course Details --}}
    <div class="section-title">Course Details</div>
    <table>
        <tr>
            <td class="lbl">Course Name</td>
            <td class="val">{{ $enrollment->training->title }}</td>
        </tr>
        @if ($enrollment->training->type)
            <tr>
                <td class="lbl">Type</td>
                <td class="val">{{ ucfirst($enrollment->training->type) }}</td>
            </tr>
        @endif
        @if ($enrollment->training->course_start)
            <tr>
                <td class="lbl">Course Start</td>
                <td class="val">{{ \Carbon\Carbon::parse($enrollment->training->course_start)->format('d M Y') }}</td>
            </tr>
        @endif
        @if ($enrollment->training->registration_deadline)
            <tr>
                <td class="lbl">Reg. Deadline</td>
                <td class="val">{{ \Carbon\Carbon::parse($enrollment->training->registration_deadline)->format('d M Y') }}</td>
            </tr>
        @endif
        @if ($enrollment->training->duration)
            <tr>
                <td class="lbl">Duration</td>
                <td class="val">{{ $enrollment->training->duration }} Hours</td>
            </tr>
        @endif
        @if ($enrollment->training->no_of_classes)
            <tr>
                <td class="lbl">No. of Classes</td>
                <td class="val">{{ $enrollment->training->no_of_classes }}</td>
            </tr>
        @endif
        @if ($enrollment->training->certification)
            <tr>
                <td class="lbl">Certification</td>
                <td class="val">{{ $enrollment->training->certification }}</td>
            </tr>
        @endif
    </table>

    {{-- Payment Details --}}
    <div class="section-title">Payment Details</div>
    <table>
        <tr>
            <td class="lbl">bKash Number</td>
            <td class="val">{{ $enrollment->bkash_number }}</td>
        </tr>
        <tr>
            <td class="lbl">Transaction ID (TRX)</td>
            <td class="val">{{ $enrollment->bkash_trx_id }}</td>
        </tr>
        @if ($enrollment->training->regular_fee)
            <tr>
                <td class="lbl">Regular Fee</td>
                <td class="val" style="text-decoration: line-through; color:#9ca3af;">
                    BDT {{ number_format($enrollment->training->regular_fee) }}
                </td>
            </tr>
        @endif
        <tr>
            <td class="lbl">Amount Paid</td>
            <td class="val">
                <span class="amount-val">BDT {{ number_format($enrollment->amount) }}</span>
            </td>
        </tr>
        <tr>
            <td class="lbl">Payment Status</td>
            <td class="val">
                <span class="status-text">{{ $enrollment->status === 'pending' ? 'Pending Verification' : ucfirst($enrollment->status) }}</span>
            </td>
        </tr>
        <tr>
            <td class="lbl">Submitted At</td>
            <td class="val">{{ $enrollment->created_at->format('d M Y, h:i A') }}</td>
        </tr>
        <tr>
            <td class="lbl">Invoice No.</td>
            <td class="val">{{ $enrollment->invoice }}</td>
        </tr>
    </table>

    {{-- Notice --}}
    @if ($enrollment->status === 'pending')
        <div class="notice">
            Your payment is currently under verification. You will be contacted on
            <strong>{{ $enrollment->phone }}</strong> within 24 hours of submission.
            Please keep your bKash Transaction ID <strong>{{ $enrollment->bkash_trx_id }}</strong> safe for reference.
        </div>
    @endif

    {{-- Footer --}}
    <div class="footer">
        <p><strong>{{ siteSetting()->site_name ?? 'A Zaman Academy & Advisory' }}</strong></p>
        <p>{{ siteSetting()->site_address ?? '' }}</p>
        <p>Generated on {{ now()->format('d M Y, h:i A') }}</p>
    </div>

</body>

</html>
