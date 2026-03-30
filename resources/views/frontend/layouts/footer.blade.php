<footer class="site-footer">

    <div class="site-footer__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/site-footer-bg.jpg') }});"></div>

    <div class="site-footer__shape-1 img-bounce-two"></div>
    <div class="site-footer__shape-2 float-bob-y"></div>

    <div class="site-footer__top">

        <div class="container">

            <div class="site-footer__top-inner">

                <div class="row">

                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                        <div class="footer-widget__about">
                            <div class="footer-widget__about-logo">
                                <a href="{{ route('frontend.index') }}">
                                    <img src="{{ asset(siteSetting()->footer_logo) }}" alt="Site Logo">
                                </a>
                            </div>
                            <p class="footer-widget__about-text">{{ siteSetting()->footer_text }}</p>
                            <div class="footer-widget__social">
                                <a href="{{ siteSetting()->facebook }}" target="_blank"><i class="fab fa-facebook"></i></a>
                                <a href="{{ siteSetting()->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
                                <a href="{{ siteSetting()->linkedin }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                                <a href="{{ siteSetting()->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                        <div class="footer-widget__links">
                            <h4 class="footer-widget__title">Quick links</h4>
                            <ul class="footer-widget__links-list list-unstyled">
                                <li><a href="{{ route('frontend.about.us') }}">About Us</a></li>
                                <li><a href="{{ route('frontend.team.list') }}">Meet Our Team</a></li>
                                <li><a href="{{ route('frontend.contact.us') }}">Contact Us</a></li>
                                <li><a href="{{ route('frontend.terms.conditions') }}">Terms of Service</a></li>
                                <li><a href="{{ route('frontend.privacy.policy') }}">Privacy policy</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                        <div class="footer-widget__services">
                            <h4 class="footer-widget__title">Services</h4>
                            <ul class="footer-widget__links-list list-unstyled">
                                <li><a href="web-development.html">Web Development</a></li>
                                <li><a href="business-analysis.html">Business Development</a></li>
                                <li><a href="software-development.html">Cloud services</a></li>
                                <li><a href="product-design.html">Product Management</a></li>
                                <li><a href="ui-ux-design.html">UI/UX Design</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                        <div class="footer-widget__contact">
                            <h3 class="footer-widget__title">Contact Us</h3>
                            <ul class="footer-widget__contact-list list-unstyled">
                                <li>
                                    <div class="icon">
                                        <span class="icon-pin"></span>
                                    </div>
                                    <p>{{ siteSetting()->head_address }}</p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <span class="icon-call"></span>
                                    </div>
                                    <p><a href="tel:{{ siteSetting()->site_phone }}">{{ siteSetting()->site_phone }}</a></p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <span class="icon-email"></span>
                                    </div>
                                    <p><a href="mailto:{{ siteSetting()->site_email }}">{{ siteSetting()->site_email }}</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="site-footer__bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="site-footer__bottom-inner" style="justify-content: center;">
                        <div class="site-footer__copyright">
                            <p class="site-footer__copyright-text">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                {{ siteSetting()->copyright }} By <a href="https://web.nebulaitbd.com/">Nebula IT.</a> All Rights Reserved.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>
