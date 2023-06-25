<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeleteSessionController extends Controller
{
    public function delete()
    {
        session()->flush();
        return redirect()->back();
    }
}
