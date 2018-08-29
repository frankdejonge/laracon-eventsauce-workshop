<?php

namespace App\CatShelter\Intake;

use App\CatShelter\NationalCatRegistry\CatInformationRegistry;
use EventSauce\EventSourcing\AggregateRootId;
use EventSauce\EventSourcing\AggregateRootTestCase;
use Tests\CreatesApplication;

abstract class IntakeProcessTestCase extends AggregateRootTestCase
{
    use CreatesApplication;

    public function handle(object $command)
    {
        (new IntakeProcessCommandHandler(
            $this->repository,
            new CatInformationRegistry()
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