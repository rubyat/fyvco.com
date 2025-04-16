<?php
namespace Themes\GoTrip\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Modules\Brand\Hook;
use Modules\Brand\Models\Brand;
use Modules\Brand\Models\BrandTranslation;
use Modules\Template\Models\Template;
use Themes\GoTrip\Brand\Blocks\ListBrands;

class ModuleProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(Brand::class,\Themes\GoTrip\Brand\Models\Brand::class);
        Template::register(static::getTemplateBlocks());
    }

    public function boot(){
        add_action(Hook::FORM_AFTER_TRIP_IDEA,[$this,'brand_extra_info']);
        add_action(Hook::BEFORE_SAVING,[$this,'save_brand_extra_info']);
    }

    public function brand_extra_info(Brand $brand){
        echo view("Brand::admin.brand_extra_info",['row'=>$brand])->render();
    }

    public function save_brand_extra_info(Brand $brand,Request $request){
        if($request->input('gotrip_save_extra'))
        {
            $brand->general_info = $request->input('general_info');
        }
    }

    public static function getTemplateBlocks(){
        return [
            'list_brands'=> ListBrands::class
        ];
    }
}
