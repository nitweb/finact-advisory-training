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
                            <li>
                                <a href="{{ route('frontend.index') }}">Home</a>
                            </li>
                            <li>
                                <a href="about.html">About</a>
                            </li>
                            <li class="dropdown">
                                <a href="#">Pages</a>
                                <ul class="shadow-box">
                                    <li><a href="team.html">Team</a></li>
                                    <li><a href="team-details.html">Team Details</a></li>
                                    <li><a href="projects.html">Projects</a></li>
                                    <li><a href="project-details.html">Project Details</a></li>
                                    <li><a href="testimonials.html">Testimonials</a></li>
                                    <li><a href="pricing.html">Pricing</a></li>
                                    <li><a href="faq.html">FAQs</a></li>
                                    <li><a href="404.html">404 Error</a></li>
                                </ul>
                            </li>
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
                            <li class="dropdown">
                                <a href="#">Shop</a>
                                <ul class="shadow-box">
                                    <li><a href="products.html">Products</a></li>
                                    <li><a href="product-details.html">Product Details</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                    <li><a href="sign-up.html">Sign Up</a></li>
                                    <li><a href="login.html">Login</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#">Blog</a>
                                <ul class="shadow-box">
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="blog-standard.html">Blog Standard</a></li>
                                    <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                    <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                                    <li><a href="blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="contact.html">Contact</a>
                            </li>
                        </ul>
                    </div>

                    <div class="main-menu-three__right">
                        <div class="main-menu-three__search-box">
                            <a href="#" class="main-menu-three__search searcher-toggler-box fal fa-search"></a>
                        </div>
                        <div class="main-menu-three__btn-box">
                            <a href="contact.html" class="thm-btn">Get in Touch<span class="icon-right-arrow"></span></a>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </nav>

</header>
