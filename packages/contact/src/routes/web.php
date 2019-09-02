<?php


Route::group(['namespace' => 'Bicky\Contact\Http\Controllers'], function() {

	Route::get('contact', 'ContactController@index');
});