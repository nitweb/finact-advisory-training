@extends('frontend.dashboard')
@section('frontend_title', 'Books')

@section('frontend_content')

    <style>
        /* ===== Book card: clean white style, full cover with soft shadow ===== */
        .book-card {
            background: #fff;
            border: 1px solid #e9e9ee;
            border-radius: 10px;
            overflow: hidden;
            transition: box-shadow .25s ease, transform .25s ease;
        }
        .book-card:hover {
            box-shadow: 0 10px 28px rgba(0, 0, 0, .08);
            transform: translateY(-3px);
        }

        .book-card .book-card__img-wrap {
            position: relative;
            height: 280px;               /* sob card er same height */
            padding: 26px 20px 12px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .book-card .book-card__img-wrap img.book-card__img {
            display: block;
            width: auto;
            max-width: 100%;
            height: 100%;
            max-height: 100%;
            object-fit: contain;
            object-position: center;
            filter: drop-shadow(6px 8px 10px rgba(0, 0, 0, .28));
            transition: transform .3s ease;
        }
        .book-card:hover .book-card__img {
            transform: scale(1.04);
        }

        /* stock badge always on top */
        .book-card .book-card__stock {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 2;
        }

        /* discount badge top-left */
        .book-card .book-card__discount {
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 2;
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            background: #dc3545;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .04em;
            line-height: 1.2;
        }

        /* centered text */
        .book-card .book-card__body {
            text-align: center;
        }
        .book-card .book-card__actions {
            justify-content: center;
        }
    </style>

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

            <div class="book-toolbar">
                <div class="book-toolbar__count">
                    <strong>{{ $book_list->total() }}</strong> book{{ $book_list->total() == 1 ? '' : 's' }} available
                </div>
                <a href="{{ route('frontend.book.cart') }}" class="book-cart-btn">
                    <i class="fas fa-shopping-cart"></i> View Cart
                    @if (session('book_cart') && count(session('book_cart')) > 0)
                        <span class="book-cart-btn__badge">{{ collect(session('book_cart'))->sum('quantity') }}</span>
                    @endif
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="book-grid">

                @forelse ($book_list as $item)
                    @php
                        $cover = $item->cover_image
                            ? asset($item->cover_image)
                            : asset('frontend/assets/images/backgrounds/page-header-bg.jpg');
                    @endphp

                    <div class="book-card">
                        <div class="book-card__img-wrap">
                            <a href="{{ route('frontend.book.details', $item->slug) }}" style="display:flex;align-items:center;justify-content:center;width:100%;height:100%;">
                                <img class="book-card__img" src="{{ $cover }}" alt="{{ $item->title }}">
                            </a>

                            @if ($item->has_discount)
                                <span class="book-card__discount">{{ $item->discount_percent }}% OFF</span>
                            @endif

                            <span class="book-card__stock {{ $item->stock > 0 ? 'book-card__stock--in' : 'book-card__stock--out' }}">
                                {{ $item->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                            </span>
                        </div>

                        <div class="book-card__body">
                            <h3 class="book-card__title">
                                <a href="{{ route('frontend.book.details', $item->slug) }}">
                                    {{ Str::limit($item->title, 55) }}
                                </a>
                            </h3>

                            @if ($item->author)
                                <p class="book-card__author">by {{ $item->author }}</p>
                            @endif

                            <div class="book-card__fee-row">
                                <div class="book-card__fee-block">
                                    <span class="book-card__fee-lbl">Price</span>
                                    @if ($item->has_discount)
                                        <span class="book-card__fee-main">৳ {{ number_format($item->final_price) }}
                                            <del style="font-size:.75em;opacity:.6;font-weight:400;">৳ {{ number_format($item->price) }}</del>
                                        </span>
                                    @else
                                        <span class="book-card__fee-main">৳ {{ number_format($item->price) }}</span>
                                    @endif
                                </div>
                                <div class="book-card__fee-divider"></div>
                                <div class="book-card__fee-block">
                                    <span class="book-card__fee-lbl">Availability</span>
                                    <span class="book-card__fee-main">
                                        {{ $item->stock > 0 ? $item->stock . ' left' : 'Sold out' }}
                                    </span>
                                </div>
                            </div>

                            <div class="book-card__actions">
                                <a href="{{ route('frontend.book.details', $item->slug) }}" class="t-btn-outline">
                                    View Details
                                </a>
                                @if ($item->stock > 0)
                                    <form action="{{ route('frontend.book.cart.add', $item->id) }}" method="POST" class="js-add-to-cart">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="t-btn-fill">Add to Cart</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="book-empty">
                        <i class="fas fa-book"></i>
                        <p>No books available right now.</p>
                    </div>
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

    @include('frontend.partials.book_pdf_modal')
    @include('frontend.partials.cart_ajax')

@endsection