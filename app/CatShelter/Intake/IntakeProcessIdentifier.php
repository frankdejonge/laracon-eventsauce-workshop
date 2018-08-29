<?php

namespace App\CatShelter\Intake;

use EventSauce\EventSourcing\AggregateRootId;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class IntakeProcessIdentifier implements AggregateRootId
{
    /**
     * @var UuidInterface
     */
    private $id;

    public function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->id->toString();
    }

    /**
     * @param string $aggregateRootId
     *
     * @return static
     */
    public static function fromString(string $aggregateRootId): AggregateRootId
    {
        return new static(Uuid::fromString($aggregateRootId));
    }

    public static function create(): IntakeProcessIdentifier
    {
        return new static(Uuid::uuid4());
    }
}