<?php

Route::group(['middleware' => 'auth', 'prefix' => '/'], function(){

AdvancedRoute::controller('/epensiun/templateskpensiun', '\App\Modules\epensiun\templateskpensiun\Controllers\TemplateskpensiunController');

});

