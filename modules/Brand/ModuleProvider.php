<?php
namespace Modules\Brand;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Helpers\SitemapHelper;
use Modules\Hotel\Models\Hotel;
use Modules\Brand\Models\Brand;
use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(SitemapHelper $sitemapHelper){
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        if(is_installed()){
            $sitemapHelper->add("brand",[app()->make(Brand::class),'getForSitemap']);
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
            'brand'=>[
                "position"=>30,
                'url'        => route('brand.admin.index'),
                'title'      => __("Brand"),
                'icon'       => 'icon ion-md-compass',
                'permission' => 'brand_view',
            ]
        ];
    }
    public static function getTemplateBlocks(){
        return [
            'list_brands'=>"\\Modules\\Brand\\Blocks\\ListBrands",
        ];
    }
}
