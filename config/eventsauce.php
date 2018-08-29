<?php

use App\CatShelter\AdoptableCats\AdoptableCatsProjector;
use App\CatShelter\Intake\IntakeProcess;

return [
    'aggregate_root' => IntakeProcess::class,
    'sync_consumers' => [
         AdoptableCatsProjector::class,
    ],
    'async_consumers' => [
        // ...
    ],
    'definition' => __DIR__.'/../app/CatShelter/Intake/commands-and-events.yml',
    'output' => __DIR__.'/../app/CatShelter/Intake/commands-and-events.php',
];