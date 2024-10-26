<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizzController extends Controller
{
    public function index()
    {
        // Retorna la vista del Quizz
        return view('quizz.index'); // Asegúrate de que la vista existe en resources/views/quizz/index.blade.php
    }
}