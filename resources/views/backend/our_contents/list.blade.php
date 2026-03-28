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
                                                <th>Title</th>
                                                <th>Image</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($our_contents as $key => $item)
                                                <tr>
                                                    <td>{{ $our_contents->count() - $key }}</td>
                                                    <td><strong>{{ $item->title }}</strong></td>
                                                    <td>
                                                        <div class="table_slider_list_image" style="background-image: url({{ asset($item->image) }});"></div>
                                                    </td>
                                                    <td>{!! $item->description !!}</td>
                                                    <td>
                                                        <div class="table_actions d-flex gap-2">
                                                            <a href="{{ route('admin.our-contents.edit', $item->id) }}" class="btn btn-outline-primary" alt="Edit" title="Edit"><i class="far fa-edit"></i></a>
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
