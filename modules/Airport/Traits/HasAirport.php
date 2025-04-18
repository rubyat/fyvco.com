<?php

namespace Modules\Airport\Traits;

use Modules\Airport\Models\Airport;

trait HasAirport
{

    /**
     * Get Airport
     */
    public function airport()
    {
        return $this->belongsTo(Airport::class, "airport_id")->with(['translation']);
    }

    public function airportBreadcrumbs(){
        $res = [];
        if($this->airport){
            $parents = $this->airport->ancestorsOf($this->airport);
            foreach ($parents as $parent){
                $translation = $parent->translate();
                $res[] = [
                    'name'  => $translation->name,
                    'url'  => route('airport.detail',['slug'=>$parent->slug]),
                ];
            }
            $translation = $this->airport->translate();
            $res[] = [
                'name'  => $translation->name,
                'url'  => route('airport.detail',['slug'=>$this->airport->slug]),
            ];
        }
        return $res;
    }
}
