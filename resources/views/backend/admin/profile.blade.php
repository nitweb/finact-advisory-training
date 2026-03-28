@extends('backend.admin.master')

@section('admin_title', $title)

@section('admin_content')

    <div class="main-content">

        <section class="section">

            <div class="section-body">

                <div class="row mt-sm-4">

                    <div class="col-12 col-md-12 col-lg-4">
                        <div class="card author-box">
                            <div class="card-body">
                                <div class="author-box-center">
                                    <img alt="image" src="{{ asset($admin_profile->thumbnail) }}" class="rounded-circle author-box-picture mb-3" style="width: 100px; height: 100px;">
                                    <div class="clearfix"></div>
                                    <div class="author-box-name">
                                        <h4>{{ $admin_profile->name }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Personal Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="py-4">
                                    <p class="clearfix">
                                        <span class="float-left">
                                            Phone
                                        </span>
                                        <span class="float-right text-muted">
                                            <a href="tel:{{ $admin_profile->phone }}">{{ $admin_profile->phone }}</a>
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                            Mail
                                        </span>
                                        <span class="float-right text-muted">
                                            <a href="mailto:{{ $admin_profile->email }}">{{ $admin_profile->email }}</a>
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                            Address
                                        </span>
                                        <span class="float-right text-muted">
                                            {{ $admin_profile->address }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-8">

                        <div class="card">

                            <div class="padding-20">

                                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#editProfile" role="tab" aria-selected="true">Edit Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#changePassword" role="tab" aria-selected="false">Change Password</a>
                                    </li>
                                </ul>

                                <div class="tab-content tab-bordered" id="myTab3Content">

                                    <div class="tab-pane fade show active" id="editProfile" role="tabpanel" aria-labelledby="profile-tab2">
                                        @include('widgets.errors')
                                        @include('widgets.success')
                                        <form id="form" action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data" data-parsley-validate>
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $admin_profile->id }}">
                                            <div class="card-header">
                                                <h4>Edit Profile</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="form-group row mb-4">
                                                        <div class="col-md-8">
                                                            <label class="col-form-label">Image</label>
                                                            <div id="image-preview" class="image-preview">
                                                                <label for="image-upload" id="image-label">Choose File</label>
                                                                <input type="file" name="thumbnail" id="image-upload" />
                                                                <div class="table_slider_update_image" style="background-image: url({{ asset($admin_profile->thumbnail) }}); background-size: cover; background-position: center;" id="imageShow"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <div class="col-md-12">
                                                            <label class="col-form-label">Full Name</label>
                                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $admin_profile->name }}" data-parsley-required-message="Name is required*" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <div class="col-md-12">
                                                            <label class="col-form-label">Email</label>
                                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $admin_profile->email }}" data-parsley-required-message="Email is required*" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <div class="col-md-12">
                                                            <label class="col-form-label">Phone</label>
                                                            <input type="text" class="form-control" name="phone" value="{{ $admin_profile->phone }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-4">
                                                        <div class="col-md-12">
                                                            <label class="col-form-label">Address</label>
                                                            <textarea name="address" class="form-control">{{ $admin_profile->address ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-right">
                                                <button class="btn btn-primary">Update Changes</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="changePassword" role="tabpanel" aria-labelledby="profile-tab2">
                                        @include('widgets.errors')
                                        @include('widgets.success')
                                        <form id="form" action="{{ route('admin.password.update') }}" method="post" data-parsley-validate>
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $admin_profile->id }}">
                                            <div class="form-group row mb-4">
                                                <div class="col-md-12">
                                                    <label class="col-form-label">Current Password</label>
                                                    <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" data-parsley-required-message="Current Password is required*" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <div class="col-md-12">
                                                    <label class="col-form-label">New Password</label>
                                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" data-parsley-required-message="New Password is required*" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <div class="col-md-12">
                                                    <label class="col-form-label">Confirm New Password</label>
                                                    <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" data-parsley-required-message="Confirm New Password is required*" required>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </form>
                                    </div>

                                </div>

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
