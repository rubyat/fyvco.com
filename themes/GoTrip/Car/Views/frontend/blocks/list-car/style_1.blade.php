<section class="layout-pt-md layout-pb-md bravo-list-event {{ $bg_class ?? "" }} block_layout car_listing_home_page">
    <div data-anim-wrap class="container">
        <div data-anim-child="slide-up delay-1" class="row  y-gap-20 justify-center text-center">
            <div class="col-auto">
                <div class="sectionTitle -md">
                    <h2 class="sectionTitle__title">{{ $title ?? '' }}</h2>
                </div>
            </div>
        </div>
        
        <div class="row y-gap-30 pt-40 sm:pt-20">
            @php
                $index = 2;
            @endphp
            @foreach($rows as $key => $row)
                <div data-anim-child="slide-up delay-{{ $index }}" class="col-xl-3 col-lg-3 col-sm-6 single_car">
                    @include('Car::frontend.layouts.search.loop-grid-home')
                </div>
                @php
                    $index++;
                    if($key == 5){
                        $index = 2;
                    }
                @endphp
            @endforeach
        </div>

        <div data-anim-child="slide-up delay-1" class="row  y-gap-20 justify-center text-center">
            <div class="col-auto">
                <div class="sectionDetails">
                    <h2 >{{ $desc ?? '' }}</h2>
                    <a href="{{ $button_url }}" class="">{{ $button_name }}</a>
                </div>
            </div>
        </div>

    </div>
</section>