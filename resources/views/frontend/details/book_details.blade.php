@extends('frontend.dashboard')
@section('frontend_title', $book->title)

@section('frontend_content')

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>{{ $book->title }}</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li><a href="{{ route('frontend.book.list') }}">Books</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>{{ Str::limit($book->title, 40) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <section class="blog-page">
        <div class="container">

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="book-details">
                <div class="book-details__cover-wrap">
                    <div class="book-details__cover-frame">
                        <img class="book-details__cover" src="{{ $book->cover_image ? asset($book->cover_image) : asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }}" alt="{{ $book->title }}">
                        <span class="book-details__cover-shine"></span>
                    </div>

                    @if ($book->sample_pdf)
                        <button type="button" class="book-details__sample-btn js-open-pdf-modal" data-pdf-url="{{ route('frontend.book.sample', $book->slug) }}" data-pdf-title="{{ $book->title }}">
                            <i class="fas fa-book-open"></i> Read Sample
                        </button>
                    @endif

                    <ul class="book-details__trust">
                        <li><i class="fas fa-truck"></i> Fast home delivery</li>
                        <li><i class="fas fa-shield-alt"></i> 100% original copy</li>
                        <li><i class="fas fa-lock"></i> Secure checkout</li>
                    </ul>
                </div>

                <div>
                    <span class="book-details__badge {{ $book->stock > 0 ? '' : 'is-out' }}">
                        <i class="fas {{ $book->stock > 0 ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                        {{ $book->stock > 0 ? 'Available Now' : 'Out of Stock' }}
                    </span>
                    @if ($book->has_discount)
                        <span class="book-details__badge" style="background:#dc3545;color:#fff;margin-left:6px;">
                            <i class="fas fa-percent"></i> {{ $book->discount_percent }}% OFF
                        </span>
                    @endif

                    <h2 class="book-details__title">{{ $book->title }}</h2>
                    @if ($book->author)
                        <p class="book-details__author">by <span>{{ $book->author }}</span></p>
                    @endif

                    <div class="book-details__purchase">
                        <div class="book-details__price">
                            <span class="book-details__price-now">৳ {{ number_format($book->has_discount ? $book->final_price : $book->price) }}</span>
                            @if ($book->has_discount)
                                <span class="book-details__price-old">৳ {{ number_format($book->price) }}</span>
                            @endif
                        </div>

                        @if ($book->stock > 0)
                            <form action="{{ route('frontend.book.cart.add', $book->id) }}" method="POST" class="book-details__buy js-add-to-cart">
                                @csrf
                                <div class="book-details__qty-stepper">
                                    <button type="button" class="book-details__qty-btn book-details__qty-minus" aria-label="Decrease quantity">&minus;</button>
                                    <input type="number" name="quantity" value="1" min="1" class="book-details__qty" inputmode="numeric" data-max="{{ $book->stock }}">
                                    <button type="button" class="book-details__qty-btn book-details__qty-plus" aria-label="Increase quantity">&plus;</button>
                                </div>
                                <button type="submit" class="t-btn-fill book-details__cart-btn">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                            </form>
                        @endif
                    </div>

                    <div class="book-details__desc">
                        {!! nl2br(e($book->description)) !!}
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var stepper = document.querySelector('.book-details__qty-stepper');
            if (!stepper) return;

            var input = stepper.querySelector('.book-details__qty');
            var minus = stepper.querySelector('.book-details__qty-minus');
            var plus = stepper.querySelector('.book-details__qty-plus');
            var max = parseInt(input.getAttribute('data-max'), 10) || 9999;
            var min = parseInt(input.getAttribute('min'), 10) || 1;

            function clamp(val) {
                if (isNaN(val)) val = min;
                return Math.min(max, Math.max(min, val));
            }

            minus.addEventListener('click', function() {
                input.value = clamp(parseInt(input.value, 10) - 1);
            });

            plus.addEventListener('click', function() {
                input.value = clamp(parseInt(input.value, 10) + 1);
            });

            input.addEventListener('change', function() {
                input.value = clamp(parseInt(input.value, 10));
            });
        });
    </script>

    @include('frontend.partials.book_pdf_modal')
    @include('frontend.partials.cart_ajax')

@endsection