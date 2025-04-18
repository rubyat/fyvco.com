<?php
use Illuminate\Support\Facades\Route;

Route::get('/','BrandController@index')->name('brand.admin.index');

Route::match(['get'],'/create','BrandController@create')->name('brand.admin.create');
Route::match(['get'],'/edit/{id}','BrandController@edit')->name('brand.admin.edit');

Route::post('/store/{id}','BrandController@store')->name('brand.admin.store');

Route::get('/getForSelect2','BrandController@getForSelect2')->name('brand.admin.getForSelect2');
Route::post('/bulkEdit','BrandController@bulkEdit')->name('brand.admin.bulkEdit');