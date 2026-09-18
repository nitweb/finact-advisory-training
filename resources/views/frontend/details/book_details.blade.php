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
                    <img class="book-details__cover"
                         src="{{ $book->cover_image ? asset($book->cover_image) : asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }}"
                         alt="{{ $book->title }}">

                    @if ($book->sample_pdf)
                        <button type="button"
                                class="book-details__sample-btn js-open-pdf-modal"
                                data-pdf-url="{{ route('frontend.book.sample', $book->slug) }}"
                                data-pdf-title="{{ $book->title }}">
                            <i class="fas fa-book-open"></i> Read Sample
                        </button>
                    @endif
                </div>

                <div>
                    <span class="book-details__badge">
                        {{ $book->stock > 0 ? 'Available Now' : 'Out of Stock' }}
                    </span>

                    <h2 class="book-details__title">{{ $book->title }}</h2>
                    @if ($book->author)
                        <p class="book-details__author">by {{ $book->author }}</p>
                    @endif

                    <div class="book-details__fee-row">
                        <div class="book-details__fee-block">
                            <span class="book-details__fee-lbl">Price</span>
                            <span class="book-details__fee-main">৳ {{ number_format($book->price) }}</span>
                        </div>
                        <div class="book-details__fee-divider"></div>
                        <div class="book-details__fee-block">
                            <span class="book-details__fee-lbl">Availability</span>
                            <span class="book-details__fee-main">
                                {{ $book->stock > 0 ? $book->stock . ' in stock' : 'Out of stock' }}
                            </span>
                        </div>
                    </div>

                    <div class="book-details__desc">
                        {!! nl2br(e($book->description)) !!}
                    </div>

                    @if ($book->stock > 0)
                        <form action="{{ route('frontend.book.cart.add', $book->id) }}" method="POST" class="book-details__buy">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1" max="{{ $book->stock }}" class="book-details__qty">
                            <button type="submit" class="t-btn-fill" style="flex:none; padding:13px 34px;">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        </form>
                    @else
                        <span class="t-type-badge" style="position:static;">Out of Stock</span>
                    @endif
                </div>
            </div>

        </div>
    </section>

    @include('frontend.partials.book_pdf_modal')

@endsection