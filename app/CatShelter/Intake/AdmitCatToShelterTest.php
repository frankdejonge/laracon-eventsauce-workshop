<?php

namespace App\CatShelter\Intake;

use App\CatShelter\CatInformation;

class AdmitCatToShelterTest extends IntakeProcessTestCase
{
    /**
     * @test
     */
    public function cat_was_brought_in_by_owner()
    {
        $this->when(new AdmitCatToShelter(
            $this->aggregateRootId(),
            $broughtInByOwner = true,
            'Oliver',
            CatInformation::BREEDS[2],
            CatInformation::COLORS[2]
        ))->then(
            new CatWasBroughtIn(
                'Oliver',
                CatInformation::BREEDS[2],
                CatInformation::COLORS[2]
            ),
            new CatWasBroughtInByOwner()
        );
    }

    /**
     * @test
     */
    public function homeless_cat_was_brought_in()
    {
        $this->when(new AdmitCatToShelter(
            $this->aggregateRootId(),
            false, // by owner
            'Oliver',
            CatInformation::BREEDS[2],
            CatInformation::COLORS[2]
        ))->then(
            new CatWasBroughtIn(
                'Oliver',
                CatInformation::BREEDS[2],
                CatInformation::COLORS[2]
            ),
            new HomelessCatWasBroughtIn()
        );
    }
}