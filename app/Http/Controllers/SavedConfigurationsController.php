<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SavedConfigurationsController extends Controller
{
    public function index()
    {
        // Get the ID of the sofa you want to fetch components for

        return inertia('saved', []);
    }
}
