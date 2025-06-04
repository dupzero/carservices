<?php

namespace App\Http\Controllers;

use App\Models\Client;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }
}
