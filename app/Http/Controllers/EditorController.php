<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Component;
use App\Models\Configuration;
use App\Models\FrontpageConfiguration;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EditorController extends Controller
{
    public function index(Request $request)
    {
        $showModal = true;
        if ($request->session()->has('configuration')) {
            $showModal = false;
        }
        $configurations = Configuration::all();
        $components = Component::all(); // Fetch data from the database
        $configurationId = $request->session()->get('configuration');
        $configuration = Configuration::find($configurationId);

        return Inertia::render('Editor/Index', [
            'components' => $components, // Pass the data to the Inertia response
            'configurations' => $configurations, // Pass the data to the Inertia response           
            'sessionData' => $configuration ? json_decode($configuration->configuration) : null,
            'showModal' => $showModal,
        ]);
    }

    public function nomodal(Request $request)
    {
        $showModal = false;
        $configurations = Configuration::all();
        $components = Component::all(); // Fetch data from the database
        $configurationId = $request->session()->get('configuration');
        $configuration = Configuration::find($configurationId);

        return Inertia::render('Editor/Index', [
            'components' => $components, // Pass the data to the Inertia response
            'configurations' => $configurations, // Pass the data to the Inertia response           
            'sessionData' => $configuration ? json_decode($configuration->configuration) : null,
            'showModal' => $showModal,
        ]);
    }

    public function show(Request $request)
    {

        //color description is stored in filename
        $color = $request->input('color');

        $results = Component::where('file_name', $color)->get();

        return $results;
    }


    public function showId($uniqueValue)
    {
        $components = Component::all();
        $configuration = Configuration::where('identifier', $uniqueValue)->first();




        return Inertia::render('Editor/Index', [
            'components' => $components,
            'sessionData' => $configuration ? json_decode($configuration->configuration) : null
        ]);
    }

    public function jsonDump()
    {

        $configurations = Configuration::all();

        return response()->json([
            'savedConfigurations' => $configurations
        ]);
    }
}
