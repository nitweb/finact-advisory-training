<div class="main-sidebar sidebar-style-2">

    <aside id="sidebar-wrapper">

        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">
                <img alt="image" src="{{ asset(siteSetting()->header_logo) }}" class="header-logo" alt="Site Logo" style="height: 45px;" />
                {{-- <span class="logo-name">Rahman Anis & Co</span> --}}
            </a>
        </div>

        <ul class="sidebar-menu">

            <li class="menu-header">Main</li>

            <li class="dropdown {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i data-feather="monitor"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            {{-- <li class="dropdown {{ request()->routeIs('admin.slider.list') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="image"></i>
                    <span>Home Sliders</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.slider.list') }}">Slider</a></li>
                </ul>
            </li> --}}

            {{-- <li class="dropdown {{ request()->routeIs(['admin.about-us.list', 'admin.enlistment.list', 'admin.successful_portfolios.list', 'admin.about-message.list', 'admin.our-team.list']) ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="list"></i>
                    <span>About Us</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.about-us.list') }}">About Our Firm</a></li>
                    <li><a class="nav-link" href="{{ route('admin.our-contents.list') }}">Our Contents</a></li>
                    <li><a class="nav-link" href="{{ route('admin.enlistment.list') }}">Important Enlistment</a></li>
                    <li><a class="nav-link" href="{{ route('admin.successful_portfolios.list') }}">Firm Profile</a></li>
                    <li><a class="nav-link" href="{{ route('admin.about-message.list') }}">Managing Partner Message</a></li>
                    <li><a class="nav-link" href="{{ route('admin.our-team.list') }}">Our Team</a></li>
                </ul>
            </li> --}}

            <li class="dropdown {{ request()->routeIs(['admin.service.list', 'admin.client.list']) ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="list"></i>
                    <span>Services</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.service.list') }}">Services List</a></li>
                    {{-- <li><a class="nav-link" href="{{ route('admin.client.list') }}">Our Clients</a></li> --}}
                </ul>
            </li>

            {{-- <li class="dropdown {{ request()->routeIs(['admin.finance.list']) ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="list"></i>
                    <span>Finance Support</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.finance.list') }}">Finance Support</a></li>
                </ul>
            </li> --}}

            <li class="dropdown {{ request()->routeIs('admin.trainer.list') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="list"></i>
                    <span>Trainers</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.trainer.list') }}">Trainer List</a></li>
                </ul>
            </li>

            <li class="dropdown {{ request()->routeIs(['admin.training.list']) ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="list"></i>
                    <span>Training & Development</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.training.list') }}">Training & Development</a></li>
                </ul>
            </li>

            <li class="dropdown {{ request()->routeIs(['admin.training.enrollment.list']) ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="list"></i>
                    <span>Training Enrollments</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.training.enrollment.list') }}">Training Enrollment List</a></li>
                </ul>
            </li>

            <li class="dropdown {{ request()->routeIs('admin.testimonial.list') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="star"></i>
                    <span>Testimonials</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.testimonial.list') }}">Testimonial List</a></li>
                </ul>
            </li>

            <li class="dropdown {{ request()->routeIs(['admin.blog-category.list', 'admin.blog.list']) ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="list"></i>
                    <span>Blog</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.blog-category.list') }}">Blog Category List</a></li>
                    <li><a class="nav-link" href="{{ route('admin.blog.list') }}">Blog List</a></li>
                </ul>
            </li>

            <li class="dropdown {{ request()->routeIs(['admin.gallery.list']) ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="list"></i>
                    <span>Gallery</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.gallery.list') }}">Gallery List</a></li>
                </ul>
            </li>

            {{-- <li class="dropdown {{ request()->routeIs('admin.career.list') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="list"></i>
                    <span>Careers</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.career.list') }}">Job Post</a></li>
                    <li><a class="nav-link" href="{{ route('admin.job_apply.list') }}">Job Application</a></li>
                </ul>
            </li> --}}

            <li class="dropdown {{ request()->routeIs('admin.contact.list') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="list"></i>
                    <span>Contact</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.contact.list') }}">Contact Message</a></li>
                </ul>
            </li>

            <li class="dropdown {{ request()->routeIs('admin.setting.font-awesome') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="settings"></i>
                    <span>Settings</span>
                </a>
                <ul class="dropdown-menu">
                    {{-- <li><a class="nav-link" href="{{ route('admin.setting.font-awesome') }}">FontAwesome</a></li> --}}
                    <li><a class="nav-link" href="{{ route('admin.setting.edit', siteSetting()->id) }}">Site Setting</a></li>
                </ul>
            </li>

        </ul>

    </aside>

</div>
