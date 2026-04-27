{{-- resources/views/backend/training/add.blade.php --}}

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
                                    <a href="{{ route('admin.training.list') }}" class="btn btn-outline-primary">
                                        <i class="fas fa-list"></i> List
                                    </a>
                                    <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">
                                        <i class="fas fa-arrow-left"></i> Back
                                    </a>
                                </h4>
                            </div>

                            <div class="card-body">
                                @include('widgets.errors')
                                @include('widgets.success')

                                <form id="form" action="{{ route('admin.training.store') }}" method="post" enctype="multipart/form-data" data-parsley-validate>
                                    @csrf

                                    <div class="form-group row">

                                        {{-- Image --}}
                                        <div class="col-md-12 mb-3">
                                            <label class="col-form-label">Training Image [850px by 400px]</label>
                                            <div id="image-preview" class="image-preview">
                                                <label for="image-upload" id="image-label">Choose File</label>
                                                <input type="file" name="training_image" id="image-upload" required data-parsley-required-message="Training Image is required*" />
                                            </div>
                                        </div>

                                        {{-- Title --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">Title</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required data-parsley-required-message="Title is required*">
                                            @error('title')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Slug --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">Slug</label>
                                            <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug') }}">
                                        </div>

                                        {{-- Type --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">Training Type</label>
                                            <select class="form-control selectric" name="type">
                                                <option value="" disabled selected>— Select Type —</option>
                                                <option value="online" {{ old('type') == 'online' ? 'selected' : '' }}>Online</option>
                                                <option value="offline" {{ old('type') == 'offline' ? 'selected' : '' }}>Offline</option>
                                            </select>
                                        </div>

                                        {{-- Certification --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">Certification</label>
                                            <input type="text" class="form-control" name="certification" value="{{ old('certification') }}" placeholder="Industry-recognized credential">
                                        </div>

                                        {{-- Course Start --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">Course Start</label>
                                            <input type="date" class="form-control" name="course_start" value="{{ old('course_start') }}">
                                        </div>

                                        {{-- Registration Deadline --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">Registration Deadline</label>
                                            <input type="date" class="form-control" name="registration_deadline" value="{{ old('registration_deadline') }}">
                                        </div>

                                        {{-- Duration --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">Duration (Hours)</label>
                                            <input type="number" min="0" class="form-control" name="duration" value="{{ old('duration') }}">
                                        </div>

                                        {{-- No. of Classes --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">No. of Classes</label>
                                            <input type="number" min="1" class="form-control" name="no_of_classes" value="{{ old('no_of_classes') }}">
                                        </div>

                                        {{-- Regular Fee --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">
                                                Regular Fee <span style="color:red;">(leave empty if no discount)</span>
                                            </label>
                                            <input type="number" min="0" class="form-control" name="regular_fee" value="{{ old('regular_fee') }}">
                                        </div>

                                        {{-- Registration Fee --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">Registration Fee</label>
                                            <input type="number" min="0" class="form-control" name="registration_fee" value="{{ old('registration_fee') }}">
                                        </div>

                                        {{-- Trainers --}}
                                        <div class="col-md-12 mb-3">
                                            <label class="col-form-label">Trainer(s)</label>
                                            <select class="form-control selectric @error('trainer_ids') is-invalid @enderror" name="trainer_ids[]" multiple style="height: 130px;">
                                                <option value="" disabled>— Select Trainer(s) —</option>
                                                @foreach ($trainers as $trainer)
                                                    <option value="{{ $trainer->id }}" {{ is_array(old('trainer_ids')) && in_array($trainer->id, old('trainer_ids')) ? 'selected' : '' }}>
                                                        {{ $trainer->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted d-block mt-2">
                                                Hold <kbd>Ctrl</kbd> (Windows) or <kbd>Cmd</kbd> (Mac) to select multiple.
                                            </small>
                                            @error('trainer_ids')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Short Description --}}
                                        <div class="col-md-12 mb-3">
                                            <label class="col-form-label">Short Description</label>
                                            <textarea name="short_description" rows="4" class="form-control @error('short_description') is-invalid @enderror" required data-parsley-required-message="Short description is required*">{{ old('short_description') }}</textarea>
                                            @error('short_description')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Long Description --}}
                                        <div class="col-md-12 mb-3">
                                            <label class="col-form-label">Long Description</label>
                                            <textarea class="summernote" name="long_description" required data-parsley-required-message="Long description is required*">{{ old('long_description') }}</textarea>
                                        </div>

                                    </div>

                                    <hr style="border: 1px solid #000">

                                    <div class="form-group row">

                                        {{-- Meta Title --}}
                                        <div class="col-md-12 mb-3">
                                            <label class="col-form-label">Meta Title</label>
                                            <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}">
                                        </div>

                                        {{-- Meta Description --}}
                                        <div class="col-md-12 mb-3">
                                            <label class="col-form-label">Meta Description</label>
                                            <textarea name="meta_description" rows="4" class="form-control">{{ old('meta_description') }}</textarea>
                                        </div>

                                        {{-- Meta Keyword --}}
                                        <div class="col-md-12 mb-3">
                                            <label class="col-form-label">Meta Keyword</label>
                                            <input type="text" class="form-control" name="meta_keyword" value="{{ old('meta_keyword') }}">
                                        </div>

                                        <div class="col-md-12 mb-3">
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
