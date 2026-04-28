@extends('backend.admin.master')
@section('admin_title', $title)

@section('admin_content')

    <style>
        select.enrollment-status,
        select.enrollment-status option {
            color: #000 !important;
            background: #fff !important;
        }

        .table-scroll-wrap {
            max-height: 520px;
            overflow-y: auto;
        }

        .table-scroll-wrap thead th {
            position: sticky;
            top: 0;
            z-index: 2;
            background: #fff;
        }
    </style>

    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ $title }}</h4>
                                <a href="{{ URL::previous() }}" class="btn btn-outline-dark">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                            </div>

                            <div class="card-body">
                                @include('widgets.errors')
                                @include('widgets.success')

                                <div class="table-responsive table-scroll-wrap">
                                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Invoice</th>
                                                <th>Training</th>
                                                <th>Student</th>
                                                <th>Phone</th>
                                                <th>bKash TRX</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($enrollment_info as $key => $item)
                                                @php
                                                    $badge = match ($item->status) {
                                                        'paid' => 'success',
                                                        'pending' => 'info',
                                                        'failed' => 'danger',
                                                        'cancelled' => 'secondary',
                                                        default => 'dark',
                                                    };
                                                @endphp
                                                <tr>
                                                    <td>{{ $enrollment_info->count() - $key }}</td>
                                                    <td><small>{{ $item->invoice }}</small></td>
                                                    <td>
                                                        {{ $item->training?->title ?? 'N/A' }}
                                                        @if ($item->training?->course_start)
                                                            <div class="text-muted" style="font-size:11px;">
                                                                {{ \Carbon\Carbon::parse($item->training->course_start)->format('d M Y') }}
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->phone }}</td>
                                                    <td><small>{{ $item->bkash_trx_id ?? '-' }}</small></td>
                                                    <td>৳ {{ number_format($item->amount) }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center" style="gap:8px;">
                                                            <span id="badge-{{ $item->id }}" class="badge badge-{{ $badge }}">
                                                                {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                                            </span>
                                                            <select class="form-control form-control-sm enrollment-status selectric" style="width:140px;" data-id="{{ $item->id }}" data-url="{{ route('admin.training.enrollment.status', $item->id) }}" data-old="{{ $item->status }}">
                                                                <option value="pending" @selected($item->status === 'pending')>Pending</option>
                                                                <option value="paid" @selected($item->status === 'paid')>Paid</option>
                                                                <option value="failed" @selected($item->status === 'failed')>Failed</option>
                                                                <option value="cancelled" @selected($item->status === 'cancelled')>Cancelled</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="table_actions" style="display:flex; gap:8px;">
                                                            <a href="{{ route('admin.training.enrollment.show', $item->id) }}" class="btn btn-outline-primary btn-sm" title="View">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <button type="button" class="btn btn-outline-danger btn-sm" data-del="{{ route('admin.training.enrollment.delete', $item->id) }}" data-bs-toggle="modal" data-bs-target="#enrollment_delete_modal" data-name="{{ $item->invoice }}" title="Delete">
                                                                <i class="far fa-trash-alt"></i>
                                                            </button>
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

    {{-- Delete Modal --}}
    <div class="modal fade" id="enrollment_delete_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="deleteModalTitle"></h3>
                </div>
                <div class="modal-body">
                    <h5>Are you sure you want to delete this enrollment?</h5>
                </div>
                <div class="modal-footer" style="justify-content: space-between">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="final_delete_form" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Confirm Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_script')
    <script>
        $('#enrollment_delete_modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            $('#deleteModalTitle').html('Delete <span class="text-danger">' + button.data('name') + '</span>');
            $('#final_delete_form').attr('action', button.data('del'));
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });

        $(document).on('change', '.enrollment-status', function() {
            const select = $(this);
            const id = select.data('id');
            const oldStatus = select.data('old');

            select.prop('disabled', true);

            $.ajax({
                url: select.data('url'),
                method: 'PATCH',
                data: {
                    status: select.val()
                },
                success: function(res) {
                    const badge = $('#badge-' + id);
                    badge.text(res.label);
                    badge.removeClass(function(i, c) {
                        return (c.match(/(^|\s)badge-\S+/g) || []).join(' ');
                    }).addClass('badge-' + res.badge);
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
    </script>
@endsection
