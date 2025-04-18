<section class="layout-pt-md layout-pb-md bravo-list-airports bg_ash_bg_foorer @if(!empty($layout)) {{ $layout }} @endif">
    <div class="container">
        <div class="row">
            <div class="col-auto">
                <div class="sectionTitle -md">
                    <h2 class="sectionTitle__title">{{$title}}</h2>
                    <p class=" sectionTitle__text mt-5 sm:mt-0">{{$desc}}</p>
                </div>
            </div>
        </div>
        <div class="tabs -pills pt-40 js-tabs">
            <div class="tabs__content pt-30 js-tabs-content">
                <div class="row y-gap-20">
                    @if($rows)
                        @foreach($rows as $row)
                            @php $translation = $row->translate();
                            $link_airport = false;
                            if(is_string($service_type)){
                                $link_airport = $row->getLinkForPageSearch($service_type);
                            }
                            if(is_array($service_type) and count($service_type) == 1){
                                $link_airport = $row->getLinkForPageSearch($service_type[0] ?? "");
                            }
                            if($to_airport_detail){
                                $link_airport = $row->getDetailUrl();
                            }
                            @endphp
                            <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                                <div class="d-block">
                                    @if(!empty($link_airport)) <a href="{{ $link_airport }}"> @endif
                                        <div class="text-15 fw-500">{{$translation->name}}</div>
                                        {{-- <div class="text-14 text-light-1">
                                            @if(is_array($service_type))
                                                @foreach($service_type as $k => $type)
                                                    @php $count = $row->getDisplayNumberServiceInAirport($type) @endphp
                                                    @if(!empty($count))
                                                        @if(empty($link_airport))
                                                            <a href="{{ $row->getLinkForPageSearch( $type ) }}" target="_blank">
                                                                <span class="me-2">{{$count}}</span>
                                                            </a>
                                                        @else
                                                            <span class="me-2">{{$count}}</span>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @else
                                                @if(!empty($text_service = $row->getDisplayNumberServiceInAirport($service_type)))
                                                    <span class="me-2">{{$text_service}}</span>
                                                @endif
                                            @endif
                                        </div> --}}
                                    @if(!empty($link_airport)) </a> @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
