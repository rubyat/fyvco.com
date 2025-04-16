<?php
use Illuminate\Support\Facades\Route;

// Brand
Route::group(['prefix'=>config('brand.brand_route_prefix')],function(){
    Route::get('/{slug}','BrandController@detail')->name("brand.detail");;// Detail
    Route::get('/search/searchForSelect2','BrandController@searchForSelect2')->name("brand.searchForSelect");;// Search for select 2
});
