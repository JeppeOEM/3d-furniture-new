<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Configuration;
use App\Models\Component;
use App\Models\ComponentConfiguration;
use App\Models\FrontpageConfiguration;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ConfigurationController extends Controller
{
    public function store(Request $request)
    {

        if ($request->session()->has('configuration')) {
            // if ($request->session()->has('configuration')) {
            // dd($request);
            $configuration = Configuration::findOrFail($request->session()->get('configuration'));
            // dd($request->input('componentList'));
            if (Auth::check()) {
                $configuration->by_user_id = Auth::id();
            }
            $configuration->update([
                'componentList' => $request->input('componentList'),
                'configuration' => $request->input('configuration')
            ]);
            $componentIds = $request->input('componentList');
            // dd($componentIds);
            $configuration->components()->detach();
            $configuration->components()->attach($componentIds);
            $AllConfigurations = Configuration::all();
            return response()->json([
                'message' => 'Session configuration updated successfully',
                'sessionData' => $AllConfigurations,
                'configurationId' => $configuration->id
            ]);
        } else {

            $uniqueId = uniqid('', true);
            $identifier = Str::limit($uniqueId, 10, '');
            if (Auth::check()) {
                $configuration = new Configuration;
                $configuration->configuration = json_encode($request->input('configuration'));
                $configuration->identifier = $identifier;
                $configuration->by_user_id = Auth::id();
                // dd($request->input('componentList'));
                $configuration->componentList = json_encode($request->input('componentList'));
                $configuration->save();
                $componentIds = $request->input('componentList');
                $request->session()->put('configuration', $configuration->id);
                $configuration->components()->detach();
                $configuration->components()->attach($componentIds);
                $AllConfigurations = Configuration::all();
                return response()->json([
                    'message' => 'Logged in: Configuration saved',
                    'sessionData' => $AllConfigurations,
                    'configurationId' => $configuration->id
                ]);
            } else {
                $configuration = new Configuration;

                // dd($request->input('configuration'));
                $configuration->configuration = json_encode($request->input('configuration'));

                $configuration->identifier = $identifier;
                // dd($configuration->componentList);
                // dd($request->input('componentList'));
                $configuration->componentList = json_encode($request->input('componentList'));

                $configuration->save();

                $componentIds = $request->input('componentList');

                $request->session()->put('configuration', $configuration->id);
                $configuration->components()->detach();
                $configuration->components()->attach($componentIds);
                // Handle case when user is not logged in
                $AllConfigurations = Configuration::all();
                return response()->json([
                    'message' => 'not logged in, configuration saved',
                    'sessionData' => $AllConfigurations,
                    'configurationId' => $configuration->id
                ]);
            }
        }
    }




    public function componentById(Request $request)
    {
        // dd($request->input('componentId'));
        $componentId = $request->input('id');
        $component = Component::findOrFail($componentId);
        $url = $component->url;
        return response()->json([
            'url' => $url,
            'component' => $component,
            'file_name' => $component->file_name,
            'category' => $component->category,
            'type' => $component->type,
            'price' => $component->price
        ]);
    }

    public function componentsByConfiguration(Request $request, $configurationId)
    {

        if ($request->session()->has('configuration')) {
            $configuration = Configuration::findOrFail($request->session()->get('configuration'));
            $components = ComponentConfiguration::where('configuration_id', $configuration->id)->get();
        } else {
            $configuration = Configuration::findOrFail($configurationId);
            $components = ComponentConfiguration::where('configuration_id', $configurationId)->get();
        }

        return response()->json([
            'components' => $components,
            // 'configuration' => $configuration
        ]);
    }

    public function configurationsByUser(Request $request)
    {
        $userId = Auth::id();
        $configurations = Configuration::where('by_user_id', $userId)->get();
        return response()->json([
            'userId' => $userId,
            'configurations' => $configurations,
        ]);
    }

    public function configurationBySession(Request $request)
    {
        if ($request->session()->has('configuration')) {
            // if ($request->session()->has('configuration')) {
            // dd($request);
            $configuration = Configuration::findOrFail($request->session()->get('configuration'));
            // $componentList = Configuration::findOrFail($request->session()->get('componentList'));
            // dd($request->input('componentList'));
            return response()->json([
                'message' => 'Configuration send successfully',
                'sessionData' => $configuration ? json_decode($configuration->configuration) : null,
                'identifier' => $configuration->identifier
            ]);
        } else {
        }
    }



    public function getComponents(Request $request)
    {

        if ($request->session()->has('configuration')) {
            $configuration = Configuration::findOrFail($request->session()->get('configuration'));
            $components = ComponentConfiguration::where('configuration_id', $configuration->id)->get();
        } else {
            $components = null;
        }

        return response()->json([
            'components' => $components,
            // 'configuration' => $configuration
        ]);
    }
}
