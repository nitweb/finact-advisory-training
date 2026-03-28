@extends('frontend.master')

@section('frontend_title', 'Apply for Career Opportunities')

@section('frontend_content')

    <div class="wrap-slider" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://mazamanca.com/frontend/img/cover_about_us.jpg') no-repeat center; background-size: cover; height: 100px; display: flex; align-items: center; justify-content: center;">
        <div class="container text-center">
            <h1 style="color: #fff; font-size: 2.5rem; font-weight: bold; margin: 0;">Apply for Career Opportunities</h1>
            <ul class="breadcrumbs" style="list-style: none; padding: 0; display: inline-flex; gap: 10px; color: #fff;">
                <li><a href="{{ route('frontend.index') }}" style="color: #fff; text-decoration: none;">Home</a></li>
                <li>/</li>
                <li>Apply for Career Opportunities</li>
            </ul>
        </div>
    </div>

    <section class="flat-row v16 home-checkout">

        <div class="container">

            <div class="check-out">

                <div class="info-customer">

                    <div class="row">

                        <div class="col-md-8 col-sm-7" data-aos="zoom-in" data-aos-delay="50" data-aos-duration="1000">

                            <div class="info-form">

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form novalidate="" class="register-form" id="registerform" method="POST" action="{{ route('admin.job_apply.store') }}" enctype="multipart/form-data">

                                    @csrf

                                    <h4 class="title-check">Apply for Career Opportunities</h4>

                                    <div class="billing">

                                        <div class="flat-bill">
                                            <p class="label-index"><label>Name *</label></p>
                                            <p class="input-field"><input type="text" placeholder="Enter Your Name" name="name" required></p>
                                        </div>

                                        <div class="flat-bill">
                                            <p class="label-index"><label>Email *</label></p>
                                            <p class="input-field"><input type="email" placeholder="Enter Email" name="email" required></p>
                                        </div>

                                        <div class="flat-bill">
                                            <p class="label-index"><label>Phone *</label></p>
                                            <p class="input-field"><input type="text" placeholder="Enter Phone" name="phone" required></p>
                                        </div>

                                        <div class="flat-bill" style="padding-bottom: 14px;">
                                            <p class="label-index"><label>Interested In *</label></p>
                                            <p class="input-field">
                                                <select class=" dropdown_sort" name="interested_in" required>
                                                    <option value="">Interested In</option>
                                                    @if (jobPost()->count() > 0)
                                                        @foreach (jobPost() as $job)
                                                            <option value="{{ $job->id }}">
                                                                {{ $job->title }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </p>
                                        </div>

                                        <div class="flat-bill">
                                            <p class="label-index"><label>Why you interest to join *</label></p>
                                            <p class="input-field">
                                                <textarea class="contact-messages" tabindex="4" placeholder="Why you interest to join with us" name="message" required></textarea>
                                            </p>
                                        </div>

                                        <div class="flat-bill">
                                            <p class="label-index"><label>Document *</label></p>
                                            <p class="input-field"><input type="file" name="job_files" style="background: none"></p>
                                            <p class="text-muted mt-3" style="font-size: 14px; color: rgb(23, 162, 184) !important;">accept jpeg, png, jpg &amp; pdf only</p>
                                        </div>

                                        <div>
                                            <p class="form-submit">
                                                <button type="submit" class="flat-btn contact-submit" style="margin-top: 30px;">SUBMIT</button>
                                            </p>
                                        </div>

                                    </div>

                                </form>

                            </div>

                        </div>

                        <div class="col-md-4 col-sm-5" data-aos="fade-left" data-aos-delay="50" data-aos-duration="1000">

                            <div class="check-sidebar">

                                <div class="widget widget-help">

                                    <h6>How can we help you?</h6>

                                    <p>Contact us at the Consultec WP office near-est to you or submit a business inquiry online.</p>

                                    <div class="wrap-style5">
                                        <div class="widgets-header-information">
                                            <div class="informaiton-text">
                                                <div class="info-icon">
                                                    <div class="btn-click">
                                                        <a href="{{ route('frontend.contact.us') }}" class="btn-black">CONTACT US</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    title: 'Success!',
                    text: 'Your application has been sent successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    timer: 3000
                });
            @endif
        })
    </script>

@endsection
