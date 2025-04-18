<?php
namespace Themes\GoTrip\Airport\Models;

use App\BaseModel;

class Airport extends \Modules\Airport\Models\Airport
{
    protected $casts         = [
        'trip_ideas' => 'array',
        'general_info' => 'array',
    ];

    protected $translation_class = AirportTranslation::class;
}
