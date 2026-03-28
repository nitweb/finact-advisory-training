<section class="flat-row v16 Teammember">

    <div class="container">

        <div class="row">

            <div class="col-md-12" data-aos="fade-up">

                <div class="title-section v1 style1">

                    <h1 class="title">Meet Our Partners</h1>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-12">

                <div class="flat_team" data-item="4" data-nav="false" data-dots="false" data-auto="true">

                    @foreach ($top_level_team as $item)
                        <div class="item c1">
                            <div class="flat-team">
                                <a href="{{ route('frontend.team.details', $item->slug) }}">
                                    <div class="avatar">
                                        <img src="{{ asset($item->team_image) }}" alt="{{ $item->name }}" style="width: 100%;">
                                        <div class="overlay"></div>
                                        <div class="gallery-content">
                                            <ul class="gallery-link">
                                                <li class="icon-s FromLeft"><span><i class="fa-solid fa-link"></i></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h6 class="name">{{ $item->name }}</h6>
                                        <p class="position">{{ $item->designation }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>

        </div>

    </div>

</section>
