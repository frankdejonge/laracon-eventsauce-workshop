<?php

namespace App\Http\Controllers;

use App\CatShelter\AdoptableCats\AdoptableCatsRepository;
use App\CatShelter\CatInformation;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use function redirect;

class ShelterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function adoptable(AdoptableCatsRepository $repository)
    {
        return view('shelter.adoptable', [
            'cats' => $repository->list(),
        ]);
    }

    public function registerForm()
    {
        return view('shelter.register');
    }

    public function registerAction(Request $request, AdoptableCatsRepository $repository)
    {
        $input = $request->except('_token') + ['name' => '', 'id' => Uuid::uuid4()->toString()];
        $catInformation = CatInformation::fromPayload($input);
        $repository->add($catInformation);

        return redirect()->route('shelter.register')->with('status', 'Cat was registered!');
    }
}
