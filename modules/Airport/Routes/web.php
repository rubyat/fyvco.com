<?php
use Illuminate\Support\Facades\Route;

// Airport
Route::group(['prefix'=>config('airport.airport_route_prefix')],function(){
    Route::get('/{slug}','AirportController@detail')->name("airport.detail");;// Detail
    Route::get('/search/searchForSelect2','AirportController@searchForSelect2')->name("airport.searchForSelect");;// Search for select 2
});
