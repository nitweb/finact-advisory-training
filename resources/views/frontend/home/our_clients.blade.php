<section class="flat-row v16 bg-theme">

    <div class="container">

        <div class="row">

            <div class="col-md-12" data-aos="fade-up">

                <div class="title-section v2 style1">

                    <h1 class="title">Our Clients</h1>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-12">

                <div class="flat-client" data-item="5" data-nav="false" data-dots="false" data-auto="true">

                    @foreach ($client as $item)
                        <div class="item c1"><img src="{{ asset($item->image) }}" alt="image"></div>
                    @endforeach

                </div>

            </div>

        </div>

    </div>

</section>
