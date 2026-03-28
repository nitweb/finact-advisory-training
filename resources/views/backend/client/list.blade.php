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
                                    <a href="{{ route('admin.client.add') }}" class="btn btn-outline-primary"><i class="fas fa-plus"></i> Add</a>
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
                                                <th>Image</th>
                                                <th>Title</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($clients as $key => $item)
                                                <tr>
                                                    <td>{{ $clients->count() - $key }}</td>
                                                    <td>
                                                        <div class="table_about_us_list_image" style="background-image: url({{ asset($item->image) }});"></div>
                                                    </td>
                                                    <td>{{ $item->title }}</td>
                                                    <td>
                                                        <div class="badges">
                                                            @if ($item->status == 'active')
                                                                <span class="badge badge-success">Active</span>
                                                            @elseif ($item->status == 'inactive')
                                                                <span class="badge badge-danger">Inactive</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="table_actions d-flex gap-2">
                                                            <a href="{{ route('admin.client.edit', $item->id) }}" class="btn btn-outline-primary" alt="Edit" title="Edit"><i class="far fa-edit"></i></a>
                                                            <a href="#!" class="btn btn-outline-danger" data-del="{{ route('admin.client.delete', $item->id) }}" data-bs-toggle="modal" data-bs-target="#client_delete_modal" data-id="{{ $item->id }}" data-name="{{ $item->name }}" alt="Delete" title="Delete"><i class="far fa-trash-alt"></i></a>
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
    <div class="modal fade" id="client_delete_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel"></h3>
                </div>
                <div class="modal-body">
                    <h5> Are you sure you want to delete this Client List?</h5>
                </div>
                <div class="modal-footer" style="justify-content: space-between">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="" id="final_delete" class="btn btn-outline-danger">Confirm Delete</a>
                </div>
            </div>
        </div>
    </div>
    {{-- End: Delete Modal --}}

@endsection

@section('footer_script')
    <script>
        $('#client_delete_modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var modal = $(this)
            modal.find('.modal-title').html('Delete <span class="text-danger">' + name + '</span>');
            $('#final_delete').attr('href', button.attr('data-del'))
        })
    </script>
@endsection
