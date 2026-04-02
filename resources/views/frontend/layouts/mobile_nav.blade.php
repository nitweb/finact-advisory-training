<div class="mobile-nav__wrapper">

    <div class="mobile-nav__overlay mobile-nav__toggler"></div>

    <div class="mobile-nav__content">

        <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

        <div class="logo-box">
            <a href="{{ route('frontend.index') }}" aria-label="logo image">
                <img src="{{ asset(siteSetting()->footer_logo) }}" width="150" alt="Site Logo" />
            </a>
        </div>

        <div class="mobile-nav__container"></div>

        <ul class="mobile-nav__contact list-unstyled">
            <li>
                <i class="fa fa-envelope"></i>
                <a href="mailto:{{ siteSetting()->site_email }}">{{ siteSetting()->site_email }}</a>
            </li>
            <li>
                <i class="fas fa-phone"></i>
                <a href="tel:{{ siteSetting()->site_phone }}">{{ siteSetting()->site_phone }}</a>
            </li>
        </ul>

        <div class="mobile-nav__top">
            <div class="mobile-nav__social">
                <a href="{{ siteSetting()->facebook }}" target="_blank" class="fab fa-facebook-square"></a>
                <a href="{{ siteSetting()->youtube }}" target="_blank" class="fab fa-youtube"></a>
                <a href="{{ siteSetting()->linkedin }}" target="_blank" class="fab fa-linkedin"></a>
                <a href="{{ siteSetting()->instagram }}" target="_blank" class="fab fa-instagram"></a>
            </div>
        </div>

    </div>

</div>
