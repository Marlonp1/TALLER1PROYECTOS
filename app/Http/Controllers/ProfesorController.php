<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    public function index()
    {
        // Aquí puedes retornar una vista específica para los profesores
        return view('profesor.index'); // Asegúrate de que esta vista exista
    }
}
