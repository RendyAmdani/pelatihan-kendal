<?php

Route::group(['middleware' => 'auth', 'prefix' => '/'], function(){

AdvancedRoute::controller('/epersonal/statistik', '\App\Modules\epersonal\statistik\Controllers\StatistikController');

});

