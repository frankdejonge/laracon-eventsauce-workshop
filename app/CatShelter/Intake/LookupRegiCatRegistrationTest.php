<?php

namespace App\CatShelter\Intake;

use App\CatShelter\DateOfBirth;
use App\CatShelter\SorryCatInformationNotFound;
use App\CatShelter\TagOfCat;

class LookupRegiCatRegistrationTest extends IntakeProcessTestCase
{
    /**
     * @test
     */
    public function successfully_looking_up_a_cat_in_RegiCat()
    {
        $this->createApplication();
        $tagOfCat = TagOfCat::fromString('11be9aeb-335a-4f6a-85bc-3895de5eaed1');

        $this->given(
            TagOfCatWasScanned::withTagOfCat($tagOfCat)
        )->when(new LookupRegiCatRegistration(
            $this->aggregateRootId()
        ))->then(new OwnerWasFoundInRegiCat(
            'Sticky',
            'British Longhair',
            'brown-grey',
            DateOfBirth::createFromString('2017-07-15')
        ));
    }

    /**
     * @test
     */
    public function failing_to_lookup_a_owner_in_regicat()
    {
        $this->createApplication();
        $tagOfCat = TagOfCat::fromString('11be9aeb-1111-4f6a-85bc-3895de5eaed1');

        $this->given(
            TagOfCatWasScanned::withTagOfCat($tagOfCat)
        )->when(new LookupRegiCatRegistration(
            $this->aggregateRootId()
        ))
            ->then(new OwnerWasNotFoundInRegiCat())
            ->expectToFail(new SorryCatInformationNotFound());
    }
}