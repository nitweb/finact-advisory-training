{{-- resources/views/backend/training/edit.blade.php --}}

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

                                <form id="form" action="{{ route('admin.training.update') }}" method="post" enctype="multipart/form-data" data-parsley-validate>
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $training_info->id }}">

                                    <div class="form-group row">

                                        {{-- Image --}}
                                        <div class="col-md-12 mb-3">
                                            <label class="col-form-label">Academy Image [850px by 400px]</label>
                                            <div id="image-preview" class="image-preview">
                                                <label for="image-upload" id="image-label">Choose File</label>
                                                <input type="file" name="training_image" id="image-upload">
                                                <div class="table_slider_update_image" style="background-image: url({{ asset($training_info->training_image) }}); background-size: cover; background-position: center;" id="imageShow"></div>
                                            </div>
                                        </div>

                                        {{-- Title --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">Title</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $training_info->title) }}" required data-parsley-required-message="Title is required*">
                                            @error('title')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Slug --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">Slug</label>
                                            <input type="text" class="form-control" name="slug" value="{{ old('slug', $training_info->slug) }}">
                                        </div>

                                        {{-- Type --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">Academy Type</label>
                                            <select class="form-control selectric" name="type">
                                                <option value="" disabled>— Select Type —</option>
                                                <option value="online" {{ old('type', $training_info->type) == 'online' ? 'selected' : '' }}>Online</option>
                                                <option value="offline" {{ old('type', $training_info->type) == 'offline' ? 'selected' : '' }}>Offline</option>
                                            </select>
                                        </div>

                                        {{-- Certification --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">Certification</label>
                                            <input type="text" class="form-control" name="certification" value="{{ old('certification', $training_info->certification) }}" placeholder="Industry-recognized credential">
                                        </div>

                                        {{-- Course Start --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">Course Start</label>
                                            <input type="date" class="form-control" name="course_start" value="{{ old('course_start', $training_info->course_start) }}">
                                        </div>

                                        {{-- Registration Deadline --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">Registration Deadline</label>
                                            <input type="date" class="form-control" name="registration_deadline" value="{{ old('registration_deadline', $training_info->registration_deadline) }}">
                                        </div>

                                        {{-- Duration --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">Duration (Hours)</label>
                                            <input type="number" min="0" class="form-control" name="duration" value="{{ old('duration', $training_info->duration) }}">
                                        </div>

                                        {{-- No. of Classes --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">No. of Classes</label>
                                            <input type="number" min="1" class="form-control" name="no_of_classes" value="{{ old('no_of_classes', $training_info->no_of_classes) }}">
                                        </div>

                                        {{-- Regular Fee --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">
                                                Regular Fee <span style="color:red;">(leave empty if no discount)</span>
                                            </label>
                                            <input type="number" min="0" class="form-control" name="regular_fee" value="{{ old('regular_fee', $training_info->regular_fee) }}">
                                        </div>

                                        {{-- Registration Fee --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="col-form-label">Registration Fee</label>
                                            <input type="number" min="0" class="form-control" name="registration_fee" value="{{ old('registration_fee', $training_info->registration_fee) }}">
                                        </div>

                                        {{-- Trainers --}}
                                        <div class="col-md-12 mb-3">
                                            <label class="col-form-label">Trainer(s)</label>
                                            @php
                                                $selectedTrainerIds = old('trainer_ids', $training_info->trainers->pluck('id')->toArray());
                                            @endphp
                                            <select class="form-control selectric @error('trainer_ids') is-invalid @enderror" name="trainer_ids[]" multiple style="height: 130px;">
                                                <option value="" disabled>— Select Trainer(s) —</option>
                                                @foreach ($trainers as $trainer)
                                                    <option value="{{ $trainer->id }}" {{ in_array($trainer->id, $selectedTrainerIds) ? 'selected' : '' }}>
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
                                            <textarea name="short_description" rows="4" class="form-control @error('short_description') is-invalid @enderror" required>{{ old('short_description', $training_info->short_description) }}</textarea>
                                            @error('short_description')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Long Description --}}
                                        <div class="col-md-12 mb-3">
                                            <label class="col-form-label">Long Description</label>
                                            <textarea class="summernote" name="long_description" required>{{ old('long_description', $training_info->long_description) }}</textarea>
                                        </div>

                                        {{-- Status --}}
                                        <div class="col-md-12 mb-3">
                                            <label class="col-form-label">Status</label>
                                            <select class="form-control selectric" name="status">
                                                <option value="active" {{ old('status', $training_info->status) == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ old('status', $training_info->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>

                                    </div>

                                    <hr style="border: 1px solid #000">

                                    <div class="form-group row">

                                        {{-- Meta Title --}}
                                        <div class="col-md-12 mb-3">
                                            <label class="col-form-label">Meta Title</label>
                                            <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title', $training_info->meta_title) }}">
                                        </div>

                                        {{-- Meta Description --}}
                                        <div class="col-md-12 mb-3">
                                            <label class="col-form-label">Meta Description</label>
                                            <textarea name="meta_description" rows="4" class="form-control">{{ old('meta_description', $training_info->meta_description) }}</textarea>
                                        </div>

                                        {{-- Meta Keyword --}}
                                        <div class="col-md-12 mb-3">
                                            <label class="col-form-label">Meta Keyword</label>
                                            <input type="text" class="form-control" name="meta_keyword" value="{{ old('meta_keyword', $training_info->meta_keyword) }}">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <button class="btn btn-primary">Update</button>
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

    <script>
        document.getElementById('form').addEventListener('submit', function(e) {

            const regularFee = parseFloat(document.querySelector('[name="regular_fee"]').value) || 0;
            const registrationFee = parseFloat(document.querySelector('[name="registration_fee"]').value) || 0;
            const regFeeInput = document.querySelector('[name="registration_fee"]');

            // আগের error সরাও
            regFeeInput.classList.remove('is-invalid');
            const oldErr = document.getElementById('reg-fee-error');
            if (oldErr) oldErr.remove();

            // Check: Registration Fee > Regular Fee হলে block করো
            if (regularFee > 0 && registrationFee > regularFee) {
                e.preventDefault();

                regFeeInput.classList.add('is-invalid');

                const err = document.createElement('span');
                err.id = 'reg-fee-error';
                err.className = 'invalid-feedback d-block';
                err.textContent = '⚠️ Registration Fee cannot be greater than Regular Fee (' + regularFee + ').';
                regFeeInput.parentNode.appendChild(err);

                regFeeInput.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                regFeeInput.focus();
            }

        });
    </script>

@endsection

@section('footer_script')
    <script>
        $(document).ready(function() {
            $('#image-upload').change(function(e) {
                $('#imageShow').css('background-image', `url(${URL.createObjectURL(e.target.files[0])})`);
            });
        });
    </script>
@endsection
