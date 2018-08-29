<?php

namespace App\CatShelter\Intake;

use EventSauce\EventSourcing\AggregateRootId;
use EventSauce\EventSourcing\AggregateRootTestCase;

abstract class IntakeProcessTestCase extends AggregateRootTestCase
{
    public function handle(object $command)
    {
        (new IntakeProcessCommandHandler(
            $this->repository
        ))->handle($command);
    }

    protected function newAggregateRootId(): AggregateRootId
    {
        return IntakeProcessIdentifier::create();
    }

    protected function aggregateRootClassName(): string
    {
        return IntakeProcess::class;
    }
}