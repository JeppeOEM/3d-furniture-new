<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListController extends Controller
{


    public function index()
    {
        // Get the ID of the sofa you want to fetch components for

        return inertia('List', []);
    }
}
