@extends('frontend.dashboard')
@section('frontend_title', 'Gallery')
@section('frontend_content')

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Gallery</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Gallery</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Gallery Section Start-->
    <section class="gallery-section">
        <div class="container">
            <div class="gallery-grid">
                @foreach ($gallery as $item)
                    <div class="gallery-item">
                        <div class="gallery-item__inner">
                            <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" loading="lazy">
                            <div class="gallery-item__overlay">
                                @if (isset($item->category) && $item->category)
                                    <span class="gallery-item__tag">{{ $item->category }}</span>
                                @endif
                                <span class="gallery-item__title">{{ $item->title }}</span>
                            </div>
                            <div class="gallery-item__zoom">
                                <svg viewBox="0 0 24 24" width="16" height="16">
                                    <path d="M15.5 14h-.79l-.28-.27A6.5 6.5 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--Gallery Section End-->

    <!-- Lightbox -->
    <div class="gallery-lightbox" id="galleryLightbox">
        <div class="gallery-lightbox__backdrop" id="lbBackdrop"></div>
        <div class="gallery-lightbox__panel">
            <button class="gallery-lightbox__close" id="lbClose">&#x2715;</button>
            <img src="" alt="" id="lbImg">
            <div class="gallery-lightbox__footer">
                <p class="gallery-lightbox__title" id="lbTitle"></p>
                <span class="gallery-lightbox__counter" id="lbCounter"></span>
            </div>
        </div>
        <button class="gallery-lightbox__btn gallery-lightbox__btn--prev" id="lbPrev">&#8249;</button>
        <button class="gallery-lightbox__btn gallery-lightbox__btn--next" id="lbNext">&#8250;</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const items = document.querySelectorAll('.gallery-item');
            const lb = document.getElementById('galleryLightbox');
            const lbImg = document.getElementById('lbImg');
            const lbTitle = document.getElementById('lbTitle');
            const lbCnt = document.getElementById('lbCounter');
            let current = 0;

            function open(idx) {
                current = idx;
                const img = items[idx].querySelector('img');
                const title = items[idx].querySelector('.gallery-item__title').textContent;
                lbImg.src = img.src;
                lbImg.alt = title;
                lbTitle.textContent = title;
                lbCnt.textContent = (idx + 1) + ' / ' + items.length;
                lb.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function close() {
                lb.classList.remove('active');
                document.body.style.overflow = '';
            }

            items.forEach((item, i) => item.addEventListener('click', () => open(i)));
            document.getElementById('lbClose').addEventListener('click', close);
            document.getElementById('lbBackdrop').addEventListener('click', close);
            document.getElementById('lbPrev').addEventListener('click', () => open((current - 1 + items.length) % items.length));
            document.getElementById('lbNext').addEventListener('click', () => open((current + 1) % items.length));

            document.addEventListener('keydown', function(e) {
                if (!lb.classList.contains('active')) return;
                if (e.key === 'Escape') close();
                if (e.key === 'ArrowLeft') open((current - 1 + items.length) % items.length);
                if (e.key === 'ArrowRight') open((current + 1) % items.length);
            });
        });
    </script>

@endsection
