<?php
namespace Themes\GoTrip\Brand\Models;

use App\BaseModel;

class Brand extends \Modules\Brand\Models\Brand
{
    protected $casts         = [
        'trip_ideas' => 'array',
        'general_info' => 'array',
    ];

    protected $translation_class = BrandTranslation::class;
}
