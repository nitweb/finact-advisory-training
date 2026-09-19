@extends('backend.admin.master')

@section('admin_title', $title)

@section('admin_content')

    <div class="main-content">

        <section class="section">

            <div class="section-body">

                <div class="row">

                    <div class="col-12">

                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ $title }} — {{ $order->invoice }}</h4>
                                <h4>
                                    <a href="{{ route('admin.book.order.invoice', $order->id) }}" target="_blank" class="btn btn-outline-secondary"><i class="fas fa-print"></i> Print Invoice</a>
                                    <a href="{{ route('admin.book.order.invoice.pdf', $order->id) }}" class="btn btn-outline-primary"><i class="fas fa-file-pdf"></i> Download PDF</a>
                                    <a href="{{ URL::previous() }}" class="btn btn-outline-dark"><i class="fas fa-arrow-left"></i> Back</a>
                                </h4>
                            </div>

                            <div class="card-body">

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <p><strong>Name:</strong> {{ $order->name }}</p>
                                        <p><strong>Phone:</strong> {{ $order->phone }}</p>
                                        <p><strong>Email:</strong> {{ $order->email ?? '—' }}</p>
                                        <p><strong>Address:</strong> {{ $order->address }}</p>
                                        <p><strong>Delivery Zone:</strong> {{ $order->delivery_zone ? \App\Inc\Settings::getDeliveryZones()[$order->delivery_zone] ?? ucfirst(str_replace('_', ' ', $order->delivery_zone)) : '—' }}</p>
                                        <p><strong>Delivery Charge:</strong> ৳ {{ number_format($order->delivery_charge) }}</p>
                                        <p><strong>Note:</strong> {{ $order->note ?? '—' }}</p>
                                    </div>
                                    <div class="col-md-6">
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
                                        <p><strong>bKash Number:</strong> {{ $order->bkash_number ?? '—' }}</p>
                                        <p><strong>bKash Trx ID:</strong> {{ $order->bkash_trx_id ?? '—' }}</p>
                                        <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                                        <p>
                                            <strong>Payment Status:</strong>
                                            <select id="payment_status" class="form-control selectric" style="max-width:200px; display:inline-block;" data-url="{{ route('admin.book.order.payment.status', $order->id) }}">
                                                @foreach (['pending', 'paid', 'failed', 'cancelled'] as $ps)
                                                    <option value="{{ $ps }}" {{ $order->payment_status == $ps ? 'selected' : '' }}>{{ ucfirst($ps) }}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                        <p>
                                            <strong>Order Status:</strong>
                                            <select id="order_status" class="form-control selectric" style="max-width:200px; display:inline-block;" data-url="{{ route('admin.book.order.status', $order->id) }}">
                                                @foreach (['pending', 'processing', 'completed', 'cancelled'] as $status)
                                                    <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                </div>

                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Book</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->items as $item)
                                            <tr>
                                                <td>{{ $item->title }}</td>
                                                <td>
                                                    @if ($item->discount_percent > 0 && $item->original_price)
                                                        <del class="text-muted">৳ {{ number_format($item->original_price) }}</del><br>
                                                    @endif
                                                    ৳ {{ number_format($item->price) }}
                                                    @if ($item->discount_percent > 0)
                                                        <span class="badge bg-danger">-{{ $item->discount_percent }}%</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>৳ {{ number_format($item->subtotal) }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3" class="text-end">Subtotal</td>
                                            <td>৳ {{ number_format($order->total_amount - $order->delivery_charge) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end">Delivery Charge</td>
                                            <td>৳ {{ number_format($order->delivery_charge) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Total</strong></td>
                                            <td><strong>৳ {{ number_format($order->total_amount) }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>

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
        $('#payment_status').on('change', function() {
            var select = $(this);
            var previous = '{{ $order->payment_status }}';
            $.ajax({
                url: select.data('url'),
                type: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    payment_status: select.val()
                },
                success: function(res) {
                    if (res.success) {
                        alert('Payment status updated to ' + res.label + '. Stock adjusted where needed.');
                        location.reload();
                    }
                },
                error: function(xhr) {
                    alert((xhr.responseJSON && xhr.responseJSON.message) || 'Could not update payment status.');
                    select.val(previous);
                }
            });
        });

        $('#order_status').on('change', function() {
            var url = $(this).data('url');
            var status = $(this).val();
            $.ajax({
                url: url,
                type: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(res) {
                    if (res.success) {
                        alert('Status updated to ' + res.label);
                    }
                }
            });
        });
    </script>
@endsection
