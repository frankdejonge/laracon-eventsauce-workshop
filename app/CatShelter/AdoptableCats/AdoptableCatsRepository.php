<?php

namespace App\CatShelter\AdoptableCats;

use App\CatShelter\CatInformation;
use Illuminate\Support\Facades\DB;
use function array_map;

class AdoptableCatsRepository
{
    /**
     * @return CatInformation[]
     */
    public function list(): array
    {
        $rows = DB::table('adoptable_cats')->orderBy('id', 'DESC')->get()->all();

        return array_map(function ($row) {
            return CatInformation::fromPayload(json_decode($row->payload, true));
        }, $rows);
    }

    public function add(CatInformation $catInformation)
    {
        DB::table('adoptable_cats')->insert([
            'tag_of_cat' => $catInformation->id()->toString(),
            'breed'      => $catInformation->breed(),
            'gender'     => $catInformation->gender(),
            'color'      => $catInformation->color(),
            'payload'    => json_encode($catInformation),
        ]);
    }
}