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
                                    <li class="{{ request()->routeIs('frontend.book.*') ? 'active' : '' }}"><a href="{{ route('frontend.book.list') }}">Books</a></li>
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

                        @php
                            $headerCart = session('book_cart', []);
                            $headerCartCount = collect($headerCart)->sum('quantity');
                        @endphp
                        @if ($headerCartCount > 0)
                            <div class="main-menu-three__cart-box" id="header-cart-box" style="margin-right: 15px;">
                                <a href="{{ route('frontend.book.cart') }}" id="header-cart-icon" style="position: relative; display: inline-flex; align-items: center; font-size: 22px; color: inherit;">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span id="header-cart-count" style="position: absolute; top: -8px; right: -10px; background: #e02b2b; color: #fff; font-size: 11px; line-height: 1; min-width: 16px; height: 16px; border-radius: 50%; display: flex; align-items: center; justify-content: center; padding: 2px;">{{ $headerCartCount }}</span>
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