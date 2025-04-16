<?php

namespace Modules\Brand\Traits;

use Modules\Brand\Models\Brand;

trait HasBrand
{

    /**
     * Get Brand
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, "brand_id")->with(['translation']);
    }

    public function brandBreadcrumbs(){
        $res = [];
        if($this->brand){
            $parents = $this->brand->ancestorsOf($this->brand);
            foreach ($parents as $parent){
                $translation = $parent->translate();
                $res[] = [
                    'name'  => $translation->name,
                    'url'  => route('brand.detail',['slug'=>$parent->slug]),
                ];
            }
            $translation = $this->brand->translate();
            $res[] = [
                'name'  => $translation->name,
                'url'  => route('brand.detail',['slug'=>$this->brand->slug]),
            ];
        }
        return $res;
    }
}
