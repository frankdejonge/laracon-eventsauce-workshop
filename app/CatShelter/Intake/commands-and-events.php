<?php

namespace App\CatShelter\Intake;

use EventSauce\EventSourcing\Serialization\SerializableEvent;

final class CatWasBroughtIn implements SerializableEvent
{
    /**
     * @var string
     */
    private $nameOfTheCat;

    /**
     * @var string
     */
    private $breed;

    /**
     * @var string
     */
    private $color;

    public function __construct(
        string $nameOfTheCat,
        string $breed,
        string $color
    ) {
        $this->nameOfTheCat = $nameOfTheCat;
        $this->breed = $breed;
        $this->color = $color;
    }

    public function nameOfTheCat(): string
    {
        return $this->nameOfTheCat;
    }

    public function breed(): string
    {
        return $this->breed;
    }

    public function color(): string
    {
        return $this->color;
    }
    public static function fromPayload(array $payload): SerializableEvent
    {
        return new CatWasBroughtIn(
            (string) $payload['nameOfTheCat'],
            (string) $payload['breed'],
            (string) $payload['color']);
    }

    public function toPayload(): array
    {
        return [
            'nameOfTheCat' => (string) $this->nameOfTheCat,
            'breed' => (string) $this->breed,
            'color' => (string) $this->color,
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public static function withNameOfTheCatAndBreedAndColor(string $nameOfTheCat, string $breed, string $color): CatWasBroughtIn
    {
        return new CatWasBroughtIn(
            $nameOfTheCat,
            $breed,
            $color
        );
    }
}

final class CatWasBroughtInByOwner implements SerializableEvent
{
    public static function fromPayload(array $payload): SerializableEvent
    {
        return new CatWasBroughtInByOwner();
    }

    public function toPayload(): array
    {
        return [];
    }

    /**
     * @codeCoverageIgnore
     */
    public static function with(): CatWasBroughtInByOwner
    {
        return new CatWasBroughtInByOwner();
    }
}

final class HomelessCatWasBroughtIn implements SerializableEvent
{
    public static function fromPayload(array $payload): SerializableEvent
    {
        return new HomelessCatWasBroughtIn();
    }

    public function toPayload(): array
    {
        return [];
    }

    /**
     * @codeCoverageIgnore
     */
    public static function with(): HomelessCatWasBroughtIn
    {
        return new HomelessCatWasBroughtIn();
    }
}

final class AdmitCatToShelter
{
    /**
     * @var IntakeProcessIdentifier
     */
    private $identifier;

    /**
     * @var bool
     */
    private $broughtInByOwner;

    /**
     * @var string
     */
    private $nameOfTheCat;

    /**
     * @var string
     */
    private $breed;

    /**
     * @var string
     */
    private $color;

    public function __construct(
        IntakeProcessIdentifier $identifier,
        bool $broughtInByOwner,
        string $nameOfTheCat,
        string $breed,
        string $color
    ) {
        $this->identifier = $identifier;
        $this->broughtInByOwner = $broughtInByOwner;
        $this->nameOfTheCat = $nameOfTheCat;
        $this->breed = $breed;
        $this->color = $color;
    }

    public function identifier(): IntakeProcessIdentifier
    {
        return $this->identifier;
    }

    public function broughtInByOwner(): bool
    {
        return $this->broughtInByOwner;
    }

    public function nameOfTheCat(): string
    {
        return $this->nameOfTheCat;
    }

    public function breed(): string
    {
        return $this->breed;
    }

    public function color(): string
    {
        return $this->color;
    }
}
