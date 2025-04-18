<?php
use Illuminate\Support\Facades\Route;

Route::get('/','AirportController@index')->name('airport.admin.index');

Route::match(['get'],'/create','AirportController@create')->name('airport.admin.create');
Route::match(['get'],'/edit/{id}','AirportController@edit')->name('airport.admin.edit');

Route::post('/store/{id}','AirportController@store')->name('airport.admin.store');

Route::get('/getForSelect2','AirportController@getForSelect2')->name('airport.admin.getForSelect2');
Route::post('/bulkEdit','AirportController@bulkEdit')->name('airport.admin.bulkEdit');


Route::group(['prefix' => 'category'],function (){
    Route::get('/','CategoryController@index')->name('airport.admin.category.index');
    Route::get('/edit/{id}','CategoryController@edit')->name('airport.admin.category.edit');
    Route::post('/store/{id}','CategoryController@store')->name('airport.admin.category.store');
    Route::post('/bulkEdit','CategoryController@bulkEdit')->name('airport.admin.category.bulkEdit');
});