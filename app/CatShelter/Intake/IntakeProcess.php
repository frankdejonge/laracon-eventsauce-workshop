<?php

namespace App\CatShelter\Intake;

use App\CatShelter\NationalCatRegistry\CatInformationRegistry;
use App\CatShelter\SorryCatInformationNotFound;
use App\CatShelter\TagOfCat;
use function dd;
use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour\AggregateRootBehaviour;

class IntakeProcess implements AggregateRoot
{
    use AggregateRootBehaviour;

    /**
     * @var TagOfCat
     */
    private $tagOfCat;

    public function admitCatToShelter(AdmitCatToShelter $command)
    {
        $this->recordThat(new CatWasBroughtIn(
            $command->nameOfTheCat(),
            $command->breed(),
            $command->color()
        ));

        $broughtInByOwner = $command->broughtInByOwner();

        if ($broughtInByOwner) {
            $this->recordThat(new CatWasBroughtInByOwner());
        } else {
            $this->recordThat(new HomelessCatWasBroughtIn());
        }
    }

    public function registerTagOfCat(RegisterTagOfCat $command)
    {
        $this->recordThat(new TagOfCatWasScanned(
            $command->tagOfCat()
        ));
    }

    protected function applyTagOfCatWasScanned(TagOfCatWasScanned $event)
    {
        $this->tagOfCat = $event->tagOfCat();
    }

    public function lookupRegiCatRegistration(CatInformationRegistry $regiCat)
    {
        $this->guardAgainstUnscannedCat();

        try {
            $catInformation = $regiCat->lookup($this->tagOfCat);

            $this->recordThat(new OwnerWasFoundInRegiCat(
                $catInformation->name(),
                $catInformation->breed(),
                $catInformation->color(),
                $catInformation->dateOfBirth()
            ));
        } catch (SorryCatInformationNotFound $exception) {
            $this->recordThat(new OwnerWasNotFoundInRegiCat());
            throw $exception;
        }
    }

    protected function guardAgainstUnscannedCat()
    {
        if ( ! $this->tagOfCat instanceof TagOfCat) {
            throw new SorryTagOfCatWasNotScanned();
        }
    }

    protected function applyOwnerWasNotFoundInRegiCat(OwnerWasNotFoundInRegiCat $event)
    {
        // ignore
    }

    protected function applyOwnerWasFoundInRegiCat(OwnerWasFoundInRegiCat $event)
    {

    }

    protected function applyCatWasBroughtInByOwner(CatWasBroughtInByOwner $event)
    {
        // ignore
    }

    protected function applyHomelessCatWasBroughtIn(HomelessCatWasBroughtIn $event)
    {
        // ignore
    }
    
    protected function applyCatWasBroughtIn(CatWasBroughtIn $event)
    {
        // ignore
    }
}