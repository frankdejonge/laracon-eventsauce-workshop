<?php

namespace App\CatShelter\NationalCatRegistry;

use App\CatShelter\CatInformation;
use App\CatShelter\SorryCatInformationNotFound;
use App\CatShelter\TagOfCat;
use Illuminate\Support\Facades\DB;
use function json_decode;

class CatInformationRegistry
{
    public function lookup(TagOfCat $identifier): CatInformation
    {
        $row = DB::table('cat_information')
            ->where('id', $identifier->toString())
            ->first();

        if ($row === null) {
            throw new SorryCatInformationNotFound();
        }

        return CatInformation::fromPayload(json_decode($row->payload, true));
    }
}