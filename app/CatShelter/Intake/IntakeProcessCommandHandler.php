<?php

namespace App\CatShelter\Intake;

use EventSauce\EventSourcing\AggregateRootRepository;

class IntakeProcessCommandHandler
{
    /**
     * @var AggregateRootRepository
     */
    private $repository;

    public function __construct(AggregateRootRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param object $command
     */
    public function handle(object $command)
    {
        /** @var AdmitCatToShelter $command */
        $aggregateRootId = $command->identifier();
        /** @var IntakeProcess $aggregateRoot */
        $aggregateRoot = $this->repository->retrieve($aggregateRootId);

        if ($command instanceof AdmitCatToShelter) {
            $aggregateRoot->admitCatToShelter($command);
        }

        $this->repository->persist($aggregateRoot);
    }
}