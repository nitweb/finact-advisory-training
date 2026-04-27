@extends('backend.admin.master')

@section('admin_title', 'Add ' . $title)

@section('admin_content')

    <div class="main-content">

        <section class="section">

            <div class="section-body">

                <div class="row">

                    <div class="col-12">

                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Add {{ $title }}</h4>
                                <h4>
                                    <a href="{{ route('admin.trainer.list') }}" class="btn btn-outline-primary"><i class="fas fa-list"></i> {{ $title }} List</a>
                                    <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark"><i class="fas fa-arrow-left"></i> Back</a>
                                </h4>
                            </div>

                            <div class="card-body">

                                @include('widgets.errors')
                                @include('widgets.success')

                                <form id="form" action="{{ route('admin.trainer.store') }}" method="post" enctype="multipart/form-data" data-parsley-validate>

                                    @csrf

                                    <div class="form-group row">

                                        <div class="col-md-12 mb-3">
                                            <label class="col-form-label">Trainer Image [295px by 325px]</label>
                                            <div id="image-preview" class="image-preview">
                                                <label for="image-upload" id="image-label">Choose File</label>
                                                <input type="file" name="trainer_image" id="image-upload" required data-parsley-required-message="Trainer Image is required*" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">Trainer Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required data-parsley-required-message="Trainer Name is required*">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">Trainer Slug</label>
                                            <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug') }}" required data-parsley-required-message="Trainer Slug is required*">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">Trainer Designation</label>
                                            <input type="text" class="form-control @error('designation') is-invalid @enderror" name="designation" value="{{ old('designation') }}" required data-parsley-required-message="Trainer Designation is required*">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">No of Experience</label>
                                            <input type="text" class="form-control @error('no_of_experience') is-invalid @enderror" name="no_of_experience" value="{{ old('no_of_experience') }}" required data-parsley-required-message="No of Experience is required*">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="col-form-label">Trainer Description</label>
                                            <textarea class="summernote" name="description" required data-parsley-required-message="Trainer Description is required*">{{ old('description') }}</textarea>
                                        </div>

                                    </div>

                                    <hr class="mb-4" style="border: 1px solid #000">

                                    <div class="form-group row mb-4">

                                        <div class="col-md-8 mb-3">
                                            <label class="col-form-label">Meta Title</label>
                                            <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}">
                                        </div>

                                        <div class="col-md-8 mb-3">
                                            <label class="col-form-label">Meta Description</label>
                                            <textarea name="meta_description" rows="4" class="form-control">{{ old('meta_description') }}</textarea>
                                        </div>

                                        <div class="col-md-8 mb-3">
                                            <label class="col-form-label">Meta Keyword</label>
                                            <input type="text" class="form-control" name="meta_keyword" value="{{ old('meta_keyword') }}">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label"></label>
                                            <button class="btn btn-primary">Create {{ $title }}</button>
                                        </div>
                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>

@endsection
