<?php
namespace Modules\Brand\Models;

use App\BaseModel;

class BrandTranslation extends BaseModel
{
    protected $table = 'bravo_brand_translations';
    protected $fillable = ['name', 'content','trip_ideas'];
    protected $seo_type = 'brand_translation';
    protected $cleanFields = [
        'content'
    ];
    protected $casts = [
        'trip_ideas'  => 'array',
    ];
}
