@extends('frontend.master')

@section('frontend_title', 'Contact Us')

@section('frontend_content')

    <div class="wrap-slider" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://mazamanca.com/frontend/img/cover_about_us.jpg') no-repeat center; background-size: cover; height: 100px; display: flex; align-items: center; justify-content: center;">
        <div class="container text-center">
            <h1 style="color: #fff; font-size: 2.5rem; font-weight: bold; margin: 0;">Contact Us</h1>
            <ul class="breadcrumbs" style="list-style: none; padding: 0; display: inline-flex; gap: 10px; color: #fff;">
                <li><a href="{{ route('frontend.index') }}" style="color: #fff; text-decoration: none;">Home</a></li>
                <li>/</li>
                <li>Contact Us</li>
            </ul>
        </div>
    </div>

    <section class="section-contact" style="padding: 60px 0; background-color: #f8f9fa;">
        <div class="container">

            <div class="row text-center" style="margin-bottom: 45px;">
                <div class="col-md-12">
                    <h2 style="font-size: 2.2rem; font-weight: bold; margin-bottom: 10px;">Get in Touch</h2>
                    <p style="font-size: 1rem; color: #6c757d;">Feel free to reach out to us anytime. We're here to help you!</p>
                </div>
            </div>

            <div class="row mb-5" style="margin-bottom: 45px;">

                <div class="col-md-3 text-center" style="margin-bottom: 25px;" data-aos="fade-up-right" data-aos-delay="50" data-aos-duration="1000">
                    <div class="contact-info-box" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);height: 230px;">
                        <i class="fas fa-map-marker-alt" style="font-size: 2rem; color: #007bff; margin-bottom: 10px;"></i>
                        <h5>Head Office Address</h5>
                        <p>{{ $site_setting->head_address }}</p>
                    </div>
                </div>

                <div class="col-md-3 text-center" style="margin-bottom: 25px;" data-aos="fade-up-right" data-aos-delay="50" data-aos-duration="1000">
                    <div class="contact-info-box" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);height: 230px;">
                        <i class="fas fa-map-marker-alt" style="font-size: 2rem; color: #007bff; margin-bottom: 10px;"></i>
                        <h5>Branch Address</h5>
                        <p>{{ $site_setting->branch_address }}</p>
                    </div>
                </div>

                <div class="col-md-3 text-center" style="margin-bottom: 25px;" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
                    <div class="contact-info-box" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);height: 230px;">
                        <i class="fas fa-phone-alt" style="font-size: 2rem; color: #007bff; margin-bottom: 10px;"></i>
                        <h5>Phone</h5>
                       {!! $site_setting->site_phone !!}
                        <br>
                        {!! $site_setting->site_phone_alter !!}
                    </div>
                </div>

                <div class="col-md-3 text-center" style="margin-bottom: 25px;" data-aos="fade-up-left" data-aos-delay="50" data-aos-duration="1000">
                    <div class="contact-info-box" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);height: 230px;">
                        <i class="fas fa-envelope" style="font-size: 2rem; color: #007bff; margin-bottom: 10px;"></i>
                        <h5>Email</h5>
                        <a href="mailto:{{ $site_setting->site_email }}" style="color: #007bff; text-decoration: none;">{{ $site_setting->site_email }}</a>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12" data-aos="zoom-in" data-aos-delay="50" data-aos-duration="1000">
                    <div class="contact-form-wrapper" style="background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <h3 style="font-size: 1.8rem; font-weight: bold; margin-bottom: 20px;">Send Us a Message</h3>
                        <form id="contactform" method="post" action="{{ route('admin.contact.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="name" id="name" placeholder="Your Name" required class="form-control" style="padding: 10px; border: 1px solid #ced4da; border-radius: 4px;">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="email" name="email" id="email" placeholder="Your Email" required class="form-control" style="padding: 10px; border: 1px solid #ced4da; border-radius: 4px;">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="phone" id="phone" placeholder="Your Phone" required class="form-control" style="padding: 10px; border: 1px solid #ced4da; border-radius: 4px;">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="subject" id="subject" placeholder="Subject" required class="form-control" style="padding: 10px; border: 1px solid #ced4da; border-radius: 4px;">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <textarea name="message" id="message" placeholder="Your Message" rows="6" required class="form-control" style="padding: 10px; border: 1px solid #ced4da; border-radius: 4px;"></textarea>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary" style="padding: 10px 20px; font-size: 1rem; border-radius: 4px;">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>


    {{-- Google Map --}}
    <section class="section-contact" style="padding: 60px 0; background-color: #f8f9fa;">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-6">
                    <h3 style="font-size: 1.8rem; font-weight: bold; margin-bottom: 5px;">Head Office Address</h3>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.793933658692!2d90.3891152750726!3d23.754726688610784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b9ef5a02d797%3A0xb6cb536633746269!2sRahman%20Anis%20%26%20Co.%2C%20Chartered%20Accountants%2C%20Kawranbazar%20Branch!5e0!3m2!1sen!2sbd!4v1737804600489!5m2!1sen!2sbd" width="100%" height="450" style="border: 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-md-6">
                    <h3 style="font-size: 1.8rem; font-weight: bold; margin-bottom: 5px;">Branch Address</h3>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.796376871367!2d90.3891606752334!3d23.754639588613824!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8a3cd1ce443%3A0xf9a1db8528ffc312!2sNorthern%20University%20Bangladesh%20(NUB)%20-%20Kawran%20Bazar%20Campus!5e0!3m2!1sen!2sbd!4v1742458170913!5m2!1sen!2sbd" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    title: 'Success!',
                    text: 'Your message has been sent successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    timer: 3000
                });
            @endif
        });
    </script>

@endsection
