<?php

use App\CatShelter\TagOfCat;

Route::bind(TagOfCat::class, function ($value) {
    return TagOfCat::fromString($value);
});

Route::get('/lookup/{tag}', 'NationalCatRegistryController@lookup')->name('registry.lookup');
