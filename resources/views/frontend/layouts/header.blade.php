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

                            <li><a href="{{ route('frontend.index') }}">Home</a></li>

                            <li><a href="{{ route('frontend.about.us') }}">About</a></li>

                            <li class="dropdown">
                                <a href="{{ route('frontend.all.services.list') }}">Services</a>
                                <ul class="shadow-box">
                                    @php
                                        $navServices = \App\Models\Service::where('status', 'active')->orderBy('id', 'asc')->get();
                                    @endphp
                                    @foreach ($navServices as $item)
                                        <li><a href="{{ route('frontend.service.details', $item->slug) }}">{{ $item->title }}</a></li>
                                    @endforeach
                                </ul>
                            </li>

                            <li><a href="#!">Finance Support</a></li>

                            <li><a href="#!">Training & Development</a></li>

                            <li><a href="#!">Blog</a></li>

                        </ul>
                        
                    </div>

                    <div class="main-menu-three__right">

                        <div class="main-menu-three__search-box">
                            <a href="#!" class="main-menu-three__search searcher-toggler-box fal fa-search"></a>
                        </div>

                        <div class="main-menu-three__btn-box">
                            <a href="{{ route('frontend.contact.us') }}" class="thm-btn">Get in Touch<span class="icon-right-arrow"></span></a>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </nav>

</header>
