<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Component;
use App\Models\Configuration;
use App\Models\FrontpageConfiguration;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShareController extends Controller
{
    public function index(Request $request)
    {
        $configurations = Configuration::all();
        $components = Component::all(); // Fetch data from the database
        $configurationId = $request->session()->get('configuration');
        $configuration = Configuration::find($configurationId);

        return Inertia::render('Editor/Index', [
            'components' => $components, // Pass the data to the Inertia response
            'configurations' => $configurations, // Pass the data to the Inertia response           
            'sessionData' => $configuration ? json_decode($configuration->configuration) : null
        ]);
    }
}
