<?php

Route::group(['middleware' => 'auth', 'prefix' => '/'], function(){

AdvancedRoute::controller('/epersonal/biodatapegawai', '\App\Modules\epersonal\biodatapegawai\Controllers\BiodatapegawaiController');

});

