@php
    $services = \App\Models\Service::take(5)->get();
@endphp

<div class="site-header style2">

    <header id="header" class="header header-classic headerv3 clearfix">

        <div class="container">

            <div class="header-wrap clearfix">

                <div class="wrap-logo">

                    <div id="logo" class="logo">
                        <a href="{{ route('frontend.index') }}" rel="home">
                            <img src="{{ asset(siteSetting()->header_logo) }}" alt="image" class="img-fluid">
                        </a>
                    </div>

                    <div class="btn-menu">
                        <span></span>
                    </div>

                </div>

                <div class="nav-wrap">


                    <div class="wrap-style5">

                        <nav id="mainnav" class="mainnav">

                            <ul class="menu">

                                <li class="{{ request()->routeIs('frontend.index') ? 'active' : '' }}"><a href="{{ route('frontend.index') }}">Home</a></li>

                                <li class="{{ request()->routeIs('frontend.about.us*') || request()->routeIs('frontend.important.enlistment') || request()->routeIs('frontend.show.profile') || request()->routeIs('frontend.team.list') ? 'active' : '' }}"><a href="{{ route('frontend.about.us') }}">About us</a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('frontend.important.enlistment') }}">Important Enlistment</a></li>
                                        <li><a href="{{ route('frontend.show.profile') }}">Firm Profile</a></li>
                                        <li><a href="{{ route('frontend.team.list') }}">Our Team</a></li>
                                    </ul>
                                </li>

                                <li class="{{ request()->routeIs('frontend.all.services.list*') || request()->routeIs('frontend.service.details*') || request()->routeIs('frontend.client') ? 'active' : '' }}"><a href="{{ route('frontend.all.services.list') }}">Services</a>
                                    <ul class="submenu">
                                        @foreach ($services->sortByDesc('id') as $item)
                                            <li><a href="{{ route('frontend.service.details', $item->slug) }}">{{ $item->title }}</a></li>
                                        @endforeach
                                        <li><a href="{{ route('frontend.client') }}">Our Clients</a></li>
                                    </ul>
                                </li>

                                <li class="{{ request()->routeIs('frontend.resources*') || request()->routeIs('frontend.gallery') ? 'active' : '' }}"><a href="#!">Resources</a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('frontend.publications') }}">Publications</a></li>
                                        <li><a href="{{ route('frontend.notice.circular') }}">Notice/Circular</a></li>
                                        <li><a href="{{ route('frontend.gallery') }}">Gallery</a></li>
                                    </ul>
                                </li>

                                {{-- <li class="{{ request()->routeIs('frontend.client') ? 'active' : '' }}"><a href="{{ route('frontend.client') }}">Client</a></li> --}}

                                {{-- <li class="{{ request()->routeIs('frontend.gallery') ? 'active' : '' }}"><a href="{{ route('frontend.gallery') }}">Gallery</a></li> --}}

                                <li class="{{ request()->routeIs('frontend.career') ? 'active' : '' }}"><a href="{{ route('frontend.career') }}">Careers</a></li>

                                <a href="{{ route('frontend.contact.us') }}" class="btn btn-primary" title="+8801722690128" style="font-size: 16px;">Contact Us</a>

                            </ul>

                        </nav>

                    </div>

                </div>

            </div>

        </div>

    </header>

</div>
