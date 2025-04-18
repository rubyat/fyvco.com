<section class="layout-pt-md layout-pb-md {{$layout ?? ''}}">
    <div data-anim-wrap class="container">
        <div data-anim-child="slide-up delay-1" class="row justify-center text-center">
            <div class="col-auto">
                <div class="sectionTitle -md">
                    <h2 class="sectionTitle__title">{{$title ?? ''}}</h2>
                    <p class=" sectionTitle__text mt-5 sm:mt-0">{{$desc ?? ''}}</p>
                </div>
            </div>
        </div>

        <div class="row y-gap-40 justify-between pt-40 sm:pt-20">
            @if($rows)
            @php
                $num = 1;
            @endphp
                @foreach($rows as $k => $row)
                    @php
                        $translation = $row->translate();
                         $col_xl = 'col-xl-3';
                        if($num == 2 || $num == 4)
                        {
                            $col_xl = 'col-xl-6';
                        }

                    $num++;
                    if($num == 6)
                    {
                        $num = 1;
                    }

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
                    <div data-anim-child="slide-up delay-{{$k+2}}" class="{{$col_xl}} col-md-4 col-sm-6">
                        @if(!empty($link_airport)) <a href="{{ $link_airport }}"> @endif
                            <div class="citiesCard -type-3 rounded-4 d-inline">
                                <div class="citiesCard__image">
                                    <img class="col-12 js-lazy" src="#" data-src="{{get_file_url($row->image_id)}}" alt="{{ $translation->name ?? '' }}">
                                </div>
                                <div class="citiesCard__content px-30 py-30">
                                    <h4 class="text-26 fw-600 text-white">{{ $translation->name }}</h4>
                                    <div class="text-15 text-white">
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
                                    </div>
                                </div>
                            </div>
                        @if(!empty($link_airport)) </a> @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
