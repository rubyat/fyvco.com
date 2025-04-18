<section class="pt-40 g-header">
    <div class="container">
        <div class="row y-gap-20 justify-between items-end">
            <div class="col-auto">
                <div class="row x-gap-20 items-center">
                    <div class="col-auto">
                        <h1 class="text-30 sm:text-25 fw-600">{{$translation->title}}</h1>
                    </div>
                    <div class="col-auto">
                        @if($row->star_rate)
                            @for($i = 1; $i <= $row->star_rate; $i++)
                                <i class="icon-star text-10 text-yellow-1"></i>
                            @endfor
                        @endif
                    </div>
                </div>
                <div class="row x-gap-20 y-gap-20 items-center">
                    <div class="col-auto">
                        <div class="d-flex items-center text-15 text-light-1">
                            <i class="icon-location-2 text-16 mr-5"></i>
                            {{$translation->address}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-auto d-none">
                <div class="row x-gap-15 y-gap-15 items-center">
                    <div class="col-auto">
                        <div class="text-14">
                            {{ __('Par night') }}
                            <div class="d-inline-flex justify-content-end align-baseline mt-5">
                                <div class="text-16 text-red-1 line-through mr-5">{{ $row->display_sale_price }}</div>
                                <div class="text-22 lh-12 fw-600">{{ $row->display_price }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto">
                        <a href="#hotel-rooms-form" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                            {{ __('Start Booking') }} <div class="icon-arrow-top-right ml-15"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if($row->getGallery())
    <div class="mt-10">
        <div class="container">
            @include('Layout::common.detail.gallery5car',['galleries' => $row->getGallery()])
        </div>
    </div>
@endif

<section class="pt-30" id="hotel-rooms">
    <div class="container">
        <div class="row y-gap-30">
            <div class="col-xl-12">
                <div class="row y-gap-40">
                    @if($translation->content)
                        <div id="overview" class="col-12 gotrip-overview">
                            <h3 class="text-22 fw-500 pt-20">{{__('Overview')}}</h3>
                            <div class="text-dark-1 text-15 mt-20 content-text">
                                {!! clean($translation->content) !!}
                            </div>
                            <span class="d-none btn-showmore pointer text-14 text-blue-1 fw-500 underline mt-10">
                                {{ __("Show More") }}
                            </span>
                        </div>
                    @endif
                    <div class="col-12">
                        @include('Hotel::frontend.layouts.details.hotel-attributes')
                    </div>
                    @if($translation->faqs)
                        <div class="col-12">
                            @include('Layout::common.detail.faq',['faqs'=>$translation->faqs])
                        </div>
                    @endif
                    @includeIf("Layout::common.detail.surrounding")
                </div>
            </div>
        </div>
        @include('Hotel::frontend.layouts.details.hotel-rooms')
    </div>
</section>
