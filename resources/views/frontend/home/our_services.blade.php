<style>
    /* .row {
        display: flex;
        flex-wrap: wrap;
    } */

    .col-md-3.col-sm-6 {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        /* Ensures the content aligns properly */
    }

    .post.style2.column.col-style2 {
        height: 100%;
        /* Makes the cards consistent in height */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        /* Optional styling */
        /* padding: 15px; */
    }

    .featured-post img {
        width: 100%;
        /* Ensures images are consistent */
        height: 250px;
        /* Fix the height of images */
        object-fit: cover;
        /* Keeps aspect ratio intact */
    }

    .content-post {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex-grow: 1;
    }

    .title-post {
        font-size: 16px;
        margin-bottom: 10px;
    }

    p {
        flex-grow: 1;
        /* Takes up remaining space between title and "Read More" */
        font-size: 14px;
        margin: 15px 0;
    }

    .readmore {
        align-self: flex-start;
        margin-top: auto;
        /* Pushes the "Read More" link to the bottom */
        font-size: 13px;
        color: #007bff;
        font-weight: bold;
        text-decoration: none;
    }

    .readmore:hover {
        text-decoration: none;
    }

    .post.style2.column .content-post .readmore::before {
        top: 20px;
    }
</style>

<section class="flat-row v16 bg-theme">

    <div class="container">

        <div class="row">

            <div class="col-md-12" data-aos="fade-up">

                <div class="title-section v2 style1" style="margin-bottom: 0px;">

                    <h1 class="title">Our Services</h1>

                </div>

            </div>

        </div>

        <section class="pdtop">
            <div class="container">

                <div class="row">

                    @foreach ($services as $item)
                        <div class="col-md-4 col-sm-6" style="margin-top: 50px;" data-aos="zoom-in" data-aos-delay="50" data-aos-duration="1000">

                            <article class="post style2 column col-style2 clearfix">

                                <div class="featured-post">

                                    <a href="{{ route('frontend.service.details', $item->slug) }}">
                                        <img src="{{ asset($item->serviceDetail->service_image) }}" alt="image">
                                    </a>

                                </div>

                                <div class="content-post">

                                    <h2 class="title-post"><a href="{{ route('frontend.service.details', $item->slug) }}">{{ $item->title }}</a></h2>

                                    <p style="text-align: justify;">{{ Str::limit($item->serviceDetail->short_description, 120) }}</p>

                                    <a href="{{ route('frontend.service.details', $item->slug) }}" class="readmore">READ MORE</a>

                                </div>

                            </article>

                        </div>
                    @endforeach

                </div>

                @if (count($services) >= 3)
                    <div class="widgets-header-information" style="margin-top: 40px;">
                        <div class="informaiton-text">
                            <div class="info-icon">
                                <div class="btn-click text-center">
                                    <a href="{{ route('frontend.all.services.list') }}" class="btn-black">Load More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </section>

    </div>

</section>
