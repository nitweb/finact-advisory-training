<style>
    .tp-leftarrow,
    .tp-rightarrow {
        display: none !important;
    }
</style>

<div id="rev_slider_1078_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container slide-overlay" data-alias="classic4export" data-source="gallery" style="margin:0px auto;background-color:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">

    <div id="rev_slider_1078_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.8">

        <div class="slotholder"></div>

        <ul>

            @foreach ($slider as $item)
                <li data-index="rs-{{ $loop->index }}" data-transition="slideremovedown" data-slotamount="7" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="2000" data-rotate="0" data-saveperformance="off" data-title="{{ $item->title ?? 'Slide' }}" data-description="">

                    <!-- Overlay -->
                    {{-- <div class="overlay"></div> --}}

                    <!-- Background Image -->
                    <img src="{{ asset($item->slider_image) }}" alt="{{ $item->title ?? 'Slide Image' }}" data-bgposition="center center" data-kenburns="off" data-duration="30000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0" data-bgparallax="10" class="rev-slidebg" data-no-retina>

                </li>
            @endforeach

        </ul>

    </div>

</div>
