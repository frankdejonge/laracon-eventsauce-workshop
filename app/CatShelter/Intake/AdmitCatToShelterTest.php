<?php

namespace App\CatShelter\Intake;

use App\CatShelter\CatInformation;

class AdmitCatToShelterTest extends IntakeProcessTestCase
{
    /**
     * @test
     */
    public function admitting_a_cat_to_the_shelter()
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
            )
        );
    }
}