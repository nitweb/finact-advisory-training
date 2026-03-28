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
                                    <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark"> <i class="fas fa-arrow-left"></i> Back</a>
                                </h4>
                            </div>

                            <div class="card-body">

                                @include('widgets.errors')

                                <form id="form" action="{{ route('admin.our-team.store') }}" method="post" enctype="multipart/form-data" data-parsley-validate>

                                    @csrf

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Image [300px by 280px]</label>
                                            <div id="image-preview" class="image-preview">
                                                <label for="image-upload" id="image-label">Choose File</label>
                                                <input type="file" name="team_image" id="image-upload" data-parsley-required-message="Team Image is required*" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" data-parsley-required-message="Team name is required*" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Designation</label>
                                            <input type="text" class="form-control @error('designation') is-invalid @enderror" name="designation" value="{{ old('designation') }}" data-parsley-required-message="Team designation is required*" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Description</label>
                                            <textarea class="summernote" name="description" required data-parsley-required-message="Description is required*">{{ old('description') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Type</label>
                                            <select class="form-control selectric" name="type">
                                                <option value="">- SELECT TYPE -</option>
                                                <option value="founder" {{ old('type') == 'founder' ? 'selected' : '' }}>Founder</option>
                                                <option value="top_level" {{ old('type') == 'top_level' ? 'selected' : '' }}>Top Level</option>
                                                <option value="middle_level" {{ old('type') == 'middle_level' ? 'selected' : '' }}>Middle Level</option>
                                                <option value="student_level" {{ old('type') == 'student_level' ? 'selected' : '' }}>Team Level</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label"></label>
                                            <button class="btn btn-primary">Create</button>
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
