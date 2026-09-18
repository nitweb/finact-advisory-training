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
                                        <p><strong>Note:</strong> {{ $order->note ?? '—' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
                                        <p><strong>bKash Payment ID:</strong> {{ $order->bkash_payment_id ?? '—' }}</p>
                                        <p><strong>bKash Trx ID:</strong> {{ $order->bkash_trx_id ?? '—' }}</p>
                                        <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                                        <p>
                                            <strong>Order Status:</strong>
                                            <select id="order_status" class="form-control" style="max-width:200px; display:inline-block;" data-url="{{ route('admin.book.order.status', $order->id) }}">
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
                                                <td>৳ {{ number_format($item->price) }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>৳ {{ number_format($item->subtotal) }}</td>
                                            </tr>
                                        @endforeach
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
