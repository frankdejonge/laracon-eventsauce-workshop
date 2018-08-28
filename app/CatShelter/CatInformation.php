<?php

namespace App\CatShelter;

use JsonSerializable;

class CatInformation implements JsonSerializable
{
    /**
     * @var TagOfCat
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

    /**
     * @var DateOfBirth
     */
    private $dateOfBirth;

    /**
     * @var string
     */
    private $gender;

    public function __construct(
        TagOfCat $identifier,
        string $name,
        string $color,
        string $breed,
        string $gender,
        DateOfBirth $dateOfBirth
    ) {
        $this->id = $identifier;
        $this->name = $name;
        $this->color = $color;
        $this->breed = $breed;
        $this->dateOfBirth = $dateOfBirth;
        $this->gender = $gender;
    }

    public function id(): TagOfCat
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

    public function gender(): string
    {
        return $this->gender;
    }

    public function dateOfBirth(): DateOfBirth
    {
        return $this->dateOfBirth;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'color' => $this->color,
            'breed' => $this->breed,
            'gender' => $this->gender,
            'date_of_birth' => $this->dateOfBirth,
        ];
    }

    public static function fromPayload(array $payload): CatInformation
    {
        return new CatInformation(
            TagOfCat::fromString($payload['id']),
            $payload['name'],
            $payload['color'],
            $payload['breed'],
            $payload['gender'],
            DateOfBirth::createFromString($payload['date_of_birth'])
        );
    }

    const GENDERS = [
        'female',
        'male',
    ];

    const COLORS = [
        'brown',
        'black',
        'white',
        'grey',
        'red',
        'white-spotted',
        'black-white',
        'brown-white',
        'brown-black',
        'brown-grey',
        'grey-white',
    ];

    const BREEDS = [
        'Abyssinian',
        'Aegean',
        'American Curl',
        'American Shorthair',
        'American Wirehair',
        'Arabian Mau',
        'Australian Mist',
        'Asian',
        'Asian Semi-longhair',
        'Balinese',
        'Bambino',
        'Bengal',
        'Birman',
        'Bombay',
        'Brazilian Shorthair',
        'British Semi-longhair',
        'British Shorthair',
        'British Longhair',
        'Burmese',
        'Burmilla',
        'California Spangled',
        'Chantilly-Tiffany',
        'Chartreux',
        'Chausie',
        'Cheetoh',
        'Colorpoint Shorthair',
        'Cornish Rex',
        'Cymric',
        'Cyprus',
        'Devon Rex',
        'Donskoy',
        'Dragon Li',
        'Dwarf cat',
        'Egyptian Mau',
        'European Shorthair',
        'Exotic Shorthair',
        'Foldex',
        'German Rex',
        'Havana Brown',
        'Highlander',
        'Himalayan',
        'Javanese',
        'Khao Manee',
        'Korat',
        'LaPerm',
        'Lykoi',
        'Maine Coon',
        'Manx',
        'Minskin',
        'Munchkin',
        'Nebelung',
        'Napoleon',
        'Norwegian Forest cat',
        'Ocicat',
        'Ojos Azules',
        'Oregon Rex',
        'Oriental Shorthair',
        'Oriental Longhair',
        'Persian',
        'Greater Iran',
        'Peterbald',
        'Pixie-bob',
        'Raas',
        'Ragamuffin',
        'Ragdoll',
        'Russian Blue',
        'Sam Sawet',
        'Savannah',
        'Scottish Fold',
        'Selkirk Rex',
        'Serengeti',
        'Serrade petit',
        'Siamese',
        'Siberian',
        'Singapura',
        'Snowshoe',
        'Sokoke',
        'Somali',
        'Sphynx',
        'Suphalak',
        'Thai',
        'Thai Lilac',
        'Tonkinese',
        'Toyger',
        'Turkish Angora',
        'Turkish Van',
        'Ukrainian Levkoy',
    ];
}