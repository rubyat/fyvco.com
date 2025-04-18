<section class="layout-pt-md layout-pb-md bravo-list-airports @if(!empty($layout)) {{ $layout }} @endif">
    <div data-anim-wrap class="container">
        <div data-anim-child="slide-up delay-1" class="row y-gap-20 justify-between items-end">
            <div class="col-auto">
                <div class="sectionTitle -md">
                    <h2 class="sectionTitle__title">{{$title}}</h2>
                    <p class=" sectionTitle__text mt-5 sm:mt-0">{{$desc}}</p>
                </div>
            </div>
            <div class="col-auto">
                <div class="d-flex x-gap-15 items-center justify-center pt-40 sm:pt-20">
                    <div class="col-auto">
                        <button class="d-flex items-center text-24 arrow-left-hover js-places-prev-2">
                            <i class="icon icon-arrow-left"></i>
                        </button>
                    </div>
                    {{-- <div class="col-auto">
                        <div class="pagination -dots text-border js-places-pag"></div>
                    </div> --}}
                    <div class="col-auto">
                        <button class="d-flex items-center text-24 arrow-right-hover js-places-next-2">
                            <i class="icon icon-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-40 overflow-hidden js-section-slider" data-gap="30" data-slider-cols="xl-5 lg-3 md-2 sm-2 base-1" data-nav-prev="js-places-prev-2" data-pagination="js-places-pag" data-nav-next="js-places-next-2">
            <div class="swiper-wrapper">
                @if($rows)
                    @php $index = 2; @endphp
                    @foreach($rows as $key => $row)
                        @php
                            $translation = $row->translate();
                        @endphp
                        <div data-anim-child="slide-left delay-{{$key + 3}}" class="swiper-slide">
                            @if($to_airport_detail) <a href="{{$row->getDetailUrl()}}"> @endif
                                <div class="citiesCard -type-4 d-block text-center">
                                    <div class="citiesCard__image size-160 rounded-full mx-auto">
                                        <img class="object-cover js-lazy" data-src="{{ $row->getImageUrl() }}" src="{{ $row->getImageUrl() }}" alt="{{ $translation->name }}">
                                    </div>
                                    <div class="citiesCard__content mt-10">
                                        <h4 class="text-18 lh-13 fw-500 text-dark-1">{{ $translation->name }}</h4>
                                        {{-- @if(is_array($service_type))
                                            @php $count_all = 0; @endphp
                                            @foreach($service_type as $k => $type)
                                                @php $count_all += (int) $row->getDisplayNumberServiceInAirport($type) @endphp
                                            @endforeach
                                            @if(!empty($count_all))
                                                <span class="text-14 text-light-1">{{$count_all}} {{ __("travellers") }}</span>
                                            @endif
                                        @else
                                            @if(!empty($text_service = $row->getDisplayNumberServiceInAirport($service_type)))
                                                <span class="text-14 text-light-1">{{$text_service}}</span>
                                            @endif
                                        @endif --}}
                                    </div>
                                </div>
                            @if($to_airport_detail) </a> @endif
                        </div>
                        @php $index++; if($key == 7) $index = 2; @endphp
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>

