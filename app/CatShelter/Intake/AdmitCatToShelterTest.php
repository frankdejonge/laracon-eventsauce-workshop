<?php

namespace App\CatShelter\Intake;

use App\CatShelter\AdoptableCats\AdoptableCat;
use App\CatShelter\AdoptableCats\AdoptableCatsProjector;
use App\CatShelter\AdoptableCats\AdoptableCatsRepository;
use App\CatShelter\CatInformation;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class AdmitCatToShelterTest extends IntakeProcessTestCase
{
    /**
     * @var AdoptableCatsRepository
     */
    private $adoptableCats;

    /**
     * @before
     */
    public function truncateAdopableCats()
    {
        $this->createApplication();
        DB::table('adoptable_cats')->truncate();
    }

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

        $this->expectAdoptableCatToBePresent();
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

    protected function consumers(): array
    {
        $this->adoptableCats = new AdoptableCatsRepository();

        return [
            new AdoptableCatsProjector($this->adoptableCats),
        ];
    }

    protected function expectAdoptableCatToBePresent(): void
    {
        $listOfCats = $this->adoptableCats->list();
        $this->assertContainsOnly(AdoptableCat::class, $listOfCats);
        $this->assertCount(1, $listOfCats);
        $adoptableCat = reset($listOfCats);
        $expectedCat = new AdoptableCat(
            Uuid::fromString($this->aggregateRootId()->toString()),
            'Oliver',
            CatInformation::COLORS[2],
            CatInformation::BREEDS[2]
        );
        $this->assertEquals($expectedCat, $adoptableCat);
    }
}