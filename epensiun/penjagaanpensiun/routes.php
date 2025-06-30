<?php

Route::group(['middleware' => 'auth', 'prefix' => '/'], function(){

AdvancedRoute::controller('/epensiun/penjagaanpensiun', '\App\Modules\epensiun\penjagaanpensiun\Controllers\PenjagaanpensiunController');

});

