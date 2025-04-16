@php

    $translation = $row->translate();

@endphp

<div class="carCard -type-1 d-block rounded-4 item-loop-gird-2 own-border {{$wrap_class ?? ''}}">

    <div class="carCard__image">

        <div class="has-skeleton">

        <div class="cardImage ratio ratio-3:2">

            <a @if(!empty($blank)) target="_blank" @endif href="{{ $row->getDetailUrl() }}">

                <div class="cardImage__content">

                    @if($row->image_url)

                        @if(!empty($disable_lazyload))

                            <img  src="{{$row->image_url}}" class="rounded-4 col-12 js-lazy" alt="{{ $translation->title ?? 'image' }}">

                        @else

                            {!! get_image_tag($row->image_id,'medium',['class'=>'rounded-4 col-12 js-lazy','alt'=>$translation->title]) !!}

                        @endif

                    @endif

                </div>

            </a>



            <div class="cardImage__leftBadge">

                @if($row->is_featured == "1")

                    <div class="py-5 px-15 rounded-right-4 text-12 lh-16 fw-500 uppercase bg-yellow-1 text-dark-1">

                        {{__("Featured")}}

                    </div>

                @endif

                @if($row->discount_percent)

                    <div class="py-5 px-15 rounded-right-4 text-12 lh-16 fw-500 uppercase bg-blue-1 text-white mt-5">

                        {{__("Sale off :number",['number'=>$row->discount_percent])}}

                    </div>

                @endif

            </div>

        </div>

        </div>

    </div>

    <div class="carCard__content">


        <a class="" @if(!empty($blank)) target="_blank" @endif href="{{ $row->getDetailUrl() }}">
            <div class="fyv home_name_rev price_action_area">

                <div class="car_name">{{ $translation->title }}</div>

                @if(setting_item('car_enable_review'))

                @php $reviewData = $row->getScoreReview(); $score_total = $reviewData['score_total']; @endphp
                    <div class="d-flex items-center has-skeleton fyv_home_rating">
                        @for ($i = 1; $i <= 5; $i++)
                            @if($i <= $score_total)
                                <span class="fa fa-star checked"></span>
                            @else
                                <span class="fa fa-star"></span>
                            @endif
                        @endfor
                    </div>

                @endif

    
                
            </div>
        </a>

      
        

        

        

    </div>

</div>

