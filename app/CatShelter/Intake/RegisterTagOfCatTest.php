<?php

namespace App\CatShelter\Intake;

use App\CatShelter\TagOfCat;

class RegisterTagOfCatTest extends IntakeProcessTestCase
{
    /**
     * @test
     */
    public function registering_the_tag_of_a_cat()
    {
        $this->when(new RegisterTagOfCat(
            $this->aggregateRootId(),
            $tagOfCat = TagOfCat::create()
        ))->then(
            new TagOfCatWasScanned($tagOfCat)
        );
    }
}