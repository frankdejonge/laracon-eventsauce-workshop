<?php

namespace App\CatShelter\Intake;

use function dd;
use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour\AggregateRootBehaviour;

class IntakeProcess implements AggregateRoot
{
    use AggregateRootBehaviour;

    public function admitCatToShelter(AdmitCatToShelter $command)
    {
        $this->recordThat(new CatWasBroughtIn(
            $command->nameOfTheCat(),
            $command->breed(),
            $command->color()
        ));
    }
    
    protected function applyCatWasBroughtIn(CatWasBroughtIn $event)
    {
        // ignore
    }
}