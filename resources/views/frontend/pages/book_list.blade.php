@extends('frontend.dashboard')
@section('frontend_title', 'Books')

@section('frontend_content')

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Books</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li><a href="{{ route('frontend.training.development') }}">Professional Academy</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Books</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <section class="blog-page">
        <div class="container">

            <div style="display:flex; justify-content:flex-end; margin-bottom:20px;">
                <a href="{{ route('frontend.book.cart') }}" class="t-btn-fill">
                    <i class="fas fa-shopping-cart"></i> View Cart
                    @if (session('book_cart') && count(session('book_cart')) > 0)
                        ({{ collect(session('book_cart'))->sum('quantity') }})
                    @endif
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="training-grid">

                @forelse ($book_list as $item)
                    <div class="t-card">
                        <div class="t-img-wrap">
                            <img src="{{ $item->cover_image ? asset($item->cover_image) : asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }}" alt="{{ $item->title }}">
                        </div>

                        <div class="t-body">
                            <h3 class="t-title">
                                <a href="{{ route('frontend.book.details', $item->slug) }}">
                                    {{ Str::limit($item->title, 55) }}
                                </a>
                            </h3>

                            @if ($item->author)
                                <p class="t-desc">by {{ $item->author }}</p>
                            @endif

                            <div class="t-fee-row">
                                <div class="t-fee-block">
                                    <span class="t-fee-lbl">Price</span>
                                    <span class="t-fee-main">৳ {{ number_format($item->price) }}</span>
                                </div>
                                <div class="t-fee-divider"></div>
                                <div class="t-fee-block">
                                    <span class="t-fee-lbl">Availability</span>
                                    <span class="t-fee-main">
                                        {{ $item->stock > 0 ? $item->stock . ' in stock' : 'Out of stock' }}
                                    </span>
                                </div>
                            </div>

                            <div class="t-actions">
                                <a href="{{ route('frontend.book.details', $item->slug) }}" class="t-btn-outline">
                                    View Details
                                </a>
                                @if ($item->stock > 0)
                                    <form action="{{ route('frontend.book.cart.add', $item->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="t-btn-fill">Add to Cart</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No books available right now.</p>
                @endforelse

            </div>

            @if ($book_list->lastPage() > 1)
                <div class="blog-list__pagination" style="margin-top: 20px;">
                    <ul class="pg-pagination list-unstyled">
                        @if ($book_list->onFirstPage())
                            <li class="prev disabled" style="display:none;"><span><i class="fas fa-angle-left"></i></span></li>
                        @else
                            <li class="prev"><a href="{{ $book_list->previousPageUrl() }}" aria-label="Previous"><i class="fas fa-angle-left"></i></a></li>
                        @endif

                        @for ($i = 1; $i <= $book_list->lastPage(); $i++)
                            <li class="count {{ $book_list->currentPage() == $i ? 'active' : '' }}">
                                <a href="{{ $book_list->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        @if ($book_list->hasMorePages())
                            <li class="next"><a href="{{ $book_list->nextPageUrl() }}" aria-label="Next"><i class="fas fa-angle-right"></i></a></li>
                        @else
                            <li class="next disabled" style="display:none;"><span><i class="fas fa-angle-right"></i></span></li>
                        @endif
                    </ul>
                </div>
            @endif

        </div>
    </section>

@endsection
