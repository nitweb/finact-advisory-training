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
                                    <form id="deleteSelectedForm" action="{{ route('admin.contact.deleteSelected') }}" method="POST">
                                        @csrf
                                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <input type="checkbox" id="selectAll" />
                                                    </th>
                                                    <th>Name</th>
                                                    <th>Organization</th>
                                                    <th>Service</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($contact_message as $key => $item)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" class="selectItem" name="ids[]" value="{{ $item->id }}">
                                                        </td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->organization ?? '—' }}</td>
                                                        <td>
                                                            @if ($item->service)
                                                                <span class="badge badge-primary">{{ $item->service }}</span>
                                                            @else
                                                                —
                                                            @endif
                                                        </td>
                                                        <td>{{ $item->created_at->format('d M Y') }}</td>
                                                        <td>
                                                            <div class="table_actions">
                                                                <a href="#" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#contactMessageModal" data-name="{{ $item->name }}" data-email="{{ $item->email }}" data-phone="{{ $item->phone ?? '—' }}" data-organization="{{ $item->organization ?? '—' }}" data-service="{{ $item->service ?? '—' }}" data-message="{{ $item->message }}">
                                                                    <i class="fas fa-eye"></i> View Message
                                                                </a>
                                                                <a href="{{ route('admin.contact.delete', $item->id) }}" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">
                                                                    <i class="fas fa-trash"></i> Delete
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <button type="submit" class="btn btn-outline-danger" id="deleteSelectedButton" onclick="return confirm('Are you sure?')" disabled>Delete Selected</button>
                                    </form>
                                </div>


                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>


    <!-- Modal -->
    <div class="modal fade" id="contactMessageModal" tabindex="-1" aria-labelledby="contactMessageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactMessageModalLabel">Contact Message Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="35%">Name</th>
                            <td id="modal-name"></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td id="modal-email"></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td id="modal-phone"></td>
                        </tr>
                        <tr>
                            <th>Organization</th>
                            <td id="modal-organization"></td>
                        </tr>
                        <tr>
                            <th>Service</th>
                            <td id="modal-service"></td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td id="modal-message"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('footer_script')
    <script>
        // View Modal
        document.getElementById('contactMessageModal').addEventListener('show.bs.modal', function(event) {
            const btn = event.relatedTarget;
            document.getElementById('modal-name').textContent = btn.getAttribute('data-name') || '—';
            document.getElementById('modal-email').textContent = btn.getAttribute('data-email') || '—';
            document.getElementById('modal-phone').textContent = btn.getAttribute('data-phone') || '—';
            document.getElementById('modal-organization').textContent = btn.getAttribute('data-organization') || '—';
            document.getElementById('modal-service').textContent = btn.getAttribute('data-service') || '—';
            document.getElementById('modal-message').textContent = btn.getAttribute('data-message') || '—';
        });
    </script>

    <script>
        document.getElementById('selectAll').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('.selectItem');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
            toggleDeleteButton();
        });

        document.querySelectorAll('.selectItem').forEach((checkbox) => {
            checkbox.addEventListener('change', function() {
                toggleDeleteButton();
            });
        });

        function toggleDeleteButton() {
            let selectedItems = document.querySelectorAll('.selectItem:checked').length;
            document.getElementById('deleteSelectedButton').disabled = selectedItems === 0;
        }
    </script>
@endsection
