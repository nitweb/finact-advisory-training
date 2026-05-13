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

                                <form id="form" action="{{ route('admin.testimonial.update') }}" method="post" enctype="multipart/form-data" data-parsley-validate>

                                    @csrf

                                    <input type="hidden" name="id" value="{{ $testimonial->id }}">

                                    {{-- Client Image --}}
                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Client Image [150px × 150px]</label>
                                            <div id="image-preview" class="image-preview">
                                                <label for="image-upload" id="image-label">Choose File</label>
                                                <input type="file" name="client_image" id="image-upload" />
                                                <div class="table_slider_update_image" style="background-image: url({{ asset($testimonial->client_image) }}); background-size: cover; background-position: center;" id="imageShow">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Client Name --}}
                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Client Name</label>
                                            <input type="text" class="form-control @error('client_name') is-invalid @enderror" name="client_name" value="{{ $testimonial->client_name }}" required data-parsley-required-message="Client name is required*">
                                        </div>
                                    </div>

                                    {{-- Designation --}}
                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Designation</label>
                                            <input type="text" class="form-control @error('client_designation') is-invalid @enderror" name="client_designation" value="{{ $testimonial->client_designation }}" required data-parsley-required-message="Designation is required*">
                                        </div>
                                    </div>

                                    {{-- Review Text --}}
                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Review Text</label>
                                            <textarea class="form-control @error('review_text') is-invalid @enderror" name="review_text" rows="4" required data-parsley-required-message="Review text is required*">{{ $testimonial->review_text }}</textarea>
                                        </div>
                                    </div>

                                    {{-- Rating --}}
                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Rating (1 - 5)</label>
                                            <select class="form-control selectric" name="rating" required>
                                                <option value="">- SELECT RATING -</option>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <option value="{{ $i }}" {{ $testimonial->rating == $i ? 'selected' : '' }}>
                                                        {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Status</label>
                                            <select class="form-control selectric" name="status" required>
                                                <option value="">- SELECT STATUS -</option>
                                                @if (is_array(App\Inc\Settings::getGlobalStatus()))
                                                    @foreach (App\Inc\Settings::getGlobalStatus() as $statusKey => $statusName)
                                                        <option value="{{ $statusKey }}" {{ $testimonial->status == $statusKey ? 'selected' : '' }}>
                                                            {{ $statusName }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Submit --}}
                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
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
        $(document).ready(function() {
            $('#image-upload').change(function(e) {
                $('#imageShow').css('background-image', `url(${URL.createObjectURL(e.target.files[0])})`);
            });
        });
    </script>

@endsection
