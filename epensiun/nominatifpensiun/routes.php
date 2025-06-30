<?php

Route::group(['middleware' => 'auth', 'prefix' => '/'], function(){

AdvancedRoute::controller('/epensiun/nominatifpensiun', '\App\Modules\epensiun\nominatifpensiun\Controllers\NominatifpensiunController');

});

