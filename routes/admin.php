<?php

Route::get('/', 'ShelterController@index')->name('shelter.index');
Route::get('/adoptable', 'ShelterController@adoptable')->name('shelter.adoptable');
Route::get('/register', 'ShelterController@registerForm')->name('shelter.register');
Route::post('/register', 'ShelterController@registerAction')->name('shelter.register_action');
