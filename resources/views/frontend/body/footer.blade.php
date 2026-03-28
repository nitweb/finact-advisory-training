@php
    $services = \App\Models\Service::take(5)->get();
@endphp

<footer class="footer">

    <div class="container">

        <div class="row">

            <div class="col-md-3 col-sm-6">
                <div class="widget widget-infomation">
                    <h3 class="logo-footer">
                        <a href="{{ route('frontend.index') }}">
                            <img src="{{ asset(siteSetting()->footer_logo) }}" alt="Logo" class="img-fluid" style="width: 200px;">
                        </a>
                    </h3>
                    <p style="padding-bottom: 0;">{{ siteSetting()->footer_text }}</p>
                    <div class="wrap-style5">
                        <ul class="social-links custom_footer_social">
                            <li><a href="{{ siteSetting()->facebook }}" target="_blank;"><i class="social_facebook"></i></a></li>
                            <li><a href="{{ siteSetting()->youtube }}" target="_blank;"><i class="social_youtube"></i></a></li>
                            <li><a href="{{ siteSetting()->linkedin }}" target="_blank;"><i class="social_linkedin"></i></a></li>
                            <li><a href="{{ siteSetting()->instagram }}" target="_blank;"><i class="social_instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="widget widget-out-link">
                    <h4 class="widget-title">Important Links</h4>
                    <ul class="one-half">
                        <li><a href="{{ route('frontend.about.us') }}">About Us</a></li>
                        <li><a href="{{ route('frontend.all.services.list') }}">Services</a></li>
                        <li><a href="{{ route('frontend.team.list') }}">Our Team</a></li>
                        <li><a href="{{ route('frontend.privacy.policy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('frontend.terms.conditions') }}">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="widget widget-out-link">
                    <h4 class="widget-title">Our Services</h4>
                    <ul class="one-half">
                        @foreach ($services as $item)
                            <li><a href="{{ route('frontend.service.details', $item->slug) }}">{{ $item->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="widget widget-letter">
                    <h4 class="widget-title">Contact Information</h4>
                    <ul class="flat-information">
                        <li class="address"><a>{{ siteSetting()->head_address }}</a></li>
                        <li class="address"><a>{{ siteSetting()->branch_address }}</a></li>
                        <li class="phone" style="color: #ccc">{!! siteSetting()->site_phone !!}</li>
                        <li class="phone" style="color: #ccc">{!! siteSetting()->site_phone_alter !!}</li>
                        <li class="email"><a href="mailto:{{ siteSetting()->site_email }}">{{ siteSetting()->site_email }}</a></li>
                    </ul>
                </div>
            </div>

        </div>

    </div>

</footer>



<div class="bottom">
    <div class="container">
        <div class="copyright">
            <p>
                ©
                <script>
                    document.write(new Date().getFullYear());
                </script>
                <a>
                    {{ siteSetting()->copyright }}
                </a>
                , All rights reserved. Developed by <a href="https://web.nebulaitbd.com/" target="_blank">Nebula IT.</a>
            </p>
        </div>
    </div>
</div>
