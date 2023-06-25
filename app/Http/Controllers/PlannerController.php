<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FrontpageConfiguration;
use Inertia\Inertia;

class PlannerController extends Controller
{
    public function index(Request $request)
    {

        return Inertia::render('Planner', []);
    }


    public function show(Request $request)
    {
        $size = $request->input('size');
        $type = $request->input('type');

        if ($size == "all") {
            $rows = FrontpageConfiguration::where('type', $type)
                ->get();
        } else {
            $rows = FrontpageConfiguration::where('size', $size)
                ->where('type', $type)
                ->get();
        }
        // dd($rows);
        return response()->json([
            'rows' => $rows
        ]);
    }

    public function all(Request $request)
    {

        $rows = FrontpageConfiguration::all();


        return response()->json([
            'rows' => $rows
        ]);
    }
}
