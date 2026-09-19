<style>
    .header-cart-box {
        margin-right: 15px;
    }

    .header-cart-icon {
        position: relative;
        display: inline-flex;
        align-items: center;
        font-size: 22px;
        color: inherit;
        text-decoration: none;
    }

    .header-cart-count {
        position: absolute;
        top: -9px;
        right: -11px;
        background: #e02b2b;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        line-height: 1;
        min-width: 18px;
        height: 18px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2px;
        box-shadow: 0 0 0 2px #fff;
    }

    .header-cart-count.bump {
        animation: headerCartBump .6s cubic-bezier(.36, 1.6, .5, 1);
    }

    .header-cart-icon.bump i {
        animation: headerCartShake .6s ease;
    }

    .header-cart-mobile {
        display: none;
        position: relative;
        align-items: center;
        vertical-align: middle;
        margin-right: 22px;
        font-size: 20px;
        color: var(--itzone-base, #163355);
        text-decoration: none;
    }

    @keyframes headerCartBump {
        0% {
            transform: scale(1);
        }

        40% {
            transform: scale(1.7);
        }

        100% {
            transform: scale(1);
        }
    }

    @keyframes headerCartShake {

        0%,
        100% {
            transform: rotate(0);
        }

        25% {
            transform: rotate(-14deg);
        }

        60% {
            transform: rotate(10deg);
        }
    }

    @media (max-width: 767px) {
        .header-cart-mobile {
            display: inline-flex;
        }
    }
</style>

<header class="main-header-three">

    <nav class="main-menu main-menu-three">

        <div class="main-menu-three__wrapper">

            <div class="container">

                <div class="main-menu-three__wrapper-inner">

                    <div class="main-menu-three__left">
                        <div class="main-menu-three__logo">
                            <a href="{{ route('frontend.index') }}">
                                <img src="{{ asset(siteSetting()->header_logo) }}" alt="Site Logo" style="width: 200px">
                            </a>
                        </div>
                    </div>

                    <div class="main-menu-three__main-menu-box">

                        @php
                            $headerCart = session('book_cart', []);
                            $headerCartCount = collect($headerCart)->sum('quantity');
                        @endphp
                        @if ($headerCartCount > 0)
                            <a href="{{ route('frontend.book.cart') }}" class="header-cart-mobile" aria-label="View cart">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="header-cart-count">{{ $headerCartCount }}</span>
                            </a>
                        @endif

                        <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>

                        <ul class="main-menu__list">

                            <li class="{{ request()->routeIs('frontend.index') ? 'active' : '' }}"><a href="{{ route('frontend.index') }}">Home</a></li>

                            <li class="{{ request()->routeIs('frontend.about.us') ? 'active' : '' }}"><a href="{{ route('frontend.about.us') }}">About</a></li>

                            <li class="dropdown {{ request()->routeIs('frontend.all.services.list') || request()->routeIs('frontend.service.details*') ? 'active' : '' }}">
                                <a href="{{ route('frontend.all.services.list') }}">Services</a>
                                <ul class="shadow-box">
                                    @php
                                        $navServices = \App\Models\Service::where('status', 'active')->orderBy('id', 'asc')->get();
                                        $currentSlug = request()->route('slug');
                                    @endphp
                                    @foreach ($navServices as $item)
                                        <li class="{{ $currentSlug == $item->slug ? 'active' : '' }}">
                                            <a href="{{ route('frontend.service.details', $item->slug) }}">{{ $item->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>

                            <li class="{{ request()->routeIs('frontend.remote.support') ? 'active' : '' }}"><a href="{{ route('frontend.remote.support') }}">Remote Support</a></li>

                            <li class="dropdown {{ request()->routeIs(['frontend.training.development', 'frontend.training.development.details', 'frontend.book.*']) ? 'active' : '' }}">
                                <a href="javascript:void(0)">Professional Academy</a>
                                <ul class="shadow-box">
                                    <li class="{{ request()->routeIs('frontend.training.development') ? 'active' : '' }}"><a href="{{ route('frontend.training.development') }}">Trainings</a></li>
                                    <li class="{{ request()->routeIs('frontend.book.*') ? 'active' : '' }}"><a href="{{ route('frontend.book.list') }}">Book Store</a></li>
                                </ul>
                            </li>

                            <li class="{{ request()->routeIs('frontend.gallery') ? 'active' : '' }}"><a href="{{ route('frontend.gallery') }}">Gallery</a></li>

                            <li class="{{ request()->routeIs('frontend.blog.list') ? 'active' : '' }}"><a href="{{ route('frontend.blog.list') }}">Blog</a></li>

                            <li class="d-lg-none {{ request()->routeIs('frontend.contact.us') ? 'active' : '' }}">
                                <a href="{{ route('frontend.contact.us') }}">Contact Us</a>
                            </li>

                        </ul>

                    </div>

                    <div class="main-menu-three__right">

                        {{-- <div class="main-menu-three__search-box">
                            <a href="#!" class="main-menu-three__search searcher-toggler-box fal fa-search"></a>
                        </div> --}}

                        @if ($headerCartCount > 0)
                            <div class="main-menu-three__cart-box header-cart-box">
                                <a href="{{ route('frontend.book.cart') }}" class="header-cart-icon" aria-label="View cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="header-cart-count">{{ $headerCartCount }}</span>
                                </a>
                            </div>
                        @endif

                        <div class="main-menu-three__btn-box">
                            <a href="{{ route('frontend.contact.us') }}" class="thm-btn">Get in Touch<span class="icon-right-arrow"></span></a>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </nav>

</header>
