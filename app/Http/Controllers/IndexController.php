<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Component;
use App\Models\Configuration;
use App\Models\FrontpageConfiguration;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class IndexController extends Controller
{


    public function index()
    {
        // Get the ID of the sofa you want to fetch components for

        return inertia('Frontpage', ['app.layout' => 'layouts.app',]);
    }

    public function show(Request $request)
    {
        $size = $request->input('size');

        if ($size === "all") {

            $results = FrontpageConfiguration::all();
        } else {

            $results = FrontpageConfiguration::where('size', $size)->get();
        }
        // dd($results);
        return response()->json([
            'configurations' => $results
        ]);
    }
}
