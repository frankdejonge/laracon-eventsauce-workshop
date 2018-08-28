<?php

namespace App\CatShelter;

use DateTimeImmutable;
use InvalidArgumentException;
use JsonSerializable;

class DateOfBirth implements JsonSerializable
{
    /**
     * @var DateTimeImmutable
     */
    private $dateTime;

    public function __construct(DateTimeImmutable $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    public function jsonSerialize()
    {
        return $this->dateTime->format('Y-m-d');
    }

    public static function createFromString(string $dateOfBirth): DateOfBirth
    {
        $dateTime = DateTimeImmutable::createFromFormat('Y-m-d', $dateOfBirth);

        if ( ! $dateTime instanceof DateTimeImmutable) {
            throw new InvalidArgumentException("Invalid date of birth given: {$dateOfBirth}.");
        }

        return new DateOfBirth($dateTime);
    }
}