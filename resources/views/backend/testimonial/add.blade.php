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
                                    <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark"><i class="fas fa-arrow-left"></i> Back</a>
                                </h4>
                            </div>

                            <div class="card-body">

                                @include('widgets.errors')

                                <form id="form" action="{{ route('admin.testimonial.store') }}" method="post" enctype="multipart/form-data" data-parsley-validate>

                                    @csrf

                                    {{-- Client Image --}}
                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Client Image [150px × 150px]</label>
                                            <div id="image-preview" class="image-preview">
                                                <label for="image-upload" id="image-label">Choose File</label>
                                                <input type="file" name="client_image" id="image-upload" required data-parsley-required-message="Client image is required*" />
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Client Name --}}
                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Client Name</label>
                                            <input type="text" class="form-control @error('client_name') is-invalid @enderror" name="client_name" value="{{ old('client_name') }}" required data-parsley-required-message="Client name is required*">
                                        </div>
                                    </div>

                                    {{-- Designation --}}
                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Designation</label>
                                            <input type="text" class="form-control @error('client_designation') is-invalid @enderror" name="client_designation" value="{{ old('client_designation') }}" required data-parsley-required-message="Designation is required*">
                                        </div>
                                    </div>

                                    {{-- Review Text --}}
                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Review Text</label>
                                            <textarea class="form-control @error('review_text') is-invalid @enderror" name="review_text" rows="4" required data-parsley-required-message="Review text is required*">{{ old('review_text') }}</textarea>
                                        </div>
                                    </div>

                                    {{-- Rating --}}
                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Rating (1 - 5)</label>
                                            <select class="form-control selectric" name="rating" required>
                                                <option value="">- SELECT RATING -</option>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                                                        {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Submit --}}
                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
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
