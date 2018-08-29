<?php

namespace App\CatShelter\Intake;

use App\CatShelter\NationalCatRegistry\CatInformationRegistry;
use EventSauce\EventSourcing\AggregateRootRepository;

class IntakeProcessCommandHandler
{
    /**
     * @var AggregateRootRepository
     */
    private $repository;

    /**
     * @var CatInformationRegistry
     */
    private $regiCat;

    public function __construct(
        AggregateRootRepository $repository,
        CatInformationRegistry $regiCat
    ) {
        $this->repository = $repository;
        $this->regiCat = $regiCat;
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

        try {
            if ($command instanceof AdmitCatToShelter) {
                $aggregateRoot->admitCatToShelter($command);
            } elseif ($command instanceof RegisterTagOfCat) {
                $aggregateRoot->registerTagOfCat($command);
            } elseif ($command instanceof LookupRegiCatRegistration) {
                $aggregateRoot->lookupRegiCatRegistration($this->regiCat);
            }
        } finally {
            $this->repository->persist($aggregateRoot);
        }
    }
}