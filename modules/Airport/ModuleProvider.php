<?php
namespace Modules\Airport;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Helpers\SitemapHelper;
use Modules\Hotel\Models\Hotel;
use Modules\Airport\Models\Airport;
use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(SitemapHelper $sitemapHelper){
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        if(is_installed()){
            $sitemapHelper->add("airport",[app()->make(Airport::class),'getForSitemap']);
        }
    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }


    public static function getAdminMenu()
    {
        return [
            'airport'=>[
                "position"=>30,
                'url'        => route('airport.admin.index'),
                'title'      => __("Airport"),
                'icon'       => 'icon ion-md-compass',
                'permission' => 'airport_view',
            ]
        ];
    }
    public static function getTemplateBlocks(){
        return [
            'list_airports'=>"\\Modules\\Airport\\Blocks\\ListAirports",
        ];
    }
}
