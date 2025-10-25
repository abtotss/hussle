<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    //
     public function index()
{
    $intro = 'We build simple, readable apps with Laravel.';
    $services = [
        'Custom web apps',
        'API development',
        'Maintenance & support',
    ];

    $servicesCount = count($services);

    return view('about', compact('intro', 'services', 'servicesCount'));
}
}
