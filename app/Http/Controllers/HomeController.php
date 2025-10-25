<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Example data we're "fetching" — imagine this came from a database.
        $welcome = 'Welcome to HussleTools!';
        $features = [
            'Online Digital Marketplace',
            'Best Tools Logs',
            'Best SM logs Marketplace',
            'Clean Logs',
        ];

        // Pass variables to the view. compact('welcome', 'features') is shorthand.
        return view('home', compact('welcome', 'features'));
    }
}
