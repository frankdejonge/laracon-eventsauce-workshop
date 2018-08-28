<?php

namespace App\CatShelter\Intake;

use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour\AggregateRootBehaviour;

class IntakeProcess implements AggregateRoot
{
    use AggregateRootBehaviour;
}