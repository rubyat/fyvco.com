@switch($layout)
    @case('style_2') @include('Airport::frontend.blocks.list-airports.style_2') @break
    @case('style_3') @include('Airport::frontend.blocks.list-airports.style_3') @break
    @case('style_4') @include('Airport::frontend.blocks.list-airports.style_4') @break
    @case('style_5') @include('Airport::frontend.blocks.list-airports.style_5') @break
    @case('style_6') @include('Airport::frontend.blocks.list-airports.style_6') @break
    @case('style_7') @include('Airport::frontend.blocks.list-airports.style_7') @break
    @case('style_8') @include('Airport::frontend.blocks.list-airports.style_8') @break
    @case('style_9') @include('Airport::frontend.blocks.list-airports.style_9') @break
    @case('style_10') @include('Airport::frontend.blocks.list-airports.style_10') @break
    @default @include('Airport::frontend.blocks.list-airports.default')
@endswitch
