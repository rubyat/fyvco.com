<?php
namespace Themes\GoTrip\Airport\Models;

use App\BaseModel;

class AirportTranslation extends \Modules\Airport\Models\AirportTranslation
{
    protected $fillable = ['name', 'content','trip_ideas','general_info'];
    protected $casts         = [
        'trip_ideas' => 'array',
        'general_info' => 'array',
    ];
}
