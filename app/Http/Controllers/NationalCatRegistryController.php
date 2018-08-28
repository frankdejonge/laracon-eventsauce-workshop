<?php

namespace App\Http\Controllers;

use App\CatShelter\NationalCatRegistry\CatInformationRegistry;
use App\CatShelter\SorryCatInformationNotFound;
use App\CatShelter\TagOfCat;
use function response;

class NationalCatRegistryController extends Controller
{
    /**
     * @var CatInformationRegistry
     */
    private $registry;

    public function __construct(CatInformationRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function lookup(string $tag)
    {
        $tagOfCat = TagOfCat::fromString($tag);

        try {
            return $this->registry->lookup($tagOfCat);
        } catch (SorryCatInformationNotFound $exception) {
            return response(['error' => 'cat not found'], 404);
        }
    }
}