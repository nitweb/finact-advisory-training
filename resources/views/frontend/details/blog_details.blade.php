@extends('frontend.dashboard')
@section('frontend_title', $blog->title)

@section('frontend_content')

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg.jpg);">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h3>{{ $blog->title }}</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Blog Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Blog Details Start -->
    <section class="blog-details">

        <div class="container">

            <div class="row">

                <div class="col-xl-8 col-lg-7">

                    <div class="blog-details__left">

                        <div class="blog-details__img">
                            <img src="{{ asset($blog->blogDetail->blog_image) }}" alt="{{ $blog->title }}">
                        </div>

                        <div class="blog-details__content">

                            <div class="blog-details__user-and-meta">

                                <div class="blog-details__user">
                                    <p><span class="fas fa-user"></span>By {{ $author ?? 'N/A' }}</p>
                                </div>

                                <ul class="blog-details__meta list-unstyled">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <span class="fas fa-tag"></span>{{ $blog->blogDetail->category->name }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <span class="icon-calendar"></span>{{ \Carbon\Carbon::parse($blog->date)->format('F j, Y') }}
                                        </a>
                                    </li>
                                </ul>

                            </div>

                            <h3 class="blog-details__title">{{ $blog->title }}</h3>

                            <div class="blog-details__text-1" style="text-align: justify;">
                                {!! $blog->blogDetail->long_description !!}
                            </div>

                        </div>

                    </div>

                </div>

                <!--Start Sidebar-->
                <div class="col-xl-4 col-lg-5">

                    <div class="sidebar">

                        <!--Start Sidebar Single-->
                        <!--Start Sidebar Single-->
                        <div class="sidebar__single sidebar__search wow fadeInUp" data-wow-delay=".1s" style="margin-bottom: 35px;">
                            <form action="#" class="sidebar__search-form" onsubmit="return false;">
                                <input type="search" id="blog-search-input" placeholder="Search..." autocomplete="off">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <!--End Sidebar Single-->

                        <!-- Search Results Dropdown — placed OUTSIDE sidebar, positioned via JS -->
                        <div id="blog-search-results" style="display: none;position: fixed;background: #fff;border: 1px solid #e0e0e0;border-radius: 8px;box-shadow: 0 10px 30px rgba(0,0,0,0.18);z-index: 99999;max-height: 400px;overflow-y: auto;overflow-x: hidden;">
                            <div id="search-cards-container"></div>
                            <div id="search-no-results" style="display:none; padding: 20px; text-align:center; color:#888; font-size:14px;">
                                No blogs found.
                            </div>
                        </div>
                        <!--End Sidebar Single-->

                        <!--Start Sidebar Single-->
                        <div class="sidebar__single sidebar__post wow fadeInUp" data-wow-delay=".1s">
                            <h3 class="sidebar__title">Recent Post</h3>
                            <ul class="sidebar__post-list list-unstyled">
                                @foreach ($recent_blogs as $item)
                                    <li>
                                        <div class="sidebar__post-image">
                                            <img src="{{ asset($item->blogDetail->blog_image) }}" alt="{{ $item->title }}">
                                        </div>
                                        <div class="sidebar__post-content">
                                            <h3 class="sidebar__post-title">
                                                <a href="{{ route('frontend.blog.details', $item->slug) }}">{{ $item->title }}</a>
                                            </h3>
                                            <div style="display: flex;gap: 20px;">
                                                <p class="sidebar__post-date"><span class="icon-calendar"></span>{{ \Carbon\Carbon::parse($blog->date)->format('F j, Y') }}</p>
                                                <p class="sidebar__post-date"><span class="fas fa-clock"></span>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!--End Sidebar Single-->

                        <div class="service-details__get-started">
                            <h3 class="service-details__get-started-title">Get Started Today</h3>
                            <p class="service-details__get-started-text">
                                We would be pleased to discuss your requirements and explore how we can support your business.
                            </p>
                            <ul class="service-details__get-started-points list-unstyled">
                                <li>
                                    <div class="icon">
                                        <span class="icon-call"></span>
                                    </div>
                                    <p>
                                        <a href="tel:{{ siteSetting()->site_phone }}">{{ siteSetting()->site_phone }}</a>
                                        <br>
                                        <a href="tel:{{ siteSetting()->site_phone_alter }}">{{ siteSetting()->site_phone_alter }}</a>
                                    </p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <span class="icon-email"></span>
                                    </div>
                                    <p>
                                        <a href="mailto:{{ siteSetting()->site_email }}">{{ siteSetting()->site_email }}</a>
                                        <br>
                                        <a href="mailto:{{ siteSetting()->site_email_alter }}">{{ siteSetting()->site_email_alter }}</a>
                                    </p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <span class="icon-pin"></span>
                                    </div>
                                    <p>{{ siteSetting()->head_address }}</p>
                                </li>
                            </ul>
                            <div class="service-details__get-started-btn-box">
                                <a href="{{ route('frontend.contact.us') }}" class="thm-btn">get in touch <span class="fas fa-arrow-right"></span></a>
                            </div>
                        </div>

                    </div>

                </div>
                <!--End Sidebar-->

            </div>

        </div>

    </section>
    <!--Blog Details Start-->


    <script>
        (function() {
            const input = document.getElementById('blog-search-input');
            const resultsBox = document.getElementById('blog-search-results');
            const container = document.getElementById('search-cards-container');
            const noResults = document.getElementById('search-no-results');
            let debounceTimer;

            function positionDropdown() {
                const rect = input.getBoundingClientRect();
                resultsBox.style.top = rect.bottom + 'px';
                resultsBox.style.left = rect.left + 'px';
                resultsBox.style.width = rect.width + 'px';
            }

            function renderCards(blogs) {
                container.innerHTML = '';
                if (blogs.length === 0) {
                    noResults.style.display = 'block';
                    container.style.display = 'none';
                } else {
                    noResults.style.display = 'none';
                    container.style.display = 'block';
                    blogs.forEach(function(blog) {
                        const card = document.createElement('a');
                        card.href = blog.url;
                        card.style.cssText = `
                    display: flex;
                    align-items: flex-start;
                    gap: 12px;
                    padding: 14px 16px;
                    text-decoration: none;
                    color: inherit;
                    border-bottom: 1px solid #ebebeb;
                    transition: background 0.2s;
                    box-sizing: border-box;
                `;
                        card.onmouseenter = () => card.style.background = '#f0f0ff';
                        card.onmouseleave = () => card.style.background = 'transparent';
                        card.innerHTML = `
                    <img src="${blog.image}" alt="${blog.title}"
                         style="width:60px;height:60px;object-fit:cover;border-radius:6px;flex-shrink:0;margin-top:2px;">
                    <div style="overflow:hidden;flex:1;min-width:0;">
                        <div style="font-weight:600;font-size:13px;line-height:1.4;
                                    color:#222;margin-bottom:6px;
                                    display:-webkit-box;-webkit-line-clamp:2;
                                    -webkit-box-orient:vertical;overflow:hidden;">
                            ${blog.title}
                        </div>
                        <div style="font-size:11px;color:#888;display:flex;flex-wrap:wrap;gap:8px;">
                            <span><i class="fas fa-tag" style="margin-right:3px;color:#6a49f2;"></i>${blog.category}</span>
                            <span><i class="icon-calendar" style="margin-right:3px;color:#6a49f2;"></i>${blog.date}</span>
                        </div>
                    </div>
                `;
                        container.appendChild(card);
                    });
                }
                positionDropdown();
                resultsBox.style.display = 'block';
            }

            input.addEventListener('input', function() {
                clearTimeout(debounceTimer);
                const q = this.value.trim();
                if (q.length < 2) {
                    resultsBox.style.display = 'none';
                    return;
                }
                debounceTimer = setTimeout(function() {
                    fetch(`{{ route('frontend.blog.search') }}?q=${encodeURIComponent(q)}`)
                        .then(r => r.json())
                        .then(renderCards)
                        .catch(() => {
                            resultsBox.style.display = 'none';
                        });
                }, 300);
            });

            // Reposition on scroll/resize
            window.addEventListener('scroll', function() {
                if (resultsBox.style.display !== 'none') positionDropdown();
            });
            window.addEventListener('resize', function() {
                if (resultsBox.style.display !== 'none') positionDropdown();
            });

            document.addEventListener('click', function(e) {
                if (!input.contains(e.target) && !resultsBox.contains(e.target)) {
                    resultsBox.style.display = 'none';
                }
            });

            input.addEventListener('focus', function() {
                if (this.value.trim().length >= 2 && container.children.length > 0) {
                    positionDropdown();
                    resultsBox.style.display = 'block';
                }
            });
        })();
    </script>
@endsection
