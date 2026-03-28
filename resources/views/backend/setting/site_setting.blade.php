@extends('backend.admin.master')

@section('admin_title', $title)

@section('admin_content')

    <div class="main-content">

        <section class="section">

            <div class="section-body">

                @include('widgets.errors')

                <form id="form" action="{{ route('admin.setting.update') }}" method="post" enctype="multipart/form-data" data-parsley-validate>

                    @csrf

                    <input type="hidden" name="id" value="{{ $site_setting->id }}">

                    <div class="row">

                        <div class="col-12 text-end mb-4">
                            <h4>
                                <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark"> <i class="fas fa-arrow-left"></i> Back</a>
                            </h4>
                        </div>

                        <div class="col-6">

                            <div class="card">

                                <div class="card-header d-flex justify-content-between">
                                    <h4>{{ $title }}</h4>
                                </div>

                                <div class="card-body">

                                    @include('widgets.errors')



                                    <div class="form-group row mb-4">
                                        <div class="col-md-12">
                                            <label class="col-form-label">Header Logo</label>
                                            <div id="image-preview" class="image-preview">
                                                <label for="image-upload" id="image-label">Choose File</label>
                                                <input type="file" name="header_logo" id="image-upload" />
                                                <div class="table_slider_update_image" style="background-image: url({{ asset($site_setting->header_logo) }}); background-size: cover; background-position: center;" id="imageShow"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-12">
                                            <label class="col-form-label">Footer Logo</label>
                                            <div id="image-preview" class="image-preview">
                                                <label for="image-upload-footer" id="image-label">Choose File</label>
                                                <input type="file" name="footer_logo" id="image-upload-footer" />
                                                <div class="table_slider_update_image" style="background-image: url({{ asset($site_setting->footer_logo) }}); background-size: cover; background-position: center;" id="imageShowFooter"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-12">
                                            <label class="col-form-label">Copyright</label>
                                            <input type="text" class="form-control @error('copyright') is-invalid @enderror" name="copyright" value="{{ $site_setting->copyright }}" data-parsley-required-message="Site Copyright is required*" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-12">
                                            <label class="col-form-label">Footer Text</label>
                                            <textarea class="form-control @error('footer_text') is-invalid @enderror" name="footer_text" data-parsley-required-message="Site Footer Text is required*" required>{{ $site_setting->footer_text }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-12">
                                            <label class="col-form-label">Facebook</label>
                                            <input type="text" class="form-control" name="facebook" value="{{ $site_setting->facebook }}">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-12">
                                            <label class="col-form-label">YouTube</label>
                                            <input type="text" class="form-control" name="youtube" value="{{ $site_setting->youtube }}">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-12">
                                            <label class="col-form-label">Linkedin</label>
                                            <input type="text" class="form-control" name="linkedin" value="{{ $site_setting->linkedin }}">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-12">
                                            <label class="col-form-label">Instagram</label>
                                            <input type="text" class="form-control" name="instagram" value="{{ $site_setting->instagram }}">
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-6">

                            <div class="card">

                                <div class="card-header d-flex justify-content-between">
                                    <h4>Contact Info</h4>
                                </div>

                                <div class="card-body">

                                    <div class="form-group row mb-4">
                                        <div class="col-md-12">
                                            <label class="col-form-label">Head Office Address</label>
                                            <textarea class="form-control @error('head_address') is-invalid @enderror" name="head_address" data-parsley-required-message="Site Address is required*" required>{{ $site_setting->head_address }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-12">
                                            <label class="col-form-label">Branch Address</label>
                                            <textarea class="form-control @error('branch_address') is-invalid @enderror" name="branch_address" data-parsley-required-message="Site Address is required*" required>{{ $site_setting->branch_address }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-12">
                                            <label class="col-form-label">Site Phone</label>
                                            <input type="text" class="form-control @error('site_phone') is-invalid @enderror" name="site_phone" value="{{ $site_setting->site_phone }}" data-parsley-required-message="Site Phone is required*" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-12">
                                            <label class="col-form-label">Site Alternative Phone</label>
                                            <input type="text" class="form-control" name="site_phone_alter" value="{{ $site_setting->site_phone_alter }}">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-12">
                                            <label class="col-form-label">Site Email</label>
                                            <input type="text" class="form-control @error('site_email') is-invalid @enderror" name="site_email" value="{{ $site_setting->site_email }}" data-parsley-required-message="Site Email is required*" required>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-12">
                                <label class="col-form-label"></label>
                                <button class="btn btn-primary">Update</button>
                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </section>

    </div>

    <script>
        $(document).ready(function() {
            $('#image-upload').change(function(e) {
                $('#imageShow').css('background-image', `url(${URL.createObjectURL(e.target.files[0])})`);
            });

            $('#image-upload-footer').change(function(e) {
                $('#imageShowFooter').css('background-image', `url(${URL.createObjectURL(e.target.files[0])})`);
            });
        });
    </script>

@endsection
