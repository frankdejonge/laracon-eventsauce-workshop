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

final class TagOfCatWasScanned implements SerializableEvent
{
    /**
     * @var \App\CatShelter\TagOfCat
     */
    private $tagOfCat;

    public function __construct(
        \App\CatShelter\TagOfCat $tagOfCat
    ) {
        $this->tagOfCat = $tagOfCat;
    }

    public function tagOfCat(): \App\CatShelter\TagOfCat
    {
        return $this->tagOfCat;
    }
    public static function fromPayload(array $payload): SerializableEvent
    {
        return new TagOfCatWasScanned(
            \App\CatShelter\TagOfCat::fromString($payload['tagOfCat']));
    }

    public function toPayload(): array
    {
        return [
            'tagOfCat' => $this->tagOfCat->toString(),
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public static function withTagOfCat(\App\CatShelter\TagOfCat $tagOfCat): TagOfCatWasScanned
    {
        return new TagOfCatWasScanned(
            $tagOfCat
        );
    }
}

final class RegiCatSystemWasNotAvailable implements SerializableEvent
{
    public static function fromPayload(array $payload): SerializableEvent
    {
        return new RegiCatSystemWasNotAvailable();
    }

    public function toPayload(): array
    {
        return [];
    }

    /**
     * @codeCoverageIgnore
     */
    public static function with(): RegiCatSystemWasNotAvailable
    {
        return new RegiCatSystemWasNotAvailable();
    }
}

final class OwnerWasFoundInRegiCat implements SerializableEvent
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $breed;

    /**
     * @var string
     */
    private $color;

    /**
     * @var \App\CatShelter\DateOfBirth
     */
    private $dateOfBirth;

    public function __construct(
        string $name,
        string $breed,
        string $color,
        \App\CatShelter\DateOfBirth $dateOfBirth
    ) {
        $this->name = $name;
        $this->breed = $breed;
        $this->color = $color;
        $this->dateOfBirth = $dateOfBirth;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function breed(): string
    {
        return $this->breed;
    }

    public function color(): string
    {
        return $this->color;
    }

    public function dateOfBirth(): \App\CatShelter\DateOfBirth
    {
        return $this->dateOfBirth;
    }
    public static function fromPayload(array $payload): SerializableEvent
    {
        return new OwnerWasFoundInRegiCat(
            (string) $payload['name'],
            (string) $payload['breed'],
            (string) $payload['color'],
            \App\CatShelter\DateOfBirth::createFromString($payload['dateOfBirth']));
    }

    public function toPayload(): array
    {
        return [
            'name' => (string) $this->name,
            'breed' => (string) $this->breed,
            'color' => (string) $this->color,
            'dateOfBirth' => $this->dateOfBirth->jsonSerialize(),
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public static function withNameAndBreedAndColorAndDateOfBirth(string $name, string $breed, string $color, \App\CatShelter\DateOfBirth $dateOfBirth): OwnerWasFoundInRegiCat
    {
        return new OwnerWasFoundInRegiCat(
            $name,
            $breed,
            $color,
            $dateOfBirth
        );
    }
}

final class OwnerWasNotFoundInRegiCat implements SerializableEvent
{
    public static function fromPayload(array $payload): SerializableEvent
    {
        return new OwnerWasNotFoundInRegiCat();
    }

    public function toPayload(): array
    {
        return [];
    }

    /**
     * @codeCoverageIgnore
     */
    public static function with(): OwnerWasNotFoundInRegiCat
    {
        return new OwnerWasNotFoundInRegiCat();
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

final class RegisterTagOfCat
{
    /**
     * @var IntakeProcessIdentifier
     */
    private $identifier;

    /**
     * @var \App\CatShelter\TagOfCat
     */
    private $tagOfCat;

    public function __construct(
        IntakeProcessIdentifier $identifier,
        \App\CatShelter\TagOfCat $tagOfCat
    ) {
        $this->identifier = $identifier;
        $this->tagOfCat = $tagOfCat;
    }

    public function identifier(): IntakeProcessIdentifier
    {
        return $this->identifier;
    }

    public function tagOfCat(): \App\CatShelter\TagOfCat
    {
        return $this->tagOfCat;
    }
}

final class LookupRegiCatRegistration
{
    /**
     * @var IntakeProcessIdentifier
     */
    private $identifier;

    public function __construct(
        IntakeProcessIdentifier $identifier
    ) {
        $this->identifier = $identifier;
    }

    public function identifier(): IntakeProcessIdentifier
    {
        return $this->identifier;
    }
}
