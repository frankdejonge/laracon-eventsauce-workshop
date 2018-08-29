<?php

namespace App\CatShelter;

use JsonSerializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class TagOfCat implements JsonSerializable
{
    /**
     * @var UuidInterface
     */
    private $identifier;

    public function __construct(UuidInterface $identifier)
    {
        $this->identifier = $identifier;
    }

    public function asUuid(): UuidInterface
    {
        return $this->identifier;
    }

    public function toString(): string
    {
        return $this->identifier->toString();
    }

    public function jsonSerialize()
    {
        return $this->toString();
    }

    public static function fromString(string $identifier): TagOfCat
    {
        return new static(Uuid::fromString($identifier));
    }

    public static function create(): TagOfCat
    {
        return new static(Uuid::uuid4());
    }
}