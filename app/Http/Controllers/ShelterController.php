<?php

namespace App\Http\Controllers;

use App\CatShelter\AdoptableCats\AdoptableCatsRepository;
use App\CatShelter\CatInformation;
use App\CatShelter\Intake\AdmitCatToShelter;
use App\CatShelter\Intake\IntakeProcessCommandHandler;
use App\CatShelter\Intake\IntakeProcessIdentifier;
use Illuminate\Container\Container;
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

    public function registerAction(Request $request, IntakeProcessCommandHandler $commandHandler)
    {
        $input = $request->except('_token') + ['name' => ''];
        $commandHandler->handle(new AdmitCatToShelter(
            IntakeProcessIdentifier::create(),
            true,
            $input['name'],
            $input['breed'],
            $input['color']
        ));

        return redirect()->route('shelter.register')->with('status', 'Cat was registered!');
    }
}
