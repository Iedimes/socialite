<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home'); // Asegúrate de tener una vista llamada 'home.blade.php'
    }

    public function bienvenida()
    {
        return view('home2'); // Asegúrate de tener una vista llamada 'home.blade.php'
    }
}
