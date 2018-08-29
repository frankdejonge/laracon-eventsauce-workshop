<?php

namespace App\CatShelter\AdoptableCats;

use Illuminate\Support\Facades\DB;
use function array_map;

class AdoptableCatsRepository
{
    /**
     * @return AdoptableCat[]
     */
    public function list(): array
    {
        $rows = DB::table('adoptable_cats')->orderBy('id', 'DESC')->get()->all();

        return array_map(function ($row) {
            return AdoptableCat::fromPayload(json_decode($row->payload, true));
        }, $rows);
    }

    public function add(AdoptableCat $catInformation)
    {
        DB::table('adoptable_cats')->insert([
            'tag_of_cat' => $catInformation->id()->toString(),
            'breed'      => $catInformation->breed(),
            'gender'     => 'female',
            'color'      => $catInformation->color(),
            'payload'    => json_encode($catInformation),
        ]);
    }
}