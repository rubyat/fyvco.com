<?php
namespace Themes\GoTrip\Airport;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Modules\Airport\Hook;
use Modules\Airport\Models\Airport;
use Modules\Airport\Models\AirportTranslation;
use Modules\Template\Models\Template;
use Themes\GoTrip\Airport\Blocks\ListAirports;

class ModuleProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(Airport::class,\Themes\GoTrip\Airport\Models\Airport::class);
        Template::register(static::getTemplateBlocks());
    }

    public function boot(){
        add_action(Hook::FORM_AFTER_TRIP_IDEA,[$this,'airport_extra_info']);
        add_action(Hook::BEFORE_SAVING,[$this,'save_airport_extra_info']);
    }

    public function airport_extra_info(Airport $airport){
        echo view("Airport::admin.airport_extra_info",['row'=>$airport])->render();
    }

    public function save_airport_extra_info(Airport $airport,Request $request){
        if($request->input('gotrip_save_extra'))
        {
            $airport->general_info = $request->input('general_info');
        }
    }

    public static function getTemplateBlocks(){
        return [
            'list_airports'=> ListAirports::class
        ];
    }
}
