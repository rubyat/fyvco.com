<?php
namespace Modules\Airport\Models;

use App\BaseModel;

class AirportTranslation extends BaseModel
{
    protected $table = 'bravo_airport_translations';
    protected $fillable = ['name', 'content','trip_ideas'];
    protected $seo_type = 'airport_translation';
    protected $cleanFields = [
        'content'
    ];
    protected $casts = [
        'trip_ideas'  => 'array',
    ];
}
