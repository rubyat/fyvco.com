@switch($layout)
    @case('style_2') @include('Brand::frontend.blocks.list-brands.style_2') @break
    @case('style_3') @include('Brand::frontend.blocks.list-brands.style_3') @break
    @case('style_4') @include('Brand::frontend.blocks.list-brands.style_4') @break
    @case('style_5') @include('Brand::frontend.blocks.list-brands.style_5') @break
    @case('style_6') @include('Brand::frontend.blocks.list-brands.style_6') @break
    @case('style_7') @include('Brand::frontend.blocks.list-brands.style_7') @break
    @case('style_8') @include('Brand::frontend.blocks.list-brands.style_8') @break
    @case('style_9') @include('Brand::frontend.blocks.list-brands.style_9') @break
    @case('style_10') @include('Brand::frontend.blocks.list-brands.style_10') @break
    @default @include('Brand::frontend.blocks.list-brands.default')
@endswitch
