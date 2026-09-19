<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $order->invoice }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 12.5px;
            color: #2b3648;
            padding: 0;
        }

        .sheet {
            padding: 46px 48px 40px;
        }

        /* ── Letterhead ── */
        .letterhead {
            display: table;
            width: 100%;
            border-bottom: 3px solid #163355;
            padding-bottom: 20px;
            margin-bottom: 26px;
        }

        .letterhead .brand-col {
            display: table-cell;
            vertical-align: middle;
            width: 60%;
        }

        .letterhead .meta-col {
            display: table-cell;
            vertical-align: middle;
            width: 40%;
            text-align: right;
        }

        .brand-logo {
            max-height: 46px;
            max-width: 220px;
            margin-bottom: 8px;
        }

        .brand-name {
            font-size: 19px;
            font-weight: bold;
            color: #163355;
            letter-spacing: 0.2px;
        }

        .brand-tagline {
            font-size: 10.5px;
            color: #8a93a3;
            margin-top: 2px;
        }

        .brand-contact {
            font-size: 9.5px;
            color: #6b7280;
            margin-top: 8px;
            line-height: 1.6;
        }

        .doc-title {
            font-size: 21px;
            font-weight: bold;
            color: #163355;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .invoice-num {
            display: inline-block;
            background: #163355;
            color: #ffffff;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 0.4px;
            padding: 5px 12px;
            border-radius: 4px;
            margin-top: 9px;
        }

        .status-pill {
            display: inline-block;
            font-size: 9.5px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 4px 11px;
            border-radius: 20px;
            margin-top: 8px;
        }

        .status-paid {
            background: rgba(34, 153, 84, 0.12);
            color: #1e8449;
        }

        .status-pending {
            background: rgba(184, 152, 103, 0.18);
            color: #9a7d4e;
        }

        .status-other {
            background: #f0f4f9;
            color: #163355;
        }

        /* ── Bill-to / Order meta panel ── */
        .info-panel {
            display: table;
            width: 100%;
            background: #f8f9fc;
            border: 1px solid #eef1f6;
            border-radius: 8px;
            margin-bottom: 26px;
        }

        .info-panel .info-col {
            display: table-cell;
            vertical-align: top;
            width: 50%;
            padding: 16px 20px;
        }

        .info-panel .info-col+.info-col {
            border-left: 1px solid #eef1f6;
        }

        .info-label {
            font-size: 9.5px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #8a93a3;
            margin-bottom: 8px;
        }

        .info-panel p {
            font-size: 12px;
            line-height: 1.85;
            color: #2b3648;
        }

        .info-panel p strong {
            color: #163355;
        }

        /* ── Items table ── */
        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }

        table.items thead th {
            background: #163355;
            color: #ffffff;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 11px 12px;
            text-align: left;
        }

        table.items thead th.num {
            text-align: right;
        }

        table.items tbody td {
            padding: 11px 12px;
            border-bottom: 1px solid #eef1f6;
            font-size: 12.5px;
            vertical-align: top;
        }

        table.items tbody td.num {
            text-align: right;
        }

        table.items tbody tr:nth-child(even) {
            background: #fafbfd;
        }

        .item-title {
            font-weight: bold;
            color: #163355;
        }

        /* ── Totals ── */
        table.totals {
            width: 100%;
            border-collapse: collapse;
            margin-top: 14px;
        }

        table.totals td {
            padding: 7px 12px;
            font-size: 12.5px;
        }

        table.totals td.label {
            text-align: right;
            color: #6b7280;
            width: 82%;
        }

        table.totals td.value {
            text-align: right;
            color: #2b3648;
            width: 18%;
            white-space: nowrap;
        }

        table.totals tr.grand td {
            border-top: 2px solid #163355;
            padding-top: 12px;
            font-size: 16px;
            font-weight: bold;
            color: #163355;
        }

        table.totals tr.grand td.label {
            color: #163355;
        }

        /* ── Footer ── */
        .thanks {
            margin-top: 34px;
            padding-top: 16px;
            border-top: 1px dashed #d9deea;
            text-align: center;
        }

        .thanks .thanks-title {
            font-size: 13px;
            font-weight: bold;
            color: #163355;
            margin-bottom: 4px;
        }

        .thanks .thanks-note {
            font-size: 10.5px;
            color: #8a93a3;
        }

        .footer-strip {
            margin-top: 30px;
            background: #163355;
            color: #ffffff;
            text-align: center;
            font-size: 9.5px;
            letter-spacing: 0.3px;
            padding: 10px 20px;
        }

        .footer-strip span {
            color: #d8c39a;
        }

        .toolbar {
            padding: 12px 48px;
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
            <a href="{{ route('admin.book.order.invoice.pdf', $order->id) }}">Download PDF</a>
        </div>
    @endif
    <div class="sheet">

        <!-- Letterhead -->
        <div class="letterhead">
            <div class="brand-col">
                @if (siteSetting() && siteSetting()->header_logo)
                    <img class="brand-logo" src="{{ !empty($print) ? asset(siteSetting()->header_logo) : public_path(siteSetting()->header_logo) }}" alt="{{ config('app.name') }}">
                @else
                    <div class="brand-name">{{ config('app.name') }}</div>
                @endif
                <div class="brand-contact">
                    @if (siteSetting() && siteSetting()->site_address)
                        {{ siteSetting()->site_address }}<br>
                    @endif
                    @if (siteSetting() && siteSetting()->site_phone)
                        Phone: {{ siteSetting()->site_phone }} &nbsp;|&nbsp;
                    @endif
                    @if (siteSetting() && siteSetting()->site_email)
                        {{ siteSetting()->site_email }}
                    @endif
                </div>
            </div>
            <div class="meta-col">
                <div class="doc-title">Invoice</div>
                <div class="invoice-num">{{ $order->invoice }}</div><br>
                <span class="status-pill {{ $order->payment_status === 'paid' ? 'status-paid' : ($order->payment_status === 'pending' ? 'status-pending' : 'status-other') }}">
                    {{ $order->payment_method === 'cod' && $order->payment_status === 'pending' ? 'Cash on Delivery' : ucfirst($order->payment_status) }}
                </span>
            </div>
        </div>

        <!-- Bill To / Order info -->
        <div class="info-panel">
            <div class="info-col">
                <div class="info-label">Billed To</div>
                <p><strong>{{ $order->name }}</strong></p>
                <p>{{ $order->address }}</p>
                <p>Phone: {{ $order->phone }}</p>
                @if ($order->email)
                    <p>Email: {{ $order->email }}</p>
                @endif
            </div>
            <div class="info-col">
                <div class="info-label">Order Details</div>
                <p><strong>Invoice Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                <p>
                    <strong>Payment Method:</strong>
                    @if (strtolower($order->payment_method ?? '') === 'cod')
                        Cash on Delivery
                    @elseif (strtolower($order->payment_method ?? '') === 'bkash')
                        bKash
                    @else
                        {{ strtoupper($order->payment_method ?? 'N/A') }}
                    @endif
                </p>
                @if ($order->bkash_number)
                    <p><strong>bKash Number:</strong> {{ $order->bkash_number }}</p>
                @endif
                @if ($order->bkash_trx_id)
                    <p><strong>bKash Trx ID:</strong> {{ $order->bkash_trx_id }}</p>
                @endif
                <p><strong>Delivery Zone:</strong> {{ ucfirst(str_replace('_', ' ', $order->delivery_zone)) }}</p>
            </div>
        </div>

        <!-- Items -->
        <table class="items">
            <thead>
                <tr>
                    <th style="width:50%;">Book</th>
                    <th class="num" style="width:16%;">Price</th>
                    <th class="num" style="width:10%;">Qty</th>
                    <th class="num" style="width:24%;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td class="item-title">{{ $item->title }}</td>
                        <td class="num">Tk {{ number_format($item->price) }}</td>
                        <td class="num">{{ $item->quantity }}</td>
                        <td class="num">Tk {{ number_format($item->subtotal) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <table class="totals">
            <tr>
                <td class="label">Subtotal</td>
                <td class="value">Tk {{ number_format($order->total_amount - $order->delivery_charge) }}</td>
            </tr>
            <tr>
                <td class="label">Delivery Charge ({{ ucfirst(str_replace('_', ' ', $order->delivery_zone)) }})</td>
                <td class="value">Tk {{ number_format($order->delivery_charge) }}</td>
            </tr>
            <tr class="grand">
                <td class="label">Total Amount</td>
                <td class="value">Tk {{ number_format($order->total_amount) }}</td>
            </tr>
        </table>

        <!-- Thanks -->
        <div class="thanks">
            <div class="thanks-title">Thank you for your order!</div>
            <div class="thanks-note">This is a system-generated invoice and does not require a signature.</div>
        </div>

    </div>

    <div class="footer-strip">
        {{ config('app.name') }} &nbsp;<span>&bull;</span>&nbsp; Book Order Invoice &nbsp;<span>&bull;</span>&nbsp; {{ $order->invoice }}
    </div>
</body>

</html>
