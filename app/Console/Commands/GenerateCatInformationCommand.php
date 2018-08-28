<?php

namespace App\Console\Commands;

use App\CatShelter\CatInformation;
use DateTime;
use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid;
use function array_key_exists;
use function date;
use function json_encode;
use function rand;
use function shuffle;
use const JSON_PRETTY_PRINT;

class GenerateCatInformationCommand extends Command
{
    protected $signature = 'cats:generate-information';

    protected $description = 'Generate information about cats.';

    protected $catOptions = [
        'names'   => [
            'Alfie',
            'Angel',
            'Argus',
            'Arwen',
            'Ashton',
            'Baby',
            'Bailey',
            'Bassil',
            'Beage',
            'Bender',
            'Benny',
            'Big Red',
            'Big Sammy',
            'Binka',
            'Binx',
            'Blackie',
            'Bobo',
            'Boogie',
            'Boris',
            'Bowser',
            'Brandy',
            'Buddy',
            'Butterscotch',
            'Cally',
            'Caramel',
            'Casey',
            'Catherine',
            'Cece',
            'Celine',
            'Cherio',
            'Chloe',
            'Churchill',
            'Cinders',
            'Clarence',
            'Claude',
            'Cleo',
            'Coffee',
            'Cookie',
            'Cooper',
            'Cosmo',
            'Couch Potato',
            'Daisy',
            'Dakota',
            'Dark Moon',
            'David',
            'Denver',
            'Diesel',
            'Dilon',
            'Disney',
            'Dissy',
            'Divine',
            'Dude',
            'Ebony',
            'Enzo',
            'Faggie',
            'Fagison',
            'Felix',
            'Ferris',
            'Fifi',
            'Flowerbee',
            'Fluffernet',
            'Fluffy',
            'Fosters',
            'Freckles',
            'Frollo',
            'Freckuls',
            'Fudge',
            'Fudge',
            'Fuffie',
            'Gabrielle',
            'Gadget',
            'Gary',
            'Ginger',
            'Gipsy',
            'Gizmo',
            'Gore',
            'Grace',
            'Griswald',
            'Grizz',
            'Grizzabella',
            'Harley',
            'Hazel',
            'Henry',
            'Hex',
            'Hoppy',
            'Indy',
            'Izzy',
            'Jasmine',
            'Jay',
            'Jinx',
            'Jon',
            'Jymes Dean',
            'Katie',
            'Kelee',
            'Kenny',
            'Kirby',
            'Kitty',
            'Kliff',
            'Kool Kat',
            'Lady',
            'Larry',
            'Lera',
            'Lexie',
            'Lincoln',
            'Little',
            'Lucy',
            'Mac',
            'Mackie',
            'Marbles',
            'Mario',
            'Marley',
            'Marmelade',
            'Martin',
            'Max',
            'Maxine',
            'Merlin',
            'Micky',
            'Midnight',
            'Mippen',
            'Misty',
            'Missy',
            'Mittens',
            'Mitzy',
            'Molly',
            'Moon Pie',
            'Moriarty',
            'Moritz',
            'Moses',
            'Mozart',
            'Ms Kitty',
            'Myah',
            'Nala',
            'Natasha',
            'Nemo',
            'Niglet',
            'Nikita',
            'Noodles',
            'Noodlehead',
            'Oliver',
            'Oreo',
            'Orwell',
            'Oscar',
            'Panda',
            'Patsy',
            'Paws',
            'Peanut',
            'Peter',
            'Phoebe',
            'Pinkle',
            'Plinky',
            'Poocat',
            'Pooder',
            'Pookie',
            'Prince',
            'Princess',
            'Pumpkin',
            'Punkin',
            'Purr',
            'Rajha',
            'Ralph',
            'Rascal',
            'Romeo',
            'Roxie',
            'Rylie',
            'Sadie',
            'Salem',
            'Sammy',
            'Sasha',
            'Scooter',
            'Scout',
            'Secret',
            'Shadow',
            'Shane',
            'Shelby',
            'Simba',
            'Simon',
            'Simpson',
            'Slippers',
            'Smudge',
            'Sophie',
            'Soushi',
            'Sparkle',
            'Sputnick',
            'Stanley',
            'Starlett',
            'Sticky',
            'Stimpy',
            'Stray',
            'Sugar',
            'Sunny',
            'Tater',
            'Tigger',
            'Tinkerbell',
            'Tina',
            'Tiny',
            'Tobi',
            'Tori',
            'Tricia',
            'Tucker',
            'Tuna',
            'Twiggy',
            'Walter',
            'Whiskers',
            'Willow',
            'Wyatt',
            'Xman',
            'Zakkie',
            'Zebra',
        ],
        'colors'  => CatInformation::COLORS,
        'genders' => CatInformation::GENDERS,
        'breeds'  => CatInformation::BREEDS,
    ];

    public function handle()
    {
        $colorIndex = 0;
        $breedIndex = 0;
        $genderIndex = 0;
        $cats = [];
        ['names' => $names, 'colors' => $colors, 'genders' => $genders, 'breeds' => $breeds] = $this->catOptions;
        shuffle($names);
        shuffle($colors);
        shuffle($breeds);

        foreach ($names as $name) {
            $cats[] = [
                'id'            => Uuid::uuid4()->toString(),
                'name'          => $name,
                'color'         => $colors[$colorIndex],
                'breed'         => $breeds[$breedIndex],
                'gender'        => $genders[$genderIndex],
                'date_of_birth' => $this->randomDateOfBirth(),
            ];

            $colorIndex++;
            $breedIndex++;
            $genderIndex++;

            if ( ! array_key_exists($colorIndex, $colors)) {
                $colorIndex = 0;
            }
            if ( ! array_key_exists($genderIndex, $genders)) {
                $genderIndex = 0;
            }
            if ( ! array_key_exists($breedIndex, $breeds)) {
                $breedIndex = 0;
            }
        }

        $this->line(json_encode($cats, JSON_PRETTY_PRINT));
    }

    private function randomDateOfBirth()
    {
        $year = (int) date('Y') - rand(0, 10);
        $month = rand(1, 12);
        $day = rand(1, 31);

        return (new DateTime())->setDate($year, $month, $day)->format('Y-m-d');
    }
}