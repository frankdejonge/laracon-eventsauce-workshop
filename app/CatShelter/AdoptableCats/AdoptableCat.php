<?php

namespace App\CatShelter\AdoptableCats;

use JsonSerializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class AdoptableCat implements JsonSerializable
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $color;

    /**
     * @var string
     */
    private $breed;

    public function __construct(
        UuidInterface $id,
        string $name,
        string $color,
        string $breed
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->color = $color;
        $this->breed = $breed;
    }

    public function id(): UuidInterface
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function color(): string
    {
        return $this->color;
    }

    public function breed(): string
    {
        return $this->breed;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id->toString(),
            'name' => $this->name,
            'color' => $this->color,
            'breed' => $this->breed,
        ];
    }

    public static function fromPayload(array $payload): AdoptableCat
    {
        return new AdoptableCat(
            Uuid::fromString($payload['id']),
            $payload['name'],
            $payload['color'],
            $payload['breed']
        );
    }
}