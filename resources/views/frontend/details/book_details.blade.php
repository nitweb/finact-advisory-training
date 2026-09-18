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

            <div class="row">
                <div class="col-lg-5">
                    <img src="{{ $book->cover_image ? asset($book->cover_image) : asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }}"
                         alt="{{ $book->title }}" style="width:100%; border-radius:8px;">
                </div>

                <div class="col-lg-7">
                    <h2>{{ $book->title }}</h2>
                    @if ($book->author)
                        <p style="color:#777; margin-bottom:15px;">by {{ $book->author }}</p>
                    @endif

                    <div class="t-fee-row" style="max-width:340px;">
                        <div class="t-fee-block">
                            <span class="t-fee-lbl">Price</span>
                            <span class="t-fee-main">৳ {{ number_format($book->price) }}</span>
                        </div>
                        <div class="t-fee-divider"></div>
                        <div class="t-fee-block">
                            <span class="t-fee-lbl">Availability</span>
                            <span class="t-fee-main">
                                {{ $book->stock > 0 ? $book->stock . ' in stock' : 'Out of stock' }}
                            </span>
                        </div>
                    </div>

                    <div style="margin:20px 0; line-height:1.8;">
                        {!! nl2br(e($book->description)) !!}
                    </div>

                    @if ($book->sample_pdf)
                        <div style="margin-bottom:20px;">
                            <a href="{{ route('frontend.book.sample', $book->slug) }}" target="_blank" class="t-btn-outline">
                                <i class="fas fa-book-open"></i> Read Sample
                            </a>
                        </div>
                    @endif

                    @if ($book->stock > 0)
                        <form action="{{ route('frontend.book.cart.add', $book->id) }}" method="POST" style="display:flex; gap:10px; align-items:center;">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1" max="{{ $book->stock }}" style="width:80px; padding:8px;">
                            <button type="submit" class="t-btn-fill">Add to Cart</button>
                        </form>
                    @else
                        <span class="t-type-badge">Out of Stock</span>
                    @endif
                </div>
            </div>

            @if ($book->sample_pdf)
                <div style="margin-top:40px;">
                    <h4>Read Sample</h4>
                    <iframe src="{{ route('frontend.book.sample', $book->slug) }}"
                            style="width:100%; height:800px; border:1px solid #eee; border-radius:8px;"
                            title="{{ $book->title }} — Sample Preview">
                    </iframe>
                </div>
            @endif

        </div>
    </section>

@endsection
