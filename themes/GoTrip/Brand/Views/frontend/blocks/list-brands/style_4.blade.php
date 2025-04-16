<section class="layout-pt-md layout-pb-md bravo-list-brands @if(!empty($layout)) {{ $layout }} @endif">
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
                        <button class="d-flex items-center text-24 arrow-left-hover js-places-prev">
                            <i class="icon icon-arrow-left"></i>
                        </button>
                    </div>
                    {{-- <div class="col-auto">
                        <div class="pagination -dots text-border js-places-pag"></div>
                    </div> --}}
                    <div class="col-auto">
                        <button class="d-flex items-center text-24 arrow-right-hover js-places-next">
                            <i class="icon icon-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-40 overflow-hidden js-section-slider" data-gap="30" data-slider-cols="xl-5 lg-3 md-2 sm-2 base-1" data-nav-prev="js-places-prev" data-pagination="js-places-pag" data-nav-next="js-places-next">
            <div class="swiper-wrapper">
                @if($brandList)
                    @foreach($brandList as $key => $row)
                        @php
                            $translation = $row->translate();
                            $link_brand = '#';
                            $to_brand_detail = '#';
                            // if(is_string($service_type)){
                            //     $link_brand = $row->getLinkForPageSearch($service_type);
                            // }
                            // if(is_array($service_type) and count($service_type) == 1){
                            //     $link_brand = $row->getLinkForPageSearch($service_type[0] ?? "");
                            // }
                            // if($to_brand_detail){
                            //     $link_brand = $row->getDetailUrl();
                            // }
                        @endphp
                        <div data-anim-child="slide-left delay-{{$key + 3}}" class="swiper-slide">
                            @if($to_brand_detail)
                                <a href="{{ $link_brand }}">
                            @endif
                                <div class="citiesCard -type-2 fyv_brands">
                                    <div class="brand_list">
                                        <div class="citiesCard__image ratio ratio-4:4">


                                            {!! get_fvy_image_tag($row->image_id,'medium',['class'=>'col-12 js-lazy','alt'=>$translation->name]) !!}
                                        </div>
                                        <div class="citiesCard__content py-10">
                                            <h4 class="text-20 lh-13 fw-500 text-dark-1">{{$translation->name}}</h4>

                                        </div>
                                    </div>
                                </div>
                            @if($to_brand_detail) </a> @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
