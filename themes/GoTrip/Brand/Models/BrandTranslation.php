<?php
namespace Themes\GoTrip\Brand\Models;

use App\BaseModel;

class BrandTranslation extends \Modules\Brand\Models\BrandTranslation
{
    protected $fillable = ['name', 'content','trip_ideas','general_info'];
    protected $casts         = [
        'trip_ideas' => 'array',
        'general_info' => 'array',
    ];
}
