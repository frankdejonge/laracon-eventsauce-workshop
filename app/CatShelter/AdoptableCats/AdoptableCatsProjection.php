<?php

namespace App\CatShelter\AdoptableCats;

use App\CatShelter\CatInformation;
use App\CatShelter\Intake\CatWasBroughtIn;
use App\CatShelter\TagOfCat;
use EventSauce\EventSourcing\Consumer;
use EventSauce\EventSourcing\Message;
use Ramsey\Uuid\Uuid;

class AdoptableCatsProjection implements Consumer
{
    /**
     * @var AdoptableCatsRepository
     */
    private $repository;

    public function __construct(AdoptableCatsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(Message $message)
    {
        $event = $message->event();

        if ($event instanceof CatWasBroughtIn) {
            $this->repository->add(new AdoptableCat(
                Uuid::fromString($message->aggregateRootId()->toString()),
                $event->nameOfTheCat(),
                $event->color(),
                $event->breed()
            ));
        }
    }
}