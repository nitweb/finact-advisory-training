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
                                <h4>{{ $title }}</h4>
                                <h4>
                                    <a href="{{ URL::previous() }}" class="btn btn-outline-dark"><i class="fas fa-arrow-left"></i> Back</a>
                                </h4>
                            </div>

                            <div class="card-body">

                                @include('widgets.errors')
                                @include('widgets.success')

                                <div class="table-responsive">

                                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">

                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Invoice</th>
                                                <th>Customer</th>
                                                <th>Phone</th>
                                                <th>Total</th>
                                                <th>Payment</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($orders as $key => $item)
                                                <tr>
                                                    <td>{{ $orders->count() - $key }}</td>
                                                    <td>{{ $item->invoice }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->phone }}</td>
                                                    <td>৳ {{ number_format($item->total_amount) }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $item->payment_status == 'paid' ? 'success' : ($item->payment_status == 'pending' ? 'warning' : 'danger') }}">
                                                            {{ ucfirst($item->payment_status) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ ucfirst($item->status) }}</td>
                                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                                    <td>
                                                        <div class="table_actions d-flex gap-2">
                                                            <a href="{{ route('admin.book.order.show', $item->id) }}" class="btn btn-outline-primary" title="View"><i class="far fa-eye"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>

@endsection
