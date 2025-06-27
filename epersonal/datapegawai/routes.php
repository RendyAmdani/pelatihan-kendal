<?php

Route::group(['middleware' => 'auth', 'prefix' => '/'], function(){

AdvancedRoute::controller('/epersonal/datapegawai', '\App\Modules\epersonal\datapegawai\Controllers\DatapegawaiController');

});

