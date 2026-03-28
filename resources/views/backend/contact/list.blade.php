@extends('backend.admin.master')

@section('admin_title', $title )

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
                                                    <th>Email</th>
                                                    <th>Phone</th>
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
                                                        <td>{{ $item->email }}</td>
                                                        <td>{{ $item->phone }}</td>
                                                        <td>
                                                            <div class="table_actions">
                                                                <a href="#" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#contactMessageModal" data-subject="{{ $item->subject }}" data-message="{{ $item->message }}">
                                                                    <i class="fas fa-eye"></i> View Message
                                                                </a>

                                                                <a href="{{ route('admin.contact.delete', $item->id) }}" class="btn btn-outline-danger">
                                                                    <i class="fas fa-trash"></i> Delete
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <button type="submit" class="btn btn-outline-danger" id="deleteSelectedButton" disabled>Delete Selected</button>
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
                <div class="modal-body mt-4">
                    <div>
                        <h6>Subject:</h6>
                        <p id="modal-subject"></p> <!-- Set ID for JavaScript targeting -->
                    </div>
                    <div>
                        <h6>Message:</h6>
                        <p id="modal-message"></p> <!-- Set ID for JavaScript targeting -->
                    </div>
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
        var contactMessageModal = document.getElementById('contactMessageModal');
        contactMessageModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget;

            // Extract info from data-* attributes
            var subject = button.getAttribute('data-subject');
            var message = button.getAttribute('data-message');

            // Update the modal's content
            var modalSubject = contactMessageModal.querySelector('#modal-subject');
            var modalMessage = contactMessageModal.querySelector('#modal-message');

            // Set the text content for subject and message
            modalSubject.textContent = subject;
            modalMessage.textContent = message;
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
