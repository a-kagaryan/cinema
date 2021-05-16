<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $halls = Hall::query();
        return view('app.index', ['halls' => $halls]);
    }
}
