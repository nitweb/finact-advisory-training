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
                                    <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">
                                        <i class="fas fa-arrow-left"></i> Back
                                    </a>
                                </h4>
                            </div>

                            <div class="card-body">

                                @include('widgets.errors')

                                <form id="form" action="{{ route('admin.service.update') }}" method="post" enctype="multipart/form-data" data-parsley-validate>

                                    @csrf

                                    <input type="hidden" name="category_id" value="1">

                                    <input type="hidden" name="icon" value="#!">

                                    {{-- <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Service Category</label>
                                            <select class="form-control selectric @error('category_id') is-invalid @enderror" name="category_id" required>
                                                <option value="" disabled>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $service->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <input type="hidden" name="id" value="{{ $service->id }}">

                                    {{-- <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Icon <span><a href="{{ route('admin.setting.font-awesome') }}" target="_blank;">[For Icon Click Here]</a></span></label>
                                            <input type="text" class="form-control" name="icon" value="{{ $serviceDetails->icon ?? '' }}" required>
                                        </div>
                                    </div> --}}

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Service Image [848px by 566px]</label>
                                            <div id="image-preview" class="image-preview">
                                                <label for="image-upload" id="image-label">Choose File</label>
                                                <input type="file" name="service_image" id="image-upload">
                                                <div class="table_slider_update_image" style="background-image: url({{ asset($service->serviceDetail->service_image) }}); background-size: cover; background-position: center;" id="imageShow"></div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Service Banner Image [1600px by 407px]</label>
                                            <div id="banner-image-preview" class="image-preview">
                                                <label for="banner-image-upload" id="banner-image-label">Choose File</label>
                                                <input type="file" name="service_banner_image" id="banner-image-upload">
                                                @if ($service->serviceDetail->service_banner_image != null)
                                                    <div class="table_slider_update_image" style="background-image: url({{ asset($service->serviceDetail->service_banner_image) }}); background-size: cover; background-position: center;" id="bannerImageShow"></div>
                                                @else
                                                    <div class="table_slider_update_image" id="bannerImageShow"></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Title</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $service->title }}" required data-parsley-required-message="Service Title is required*">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Slug Title</label>
                                            <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ $service->slug }}" required data-parsley-required-message="Slug Title is required*">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Short Description</label>
                                            <textarea name="short_description" class="form-control">{{ $serviceDetails->short_description ?? '' }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Long Description</label>
                                            <textarea class="summernote" name="long_description" required data-parsley-required-message="Service Long Description is required*">{{ $service->serviceDetail->long_description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Status</label>
                                            <select class="form-control selectric" name="status">
                                                <option value="">- SELECT STATUS -</option>
                                                @if (is_array(App\Inc\Settings::getGlobalStatus()))
                                                    @foreach (App\Inc\Settings::getGlobalStatus() as $statusKey => $statusName)
                                                        <option value="{{ $statusKey }}" {{ $service->status == $statusKey ? 'selected' : '' }}>
                                                            {{ $statusName }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <hr class="mb-4" style="border: 1px solid #000">

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Meta Title</label>
                                            <input type="text" class="form-control" name="meta_title" value="{{ $service->serviceDetail->meta_title }}">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Meta Description</label>
                                            <textarea name="meta_description" rows="4" class="form-control">{{ $service->serviceDetail->meta_description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Meta Keyword</label>
                                            <input type="text" class="form-control" name="meta_keyword" value="{{ $service->serviceDetail->meta_keyword }}">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label"></label>
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
            $('#banner-image-upload').change(function(e) {
                $('#bannerImageShow').css('background-image', `url(${URL.createObjectURL(e.target.files[0])})`);
            });
            
        });
    </script>

@endsection
